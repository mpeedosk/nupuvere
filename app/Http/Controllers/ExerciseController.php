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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category, $age_group)
    {

        $easyList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'lihtne']])
            ->get();
        $mediumList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'keskmine']])
            ->get();
        $hardList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'raske']])
            ->get();

        if (Auth::guest()) {
            return view('list', ['category' => $category, 'age_group' => $age_group, 'easyEx' => $easyList,
                'mediumEx' => $mediumList, 'hardEx' => $hardList]);
        }

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
     * @param difficulty - difficulty of the exercise
     * @param user_id - the ID of currently authenticated user
     * @return Float - the % of solved exercises of difficulty $difficulty , in the range on [0,100]
     */
    private function calculateProgress($difficulty, $user_id, $category, $age_group)
    {
        $solved_easy = DB::table('users_to_exercise')
            ->join('exercises', "users_to_exercise.ex_id", "=", "exercises.id")
            ->where([['user_id', $user_id], ['difficulty', $difficulty], ['category', $category], ['age_group', $age_group], ['users_to_exercise.solved', True]])
            ->count();
        $all_easy = DB::table('exercises')->where('difficulty', $difficulty)->count();

        if ($all_easy != 0)
            return $solved_easy / $all_easy * 100;

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
        /* kui ID järgi teha query, siis oleks palju lühem*/
        $exercise = DB::table('exercises')
            ->where('id', $ex_id)
            ->first();
        $exercise_list = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', $difficulty]])
            ->get();

        $type = "";
        $answers = DB::table('answers')
            ->where('ex_id', $ex_id)
            ->pluck('content')
            ->toArray();
        shuffle($answers);

        switch ($exercise->type) {
            case Exercise::TEXTUAL:
                $type = "textual";
                break;
            case Exercise::MULTIPLE_ONE:
                $type = "multipleone";
                break;
            case Exercise::MULTIPLE_MANY:
                $type = "multiplemany";
                break;
            case Exercise::ORDERING:
                $type = "ordering";
                break;
        }
        if (Auth::guest())
            return view('exercise', ['type' => $type, 'exercise' => $exercise, 'exercises' => $exercise_list,
                'answers' => $answers, 'difficulty' => $difficulty, 'category' => $category, 'age_group' => $age_group,
                'solved' => []]);

        return view('exercise', ['type' => $type, 'exercise' => $exercise, 'exercises' => $exercise_list,
            'answers' => $answers, 'difficulty' => $difficulty, 'category' => $category, 'age_group' => $age_group,
            'solved' => Auth::user()->getSolvedEx()]);
    }


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

        $this-> validate(request(), [
            'ex_title' => 'required | unique:exercises,title',
            'ex_content' => 'required',
            'category' => 'required',
            'age_group' => 'required',
            'difficulty' => 'required',
            'answer_1' => 'required'
        ]);

        $exercise = new Exercise;
        $exercise->type = Exercise::TEXTUAL;

        $exercise->title    = $request->ex_title;
        $exercise->content  = $request->ex_content;
        $exercise->author   = $request->ex_author;
        $exercise->hint     = $request->ex_hint;
        $exercise->solution = $request->ex_solution;

        $exercise->category     = $request->category;
        $exercise->age_group    = $request->age_group;
        $exercise->difficulty   = $request->difficulty;

        $exercise->save();

        // fetch the just created exercise id
        $id = $exercise->id;


        $remaining_answers = $request->answer_count;

        while ($remaining_answers > 0) {
            $ans = $request->input('answer_' . $remaining_answers);
            if (isset($ans)&& trim($ans) != '') {
                $answer = new Answer;
                $answer->content = $ans;
                $answer->is_correct = true;
                $answer->order = $remaining_answers;
                $answer->ex_id = $id;
                $answer->save();
            }
            $remaining_answers--;
        }


        Session::flash('exercise-create', $request->ex_title);

        return redirect()->back();
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
        //
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
        //
    }
}
