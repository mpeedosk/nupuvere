<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    /**
     * Display the agegroup exercises.
     *
     * @return \Illuminate\Http\Response
     */
    public function explorer(){
        return view ('list');
    }

    /**
     * Display the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function exercise(){
        return view ('exercise');
    }


}
