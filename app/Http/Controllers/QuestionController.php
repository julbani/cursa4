<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class QuestionController extends Controller
{
    public function show($id) {
        # get question data
        $question = \App\Question::find($id);
        $answers = \App\Answer::where('question_id', $id)->orderBy('created_at', 'asc')->orderBy('is_chosen', 'desc');
        $subjects = \App\Subject::all();

        return view('question', [
            'question' => $question,
            'answers' => $answers,
            'subjects' => $subjects,
            'chosen_answer' => $question->chosen_answer
        ]);
    }

    public function addGet(Request $request) {
        $subjects = \App\Subject::all();
        return view('ask', compact('subjects'));
    }

    public function addPost(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required|max:2128'
        ]);
    
        if ($validator->fails()) {
            return redirect('/questions/add')
                ->withInput()
                ->withErrors($validator);
        }

        /* add a new question into database */
        $question = new \App\Question;
        $question->title = $request->title;
        $question->content = $request->content;
        $question->points = $request->points;
        $question->subject_id = $request->subject_id;
        $question->user_id = Auth::user()->id;

        $question->save();

        return redirect('questions/'.$question->id);
    }

    public function search(Request $request) {
        $result = \App\Question::where('title', 'like', '%'.$request->q.'%')
                                ->orWhere('content', 'like', '%'.$request->q.'%')->get();
        
        $subjects = \App\Subject::all();
        return view('index', [
            'questions' => $result,
            'is_search' => true,
            'subjects' => $subjects
        ]);
    }

    public function edit(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|max:1024'
        ]);
        $question = \App\Question::find($request->questionId);
        $question->title = $request->title;
        $question->content = $request->content;
        $question->save();
        
        return response()->json([
            'edited_title' => $question->title,
            'edited_content' => $question->content],
            200
        );
    }
}