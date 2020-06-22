<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index() {
        $questions = \App\Question::orderBy('created_at', 'desc')->get();
        $subjects = \App\Subject::all();
        return view('index', compact('questions'), compact('subjects'));
    }

    public function filter(Request $request) {

        if ($request->subjects)
            $questions = \App\Question::whereIn('subject_id', $request->subjects);
        else
            $questions = new \App\Question;

        $questions = $questions->get();

        $subjects = \App\Subject::all();

        return view('index', compact('questions'), compact('subjects'));
    }
}



        // if ($request->is_solved == 'solved') {
        //     $questions = $questions->select('questions.id', 'questions.title', 'questions.content', 'questions.created_at', 'questions.user_id', 'questions.subject_id', 'questions.points', 'answers.is_chosen')->join('answers', 'questions.id', '=', 'answers.question_id')->where('answers.is_chosen', '=', '1');
        // } else if ($request->is_solved == 'not_solved') {
        //     $questions = $questions->select('questions.id', 'questions.title', 'questions.content', 'questions.created_at', 'questions.user_id', 'questions.subject_id', 'questions.points', 'answers.is_chosen')->join('answers', 'questions.id', '=', 'answers.question_id')->where('answers.is_chosen', '=', '0');
        // }

