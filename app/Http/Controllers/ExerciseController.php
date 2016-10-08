<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercise;
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
        $age_int  = Exercise::getAgeIntFromName($age_group);
        $category_ID = DB::table('categories')->where('name',$category)->pluck('id')->first();
        $easyList = DB::table('exercises')->where([['category_id', $category_ID], ['age_group', $age_int], ['difficulty', 1] ])->get();
        $mediumList = DB::table('exercises')->where([['category_id', $category_ID], ['age_group', $age_int], ['difficulty', 2] ])->get();
        $hardList = DB::table('exercises')->where([['category_id', $category_ID], ['age_group', $age_int], ['difficulty', 3] ])->get();
        return view ('list' , ['category'=> $category, 'age_group' => $age_group, 'easyEx' => $easyList, 'mediumEx' => $mediumList, 'hardEx' => $hardList]);
    }



    public function exercise($category, $age_group, $difficulty, $ex_id){
        $category_ID = DB::table('categories')->where('name',$category)->pluck('id');
        $age_int  = Exercise::getAgeIntFromName($age_group);
        $difficulty_int =Exercise::getDifficultyIntFromName($difficulty);

        /* kui ID järgi teha query, siis oleks palju lühem*/
        $exercise = DB::table('exercises')->where([['category_id', $category_ID], ['age_group', $age_int], ['difficulty', $difficulty_int] ])->first();

        $exercise_list = DB::table('exercises')->where([['category_id', $category_ID], ['age_group', $age_int], ['difficulty', $difficulty_int] ])->get();

        return view ('exercise', ['exercise' => $exercise, 'exercises' => $exercise_list, 'difficulty' => $difficulty,'category'=> $category, 'age_group' => $age_group]);
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
