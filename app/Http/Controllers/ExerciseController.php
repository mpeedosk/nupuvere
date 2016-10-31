<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ExerciseController extends Controller
{
    /**
     * Display all the different difficulty exercises for this category and age group
     * @param String $category - name of the exercise category
     * @param String $age_group - name of the exercise age group
     * @return \Illuminate\Http\Response
     */
    public function index($category, $age_group)
    {

        // Get all the easy exercises for this category and age group
        $easyList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'lihtne']])
            ->get();

        // Get all the medium exercises for this category and age group
        $mediumList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'keskmine']])
            ->get();

        // Get all the hard exercises for this category and age group
        $hardList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'raske']])
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

    /**
     * Calcualte the current progress based on the difficulty and user
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
            ->where([['user_id', $user_id], ['difficulty', $difficulty], ['category', $category], ['age_group', $age_group], ['users_to_exercise.solved', True]])
            ->count();

        // Get all the exercises
        $all_exercises = DB::table('exercises')->where([['difficulty', $difficulty], ['age_group', $age_group], ['category', $category]])->count();

        // Get the percentage of solved exercises
        if ($all_exercises != 0)
            return $solved_exercises / $all_exercises * 100;

        // if no exercises exist
        return 0;
    }


    /**
     * Return the corresponding exercise view with the correct content
     * @param difficulty - difficulty of the exercise
     * @param user_id - the ID of currently authenticated user
     * @return Float - the % of solved exercises of difficulty $difficulty , in the range on [0,100]
     */
    public function exercise($category, $age_group, $difficulty, $ex_id)
    {
        // fetch the exercise the user wants to solve
        $exercise = DB::table('exercises')
            ->where('id', $ex_id)
            ->first();

        // fetch all the exercises in this category, age_group and difficulty for the sidebar
        $exercise_list = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', $difficulty]])
            ->get();

        // pluck the answer text for this exercise
        $answers = DB::table('answers')
            ->where('ex_id', $ex_id)
            ->pluck('content')
            ->toArray();

        // randomize the answer order
        shuffle($answers);

        // get type name for view
        $type = Exercise::getTypeNameFromInt($exercise->type);

        // if user is not logged in we will not return the solved exercise list
        if (Auth::guest())
            return view('exercise', ['type' => $type, 'exercise' => $exercise, 'exercises' => $exercise_list,
                'answers' => $answers, 'difficulty' => $difficulty, 'category' => $category, 'age_group' => $age_group,
                'solved' => []]);

        return view('exercise', ['type' => $type, 'exercise' => $exercise, 'exercises' => $exercise_list,
            'answers' => $answers, 'difficulty' => $difficulty, 'category' => $category, 'age_group' => $age_group,
            'solved' => Auth::user()->getSolvedEx()]);
    }

    /** Get the new textual exercise template
     * @return \Illuminate\View\View
     * */

    public function getTextual()
    {
        return view('admin.exercises.textual');
    }

    /** Add a new textual exercise
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse - redirect the user back with flash message
     * */
    public function createTextual(Request $request)
    {
        // validate user inputs

        $this->validate(request(), [
            'ex_title' => 'required | unique:exercises,title',
            'ex_content' => 'required',
            'category' => 'required',
            'age_group' => 'required',
            'difficulty' => 'required',
            'answer_1' => 'required'
        ]);

        // create and populate a new exercise
        $exercise = new Exercise;

        $exercise->type = Exercise::TEXTUAL;

        $exercise->title = $request->ex_title;
        $exercise->content = $request->ex_content;
        $exercise->author = $request->ex_author;
        $exercise->hint = $request->ex_hint;
        $exercise->solution = $request->ex_solution;

        $exercise->category = $request->category;
        $exercise->age_group = $request->age_group;
        $exercise->difficulty = $request->difficulty;

        $exercise->save();

        // fetch the just created exercise id

        // insert the answers
        // start from the last answer id and try to get every answer in between
        $this->addAnswers($request, $exercise->id);



        // flash the session to show successful operation
        Session::flash('exercise-create', $request->ex_title);

        return redirect()->back();
    }

    private function addAnswers($request, $id){
        $remaining_answers = $request->answer_count;
        while ($remaining_answers > 0) {
            $ans = $request->input('answer_' . $remaining_answers);
            if (isset($ans) && trim($ans) != '') {
                $answer = new Answer;
                $answer->content = $ans;
                $answer->is_correct = true;
                $answer->order = $remaining_answers;
                $answer->ex_id = $id;
                $answer->save();
            }
            $remaining_answers--;
        }
    }

    public function getTextualForEdit($ex_id)
    {
        // fetch the exercise the user wants to solve


        $exercise = DB::table('exercises')
            ->where('id', $ex_id)
            ->first();

        if ($exercise->type != Exercise::TEXTUAL)
            return redirect('admin/exercise');

        $answers = DB::table('answers')
            ->where('ex_id', $ex_id)
            ->pluck('content')
            ->toArray();

        return view('admin.exercises.textual', ['exercise' => $exercise, 'answers' => $answers]);

    }


    public function updateTextual(Request $request, $ex_id)
    {
        // validate user inputs


        $this->validate(request(), [
            'ex_title' => 'required | unique:exercises,title,' . $ex_id,
            'ex_content' => 'required',
            'category' => 'required',
            'age_group' => 'required',
            'difficulty' => 'required',
            'answer_1' => 'required'
        ]);

        // create and populate a new exercise
        $exercise = Exercise::find($ex_id);

        if ($exercise->type != Exercise::TEXTUAL)
            return redirect('admin/exercise');

        $exercise->title = $request->ex_title;
        $exercise->content = $request->ex_content;
        $exercise->author = $request->ex_author;
        $exercise->hint = $request->ex_hint;
        $exercise->solution = $request->ex_solution;

        $exercise->category = $request->category;
        $exercise->age_group = $request->age_group;
        $exercise->difficulty = $request->difficulty;

        $exercise->save();

        // insert the answers
        // start from the last answer id and try to get every answer in between

        $id = $exercise->id;

        DB::table('answers')->where('ex_id', $id)->delete();
        $this->addAnswers($request, $id);

        // flash the session to show successful operation
        Session::flash('exercise-create', $request->ex_title);

        return redirect('admin/exercise');
    }

    public function getChoice()
    {
        return view('admin.exercises.multipleone');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exercise = DB::table('exercises')
            ->where('id', $id)
            ->first();

        switch ($exercise->type) {
            case Exercise::TEXTUAL:
                return redirect('exercise/text/edit/' . $id);
                break;
            case Exercise::MULTIPLE_ONE:
                return redirect('exercise/choice/edit/' . $id);
                break;
            case Exercise::MULTIPLE_MANY:
                return redirect('exercise/multiple/edit/' . $id);
                break;
            case Exercise::ORDERING:
                return redirect('exercise/order/edit/' . $id);
                break;
        }
        return redirect('admin/exercise');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        return redirect()->back();
    }
}
