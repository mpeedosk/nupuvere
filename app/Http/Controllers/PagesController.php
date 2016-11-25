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
        $level = 1;
        $intro = ['You are receiving this email because we received a password reset request for your account.'];
        $outro = ['You are receiving this email because we received a password reset request for your account.'];
        return view('vendor.notifications.email', ['level' => $level, 'introLines' => $intro, 'outroLines' => $outro]);
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
}
