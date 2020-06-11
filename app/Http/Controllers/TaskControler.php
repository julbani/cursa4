<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskControler extends Controller
{
    // Show all available tasks
    public function show() {
        $tasks = \App\Task::orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    public function createTask(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
    
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
    
        $task = new \App\Task;
        $task->name = $request->name;
        $task->save();
    
        return redirect('/');
    }

    public function deleteTask(\App\Task $task) {
        $task->delete();
    
        return redirect('/');
    }
}
