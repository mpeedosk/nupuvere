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
        $page = Page::first();
        if ($page == null){
            $page = new Page;
            $page->content = "";
            $page->save();
        }
        return view('home', ['updated' => strtotime($page->updated_at), 'contact' => $page->content]);
    }

    public function back()
    {
            return redirect()->back();
    }

}
