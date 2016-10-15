<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category, $age_group )
    {

        $easyList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'lihtne'] ])
            ->get();
        $mediumList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'keskmine'] ])
            ->get();
        $hardList = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', 'raske'] ])
            ->get();

        if (Auth::guest()) {
            return view ('list' , ['category'=> $category, 'age_group' => $age_group, 'easyEx' => $easyList,
                'mediumEx' => $mediumList, 'hardEx' => $hardList]);
        }

        $user_id = Auth::user()->id;

        /* calculate the progress for easy exercises*/
        $solved_easy = DB::table('users_to_exercise')
            ->join('exercises', "users_to_exercise.ex_id", "=", "exercises.id")
            ->where([['user_id', $user_id],['difficulty', 'lihtne']])
            ->count();
        $all_easy = DB::table('exercises')->where('difficulty', 'lihtne')->count();
        $p_easy = $solved_easy/$all_easy * 100;

        $solved_med = DB::table('users_to_exercise')
            ->join('exercises', "users_to_exercise.ex_id", "=", "exercises.id")
            ->where([['user_id', $user_id],['difficulty', 'keskmine']])
            ->count();
        $all_med = DB::table('exercises')->where('difficulty', 'keskmine')->count();
        $p_med = $solved_med/$all_med * 100;

        $solved_hard = DB::table('users_to_exercise')
            ->join('exercises', "users_to_exercise.ex_id", "=", "exercises.id")
            ->where([['user_id', $user_id],['difficulty', 'raske']])
            ->count();
        $all_hard = DB::table('exercises')->where('difficulty', 'raske')->count();
        $p_hard = $solved_hard/$all_hard * 100;



        $solved = DB::table('users_to_exercise')
            ->where('user_id', $user_id)
            ->pluck('ex_id')
            ->toArray();

        return view ('list' , ['category'=> $category, 'age_group' => $age_group, 'easyEx' => $easyList,
            'mediumEx' => $mediumList, 'hardEx' => $hardList, 'solved' => $solved,
            'p_easy' => $p_easy,'p_med' => $p_med,'p_hard' => $p_hard]);

    }



    public function exercise($category, $age_group, $difficulty, $ex_id){
        /* kui ID järgi teha query, siis oleks palju lühem*/
        $exercise = DB::table('exercises')
            ->where('id', $ex_id)
            ->first();
        $exercise_list = DB::table('exercises')
            ->where([['category', $category], ['age_group', $age_group], ['difficulty', $difficulty] ])
            ->get();

        return view ('exercise', ['exercise' => $exercise, 'exercises' => $exercise_list,
            'difficulty' => $difficulty,'category'=> $category, 'age_group' => $age_group]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
