<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "HomeController@index");

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home');


Route::get('/questions/add', [
	'uses' => 'QuestionController@addGet',
	'as' => 'question.add'
]);

Route::post('/questions/add', 'QuestionController@addPost');

Route::post('/questions/edit', 'QuestionController@edit')->name('edit');

Route::get('/questions/search', 'QuestionController@search');


Route::get('/questions/{id}', "QuestionController@show");

Route::post('/questions/{id}', "AnswerController@add")->name('answer.add');

Route::post('questions/{id}/chooseAnswer', [
	'uses' => "AnswerController@choose",
	'as' => 'answer.choose'
]);

// filter questions by subjects ans chosen answer
Route::post('/', 'HomeController@filter');

Route::post('image-upload', 'ImageUploadController@imageUploadPost')->name('image.upload.post');