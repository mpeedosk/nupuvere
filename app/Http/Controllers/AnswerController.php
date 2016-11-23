<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercise;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Boolean;

class AnswerController extends Controller
{
    /** Check if the user entered answer is correct
     *
     * @param Request $request
     * @param int $ex_id
     *
     * @return array : response - whether the users answer was correct, solution - the solution to the exercise,
     * points - user's points after solving
     * @return \Illuminate\Http\RedirectResponse
     *
     * */
    public function checkAnswer(Request $request, $ex_id)
    {
        // get the authenticated user id
        $user_id = Auth::user()->id;

        // get the exercise with the corresponding id
        $exercise = DB::table('exercises')
            ->where('id', $ex_id)
            ->first();

        // get all the answers for the current exercise
        $answers = DB::table('answers')
            ->where('ex_id', $ex_id)
            ->orderBy('order', 'asc')
            ->get();

        // get the user submited answers
        // convert the json object from the ajax request to array

        if ($request->ajax()) {
            $user_answer = json_decode($request->answers, true);

            // default value is false
            $correct = False;

            // different method for each different exercise type
            switch ($exercise->type) {
                case Exercise::TEXTUAL       :
                    $correct = $this->hasCorrect($answers, $user_answer[0]);
                    break;
                case Exercise::MULTIPLE_ONE  :
                    $correct = $this->oneCorrect($answers, $user_answer[0]);
                    break;
                case Exercise::MULTIPLE_MANY :
                    $correct = $this->allCorrect($answers, $user_answer);
                    break;
                case Exercise::ORDERING      :
                    $correct = $this->inOrder($answers, $user_answer);
                    break;
            }

            // update the fields where needed
            $this->update_db($correct, $user_id, $ex_id);

            // if the request was ajax, that means we need to return the data
            return [
                'response' => $correct,
                'solution' => $exercise->solution,
                'points' => DB::table('users')->where('id', $user_id)->pluck('points')->first()
            ];
        }

        $user_answer = $request->input("answer-input");

        $correct = False;

        // different method for each different exercise type
        switch ($exercise->type) {
            case Exercise::TEXTUAL       :
                $correct = $this->hasCorrect($answers, $user_answer);
                break;
        }
        Session::flash('answer-check', $correct);
//        dd($correct);
        // currently we only support ajax request checking so we should never actually reach here
        return redirect('/'.$exercise->category.'/'.$exercise->age_group.'/'.$exercise->difficulty.'/'.$ex_id);
    }

    /** Return the correct answer and solution
     *
     * @param Request $request
     * @param int $ex_id
     *
     * @return array : answers - return the correct answer(s), solution - the solution to the exercise,
     * @return \Illuminate\Http\RedirectResponse
     *
     * */
    public function showAnswer(Request $request, $ex_id)
    {
        // get the authenticated user id
        $user_id = Auth::user()->id;

        // get the exercise with the corresponding id
        $exercise = DB::table('exercises')
            ->where('id', $ex_id)
            ->first();

        // get all the answers for the current exercise
        $answers = DB::table('answers')
            ->where([['ex_id', $ex_id], ['is_correct', True]])
            ->orderBy('order', 'asc')
            ->pluck('content');

        $answer_id = DB::table('answers')
            ->where([['ex_id', $ex_id], ['is_correct', True]])
            ->orderBy('order', 'asc')
            ->pluck('id');

        // convert the array to a serializable object for ajax response
        $correct_answers = json_encode($answers, true);
        $correct_answers_id = json_encode($answer_id, true);

        // bind the user to the current exercise
        $this->bindUserToExercise($user_id, $ex_id);

        $already_seen = DB::table('users_to_exercise')
            ->where([['user_id', $user_id], ['ex_id', $ex_id]])
            ->pluck('seen_answer');

        $already_solved = DB::table('users_to_exercise')
            ->where([['user_id', $user_id], ['ex_id', $ex_id]])
            ->pluck('solved');

        // mark the answer as seen by the user
        DB::table('users_to_exercise')
            ->where([['user_id', $user_id], ['ex_id', $ex_id]])
            ->update(['seen_answer' => True]);

        if ($request->ajax()) {
            return [
                'answers' => $correct_answers,
                'answers_id' =>$correct_answers_id,
                'solution' => $exercise->solution,
                'seenOrSolved' => $already_seen[0] || $already_solved[0]
            ];
        }

        // currently we only support ajax request checking so we should never actually reach here
        return redirect()->refresh();
    }

