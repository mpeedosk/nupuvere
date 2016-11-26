<?php

namespace App\Http\Controllers;
use App\Exercise;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $page = Page::first();
        if ($page == null){
            $page = new Page;
            $page->content = "";
            $page->save();
        }
        return view('home', ['updated' => strtotime($page->updated_at), 'contact' => $page->content]);
    }

    public function highscore()
    {
        $all_time = DB::table('users')
            ->where([['role', 1],['points', '>', 0]])
            ->orderBy('points', 'desc')
            ->take(100)
            ->get();

        $current_year = DB::table('users')
            ->where([['role', 1], ['points_this_year', '>', 0]])
            ->orderBy('points_this_year', 'desc')
            ->take(100)
            ->get();

        return view('highscore', ['all_time' => $all_time, 'this_year' => $current_year]);
    }

    public function search(Request $request){

        $query = $request->search;
        if (trim($query) == "")
            return view('search', ['exercises' => [], 'query' => $query]);

        $exercises = Exercise::search($query, null, false, true)->get();

        if($exercises->count() === 0){
            $exercises = Exercise::search($query, null, true, true)->get();
        }

        if($exercises->count() === 0){
            $exercises = Exercise::search($query, null)->get();
        }

        if (Auth::guest()) {
            return view('search', ['exercises' => $exercises, 'query' => $query]);

        }

        return view('search', ['exercises' => $exercises, 'query' => $query, 'solved' => Auth::user()->getSolvedEx()]);
    }
}
