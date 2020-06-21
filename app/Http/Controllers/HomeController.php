<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $questions = \App\Question::whereIn('subject_id', $request->subjects);

        if ($request->is_solved == 'solved') {
            return 'jepa';
            $questions = $questions->whereNotNull('chosen_answer');
        } else if ($request->is_solved == 'not_solved') {
            return 'jepa';
            $questions = $questions->whereNull('chosen_answer');
        }

        $questions = $questions->get();

        $subjects = \App\Subject::all();

        return view('index', compact('questions'), compact('subjects'));
    }
}