    /** For textual/numeric answers we check if the users input matches any of the answers in the db
     *
     * @param array $answers - answers from the db
     * @param string $user_answer - answer from the user
     * @return Boolean
     *
     * */
    private function hasCorrect($answers, $user_answer)
    {
        // remove whitespaces and convert to lowercase
        $user_answer = mb_strtolower(preg_replace('/\s*/', '', $user_answer));
        foreach ($answers as $answer) {

            $answer_str = mb_strtolower(preg_replace('/\s*/', '', $answer->content));
            if ($answer->is_correct && $answer_str == $user_answer)
                return True;
        }
        return False;
    }

    /** For multiple choice with one correct we compare the first correct to the users answer
     *
     * @param array $answers - answers from the db
     * @param string $user_answer - answer from the user
     * @return Boolean
     *
     * */
    private function oneCorrect($answers, $user_answer)
    {
        foreach ($answers as $answer) {
            if ($answer->is_correct)
                return $answer->id == $user_answer;
        }
        return False;
    }

    /** For multiple choice with many correct we need to check that
     *  the user has selected only the correct ones and not the
     *  false ones
     *
     * @param array $answers - answers from the db
     * @param array $user_answer - answer from the user
     * @return Boolean
     *
     * */
    private function allCorrect($answers, $user_answer)
    {
        foreach ($answers as $answer) {
            if ($answer->is_correct) {
                if (!in_array($answer->id, $user_answer))
                    return False;
            } else {
                if (in_array($answer->id, $user_answer)) {
                    return False;
                }
            }
        }
        return True;
    }

    /** For ordering we check that the array order is the same
     *
     * @param array $answers - answers from the db
     * @param array $user_answer - answer from the user
     * @return Boolean
     *
     * */
    private function inOrder($answers, $user_answer)
    {
        for ($i = 0; $i < count($answers); $i++) {
            if ($answers[$i]->id!= $user_answer[$i])
                return False;
        }
        return True;
    }


    /** Update the user points and the statistics
     *
     * @param boolean $correct - wether the user answered the question correctly
     * @param int $user_id - authenticated user's id
     * @param int $ex_id - exercuse id
     *
     * @return void
     *
     * */
    private function update_db($correct, $user_id, $ex_id)
    {
        // increment the attempted field
        DB::table('exercises')
            ->where('id', $ex_id)
            ->increment('attempted');

        if ($correct) {
            // increment the solved field
            DB::table('exercises')
                ->where('id', $ex_id)
                ->increment('solved');

            // create a new user_to_exercise entity, if not there
            $user_exercise = $this->bindUserToExercise($user_id, $ex_id);

            // first check if the user has already solved this exercise
            if (!$user_exercise->solved) {

                // check if the user has seen the answer
                if (!$user_exercise->seen_answer){
                    DB::table('users')
                        ->where('id', $user_id)
                        ->increment('points', Exercise::POINTS_PER_EX);
                    DB::table('users')
                        ->where('id', $user_id)
                        ->increment('points_this_year', Exercise::POINTS_PER_EX);
                }

                DB::table('users_to_exercise')
                    ->where([['user_id', $user_id], ['ex_id', $ex_id]])
                    ->update(['solved' => True]);
            }
        }
    }

    /**
     * @param $user_id - current user
     * @param $ex_id - current exercise
     *
     *
     * @return users_to_exercise entity
     *
     * */
    private function bindUserToExercise($user_id, $ex_id)
    {
        $user_exercise = DB::table('users_to_exercise')
            ->where([['user_id', $user_id], ['ex_id', $ex_id]])
            ->first();

        // if the user is solving for the first time, create the instance
        if ($user_exercise == null) {
            $inserted_id = DB::table('users_to_exercise')->insertGetId(
                ['user_id' => $user_id, 'ex_id' => $ex_id]
            );
            $user_exercise = DB::table('users_to_exercise')
                ->where('id', $inserted_id)
                ->first();
        }
        return $user_exercise;
    }
}
