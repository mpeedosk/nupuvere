<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercise;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /** Check if the user entered answer is correct
     *
     * @param Request $request
     * @param int $ex_id
     *
     * @return array
     *
     * */
    public function checkAnswer(Request $request, $ex_id)
    {
        $user_id = Auth::user()->id;

        $exercise = DB::table('exercises')
            ->where('id', $ex_id)
            ->first();


        $answers = DB::table('answers')
            ->where('ex_id', $ex_id)
            ->orderBy('order', 'asc')
            ->get();


        // convert the json object from the ajax request to array
        $user_answer = json_decode($request->answers, true);


        $correct = False;

        switch ($exercise->type) {
            case 1:     $correct = $this->hasCorrect($answers, $user_answer[0]); break;
            case 2:     $correct = $this->oneCorrect($answers, $user_answer[0]); break;
            case 3:     $correct = $this->allCorrect($answers, $user_answer);    break;
            case 4:     $correct = $this->inOrder($answers, $user_answer);       break;
        }


        $this->update_db($correct, $user_id, $ex_id);


        if ($request->ajax()) {
            return [
                'response' => $correct,
                'solution' => $exercise->solution,
                'points' => DB::table('users')->where('id', $user_id)->pluck('points')->first()
            ];
        }

        return redirect()->refresh();
    }


    public function viewAnswer(Request $request, $ex_id)
    {

    }

    private function hasCorrect($answers, $user_answer)
    {
        foreach ($answers as $answer) {
            if ($answer->is_correct)
                if (mb_strtolower($answer->content) == mb_strtolower($user_answer))
                    return True;
        }
        return False;
    }

    private function oneCorrect($answers, $user_answer)
    {
        foreach ($answers as $answer) {
            if ($answer->is_correct)
                return mb_strtolower($answer->content) == mb_strtolower($user_answer);
        }
        return False;
    }

    private function allCorrect($answers, $user_answer)
    {
        foreach ($answers as $answer) {
            if ($answer->is_correct) {
                if (!in_array($answer->content, $user_answer))
                    return False;
            } else {
                if (in_array($answer->content, $user_answer)) {
                    return False;
                }
            }
        }
        return True;
    }

    private function inOrder($answers, $user_answer)
    {
        for ($i = 0; $i < count($answers); $i++) {
            if ($answers[$i]->content != $user_answer[$i])
                return False;
        }
        return True;
    }



    /** Update the user points and the statistics
     *
     * @param boolean $correct  - wether the user answered the question correctly
     * @param int $user_id      - authenticated user's id
     * @param int $ex_id        - exercuse id
     *
     * @return void
     *
     * */
    private function update_db($correct, $user_id, $ex_id){
        DB::table('exercises')
            ->where('id', $ex_id)
            ->increment('attempted');

        if ($correct) {
            DB::table('exercises')
                ->where('id', $ex_id)
                ->increment('solved');

            $user_exercise = DB::table('users_to_exercise')
                ->where([['user_id', $user_id], ['ex_id', $ex_id]])
                ->first();

            // if the user is solving for the first time, create the instance
            if($user_exercise == null){
                $inserted_id = DB::table('users_to_exercise')->insertGetId(
                    ['user_id' => $user_id, 'ex_id' => $ex_id]
                );
                $user_exercise = DB::table('users_to_exercise')
                    ->where('id', $inserted_id)
                    ->first();
            }


            // first check if the user has already solved this exercise
            if (!$user_exercise->solved) {
                DB::table('users')
                    ->where('id', $user_id)
                    ->increment('points', Exercise::POINTS_PER_EX);

                DB::table('users_to_exercise')
                    ->where([['user_id', $user_id], ['ex_id', $ex_id]])
                    ->update(['solved' => True]);
            }
        }

    }
}
