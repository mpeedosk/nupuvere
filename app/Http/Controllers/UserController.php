<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function checkAvailableUser(Request $request)
    {
        $count = DB::table('users')->select('username')->where('username', '=', $request->username)->count();
        if($count>0){
            return response()->json(['response' => 'false']);
        }else{
            return response()->json(['response' => 'true']);
        }

    }
    public function checkAvailableEmail(Request $request)
    {
        $count = DB::table('users')->select('email')->where('email', '=', $request->email)->count();
        if($count>0){
            return response()->json(['response' => 'false']);
        }else{
            return response()->json(['response' => 'true']);
        }
    }
}
