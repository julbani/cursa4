<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class AnswerController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'content' => 'required|max:2128'
        ]);
    
        if ($validator->fails()) {
            return redirect('/questions/'.$request->question_id)
                ->withInput()
                ->withErrors($validator);
        }

        $answer = new \App\Answer;
        $answer->content = $request->content;
        $answer->user_id = Auth::user()->id;
        $answer->question_id = $request->question_id; // hidden input
        $answer->save();
    
        return redirect('questions/'.$request->question_id);
    }

    public function choose(Request $request) {
        $answer = \App\Answer::find($request->answer_id);
        $answer->is_chosen = '1';
        $answer->save();

        // take away points from the person who ask the question
        $user = \App\User::find($answer->question->user_id);
        $user->points -= $answer->question->points;
        $user->save();

        // give points to the person who answer the question
        $answerer = \App\User::find($answer->user_id);
        $answerer->points += $answer->question->points;
        $answerer->save();

        return response()->json();
    }

}