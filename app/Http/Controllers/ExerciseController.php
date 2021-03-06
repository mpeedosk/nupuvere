<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class ExerciseController extends Controller
{
    const age_groups = array("avastaja", "uurija", "teadja", "ekspert");
    const difficulties = array("lihtne", "keskmine", "raske");

    /**
     * Display all the different difficulty exercises for this category and age group
     * @param String $category - name of the exercise category
     * @param String $age_group - name of the exercise age group
     * @return \Illuminate\Http\Response
     */

    public function showExerciseList($category, $age_group)
    {
        if (!in_array($age_group, self::age_groups)) {
            return abort(404);
        }
        // Get all the easy exercises for this category and age group
        $easyList = Exercise::where('category', $category)
            ->where('age_group', $age_group)
            ->where('difficulty', 'lihtne')
            ->where('hidden', False)
            ->get();
        // Get all the medium exercises for this category and age group
        $mediumList = Exercise::where('category', $category)
            ->where('age_group', $age_group)
            ->where('difficulty', 'keskmine')
            ->where('hidden', False)
            ->get();
        // Get all the hard exercises for this category and age group
        $hardList = Exercise::where('category', $category)
            ->where('age_group', $age_group)
            ->where('difficulty', 'raske')
            ->where('hidden', False)
            ->get();
        // If user is not logged in, we can't calculate the progress or show solved exercises
        if (Auth::guest()) {
            return view('list', ['category' => $category, 'age_group' => $age_group, 'easyEx' => $easyList,
                'mediumEx' => $mediumList, 'hardEx' => $hardList]);
        }

        // calculate all the progress bars

        $user_id = Auth::user()->id;

        $p_easy = $this->calculateProgress('lihtne', $user_id, $category, $age_group);

        $p_med = $this->calculateProgress('keskmine', $user_id, $category, $age_group);

        $p_hard = $this->calculateProgress('raske', $user_id, $category, $age_group);


        return view('list', ['category' => $category, 'age_group' => $age_group, 'easyEx' => $easyList,
            'mediumEx' => $mediumList, 'hardEx' => $hardList, 'solved' => Auth::user()->getSolvedEx(),
            'p_easy' => $p_easy, 'p_med' => $p_med, 'p_hard' => $p_hard]);

    }


    /** Get the page for creating a new exercise
     * @param Int $type - the type of exercise to be created
     * @return \Illuminate\View\View
     * */

    public function showExerciseTemplate($type)
    {
        switch ($type) {
            case Exercise::TEXTUAL:
                return view('admin.exercises.textual');
            case Exercise::MULTIPLE_ONE:
                return view('admin.exercises.multipleone');
            case Exercise::MULTIPLE_MANY:
                return view('admin.exercises.multiplemany');
            case Exercise::ORDERING:
                return view('admin.exercises.ordering');
        }
        return abort(404);
    }


    /**
     * Calculate the current progress based on the difficulty and user
     * @param String $difficulty - difficulty of the exercise
     * @param Int $user_id - the ID of currently authenticated user
     * @param String $category - the category of the exercise group
     * @param String $age_group - the age group of the exercise group
     * @return Float - the % of solved exercises of difficulty $difficulty , in the range on [0,100]
     */
    private function calculateProgress($difficulty, $user_id, $category, $age_group)
    {
        // Get all the solved exercises for this user
        $solved_exercises = DB::table('users_to_exercise')
            ->join('exercises', "users_to_exercise.ex_id", "=", "exercises.id")
            ->where([['user_id', $user_id], ['difficulty', $difficulty], ['category', $category], ['age_group', $age_group], ['users_to_exercise.solved', True], ['hidden', False]])
            ->count();

        // Get all the exercises
        $all_exercises = DB::table('exercises')->where([['difficulty', $difficulty], ['age_group', $age_group], ['category', $category], ['hidden', False]])->count();

        // if no exercises exist
        if ($all_exercises == 0)
            return 0;

        // Get the percentage of solved exercises
        return $solved_exercises / $all_exercises * 100;

    }


    /**
     * Return the exercise view with the correct content
     * @param $category - category of the exercise
     * @param $age_group - age group of the exercise
     * @param $difficulty - difficulty of the exercise
     * @param $ex_id - the ID of currently authenticated user
     * @return \Illuminate\View\View
     */
    public function show($category, $age_group, $difficulty, $ex_id)
    {
        // fetch the exercise the user wants to solve
        $exercise = DB::table('exercises')
            ->where('id', $ex_id)
            ->first();


        // no such exercise exists or the difficulty or age_group is wrong
        if ($exercise == null || !in_array($age_group, self::age_groups) || !in_array($difficulty, self::difficulties)) {
            return abort(404);
        }

        // tavakasutajale on kättesaamatud, adminile aga mitte
        if ($exercise->hidden) {
            if (Auth::guest() || !Auth::user()->isAdmin())
                abort(404);
        }

        // fetch all the exercises in this category, age_group and difficulty for the sidebar

        $exercise_list_after = Exercise::where('category', $category)
            ->where('age_group', $age_group)
            ->where('difficulty', $difficulty)
            ->where('hidden', False)
            ->where('id', '>=', $ex_id)
            ->take(5)
            ->get();

        $exercise_list_before = Exercise::where('category', $category)
            ->where('age_group', $age_group)
            ->where('difficulty', $difficulty)
            ->where('hidden', False)
            ->where('id', '<', $ex_id)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get()
            ->reverse();

        // pluck the answer text for this exercise
        $answers = DB::table('answers')
            ->where('ex_id', $ex_id)
            ->get()
            ->toArray();

        // randomize the answer order
        shuffle($answers);

        // get type name for view
        $type = Exercise::getTypeNameFromInt($exercise->type);

        // if user is not logged in we will not return the solved exercise list
        if (Auth::guest())
            return view('exercise', ['type' => $type, 'exercise' => $exercise, 'exercises_before' => $exercise_list_before,
                'exercises_after' => $exercise_list_after, 'answers' => $answers, 'difficulty' => $difficulty, 'category'
                => $category, 'age_group' => $age_group, 'solved' => []]);

        return view('exercise', ['type' => $type, 'exercise' => $exercise, 'exercises_before' => $exercise_list_before,
            'exercises_after' => $exercise_list_after, 'answers' => $answers, 'difficulty' => $difficulty, 'category' =>
                $category, 'age_group' => $age_group, 'solved' => Auth::user()->getSolvedEx()]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Int $ex_id
     * @return \Illuminate\Http\Response
     */

    public function getExerciseForEdit($ex_id)
    {
        // fetch the exercise the user wants to solve


        $exercise = Exercise::find($ex_id);

        $answers = DB::table('answers')
            ->where('ex_id', $ex_id)
            ->orderBy('order', 'asc')
            ->get()
            ->toArray();

        switch ($exercise->type) {
            case Exercise::TEXTUAL:
                return view('admin.exercises.textual', ['exercise' => $exercise, 'answers' => $answers]);
            case Exercise::MULTIPLE_ONE:
                return view('admin.exercises.multipleone', ['exercise' => $exercise, 'answers' => $answers]);
            case Exercise::MULTIPLE_MANY:
                return view('admin.exercises.multiplemany', ['exercise' => $exercise, 'answers' => $answers]);
            case Exercise::ORDERING:
                return view('admin.exercises.ordering', ['exercise' => $exercise, 'answers' => $answers]);
        }
        return redirect('admin/exercise');

    }


    /** Create a new exercise
     * @param  \Illuminate\Http\Request $request
     * @param Int $type - the type of the exercise
     * @return \Illuminate\Http\RedirectResponse - redirect the user back with flash message
     * */
    public function create(Request $request, $type)
    {
        // validate user inputs
        $this->validateFields($request);

        // create and populate a new exercise & fetch the exercise id
        $ex_id = $this->createOrUpdateExerciseEntity($request, $type);

        $this->addAnswers($request, $ex_id);

        // insert the answers
        // start from the last answer id and try to get every answer in between

        // flash the session to show successful operation
        Session::flash('exercise-create', $request->ex_title);

        return redirect('/admin/exercise');

    }

    /**
     * Validate user input that is the same for all exercises
     * @param  Int $ex_id - if we need to validate for update
     * @param  Request $request
     * @return void
     */
    private function validateFields(Request $request, $ex_id = null)
    {
        $validId = (isset($ex_id)) ? ',' . $ex_id : '';

        $this->validate(request(), [
            'ex_title' => 'required | max:37 |unique:exercises,title' . $validId,
            'ex_author' => 'max:30',
            'ex_content' => 'required',
            'category' => 'required',
            'age_group' => 'required',
            'difficulty' => 'required',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @param  Int $type - the exercise type
     * @param  Exercise - if we need to update, an exercise is provided
     * @return Int
     */
    private function createOrUpdateExerciseEntity(Request $request, $type, $exercise = null)
    {
        if (!isset($exercise)) {
            // create and populate a new exercise
            $exercise = new Exercise;
            $exercise->type = $type;
        }

        if (isset($request->licence))
            $licence = true;
        else
            $licence = false;

        $exercise->title = $request->ex_title;
        $exercise->content = $request->ex_content;
        $exercise->author = $request->ex_author;
        $exercise->hint = $request->ex_hint;
        $exercise->solution = $request->ex_solution;

        $exercise->keywords = $request->keywords;
        $exercise->category = $request->category;
        $exercise->age_group = $request->age_group;
        $exercise->difficulty = $request->difficulty;

        $exercise->licence = $licence;

        $exercise->save();

        return $exercise->id;
    }


    /**
     * Add answers to the exercise
     * incorret_n answers are incorrect
     * answer_n answers are correct
     *
     * @param  Request $request
     * @param  Int $id - id of the exercise
     * @return void
     */
    private function addAnswers($request, $id)
    {
        $remaining_answers = $request->answer_count;
        $answers = [];

        // randomizing, so answer ID wouldn't be in order
        for ($x = 1; $x <= $remaining_answers; $x++) {
            array_push($answers, $x);
        }
        shuffle($answers);

        // add the incorrect answers first
        for ($i = 0; $i < count($answers); $i++) {
            $ans = $request->input('answer_' . $answers[$i]);
            if (isset($ans) && trim($ans) != '') {
                $answer = new Answer;
                $answer->content = $ans;
                $answer->is_correct = true;
                $answer->order = $answers[$i];
                $answer->ex_id = $id;
                $answer->save();
            } else {
                $ans = $request->input('incorrect_' . $answers[$i]);
                if (isset($ans) && trim($ans) != '') {
                    $answer = new Answer;
                    $answer->content = $ans;
                    $answer->is_correct = false;
                    $answer->order = $answers[$i];
                    $answer->ex_id = $id;
                    $answer->save();
                }
            }
        }
    }


    public function update(Request $request, $ex_id)
    {

        // validate user inputs
        $this->validateFields($request, $ex_id);

        $exercise = Exercise::find($ex_id);

        $this->createOrUpdateExerciseEntity($request, null, $exercise);


        DB::table('answers')->where('ex_id', $ex_id)->delete();

        $this->addAnswers($request, $ex_id);


        // flash the session to show successful operation
        Session::flash('exercise-update', $request->ex_title);

        return redirect('/admin/exercise/edit/' . $ex_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('exercises')->where('id', $id)->delete();
        DB::table('answers')->where('ex_id', $id)->delete();

        Session::flash('exercise-delete', 'Ülesanne edukalt kustutatud');

        return redirect('/admin/exercise');
    }

    /**
     * Hide the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function hide($id)
    {

        $exercise = Exercise::find($id);

        $isHidden = $exercise->hidden;

        $exercise->hidden = !$isHidden;

        $exercise->save();

        if (!$isHidden)
            Session::flash('toast', 'Ülesanne edukalt peidetud!');
        else
            Session::flash('toast', 'Ülesanne edukalt nähtavaks tehtud!');
        return redirect('/admin/exercise');
    }

    public function export()
    {
        Excel::create('exercises_answers_' . date('dmYHis'), function ($excel) {
            $excel->sheet('exercises', function ($sheet) {
                $sheet->fromModel(Exercise::all(), null, 'A1', true);
            });
            $excel->sheet('answers', function ($sheet) {
                $sheet->fromModel(Answer::all(), null, 'A1', true);
            });
        })->export('xls');
    }

    public function import()
    {
        $total_ex = 0;
        $total_ans = 0;
        $suc_ex = 0;
        $suc_ans = 0;

        Excel::load(Input::file('import'), function ($reader) use (&$total_ex, &$total_ans, &$suc_ex, &$suc_ans) {
            $reader->each(function ($sheet) use (&$total_ex, &$total_ans, &$suc_ex, &$suc_ans) {
                $sheetTitle = $sheet->getTitle();
                if ($sheetTitle === "exercises") {
                    foreach ($sheet->toArray() as $row) {
                        $id = Exercise::where('id', $row["id"])->first();
                        $title = Exercise::where('title', $row["title"])->first();
                        if (!isset($id) && !isset($title)) {
                            Exercise::create($row);
                            $suc_ex++;
                        }
                        $total_ex++;
                    }
                } else if ($sheetTitle == "answers") {
                    foreach ($sheet->toArray() as $row) {
                        $id = Answer::where('id', $row["id"])->first();
                        $ex = Exercise::where('id', $row["ex_id"])->first();
                        if (!isset($id) && isset($ex)) {
                            Answer::create($row);
                            $suc_ans++;
                        }
                        $total_ans++;
                    }
                }
            });
        });

        if ($total_ans > 0 && $total_ex > 0 && $suc_ex / $total_ex == 1 && $suc_ans / $total_ans == 1)
            Session::flash('toast', 'Import - Ülesanded: ' . $suc_ex . '/' . $total_ex . ', Vastused: ' . $suc_ans . '/' . $total_ans);
        else {
            Session::flash('info', 'Import - Ülesanded: ' . $suc_ex . '/' . $total_ex . ', Vastused: ' . $suc_ans . '/' . $total_ans);
            Session::flash('error', 'ID ja Pealkiri ei tohi kattuda olemasoleva ülesandega');

        }
        return redirect('/admin/exercise');
    }

    public function checkTitle(Request $request, $id)
    {
        if ($id == -1) {
            $count = DB::table('exercises')->select('title')->where('title', '=', $request->title)->count();
            if ($count > 0) {
                return response()->json(['response' => 'false']);
            } else {
                return response()->json(['response' => 'true']);
            }
        } else {
            $ex = DB::table('exercises')->select('title', 'id')->where('title', "=", $request->title)->first();
            if (!isset($ex) || $ex->id == $id)
                return response()->json(['response' => 'true']);
            else
                return response()->json(['response' => 'false']);

        }


    }
}
