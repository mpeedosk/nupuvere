<?php

namespace App\Http\Controllers;
use App\Page;
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
        $page = Page::pluck('updated_at')->first();
        return view('home', ['updated' => strtotime($page)]);
    }

    public function back()
    {
            return redirect()->back();
    }

}
