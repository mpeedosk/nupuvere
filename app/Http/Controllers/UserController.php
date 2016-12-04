<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function checkAvailableUser(Request $request, $id)
    {
        if ($id == -1) {
            $count = DB::table('users')->select('username')->where('username', '=', $request->username)->count();
            if ($count > 0) {
                return response()->json(['response' => 'false']);
            } else {
                return response()->json(['response' => 'true']);
            }
        } else {
            $user = DB::table('users')->select('username', 'id')->where('username', '=', $request->username)->first();
            if (!isset($user) || $user->id == $id)
                return response()->json(['response' => 'true']);
            else
                return response()->json(['response' => 'false']);

        }
    }

    public function checkAvailableEmail(Request $request, $id)
    {
        if ($id == -1) {
            $count = DB::table('users')->select('email')->where('email', '=', $request->email)->count();
            if ($count > 0) {
                return response()->json(['response' => 'false']);
            } else {
                return response()->json(['response' => 'true']);
            }
        } else {
            $user = DB::table('users')->select('email', 'id')->where('email', '=', $request->email)->first();
            if (!isset($user) || $user->id == $id)
                return response()->json(['response' => 'true']);
            else
                return response()->json(['response' => 'false']);
        }
    }
}
