<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class PagesController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function back()
    {
            return redirect()->back();
    }
    /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function exercise(){
//        $users = DB::table('users')->get();
        $exercise = DB::table('exercises')->first();
//        return $ex-> title;
        return view ('exercise')->withExercise($exercise);
//        return view ('exercise');
    }


}
