<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question() {
    	return $this->belongsTo('App\Question', 'question_id');
    }

    public function author() {
    	return $this->belongsTo('App\User', 'user_id');
    }
}