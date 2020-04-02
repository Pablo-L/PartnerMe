<?php

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

use App\Rating;

Route::get('/', function () {
    return view('index');
})->name('main');

Route::get('/login', function() {
	return view('login');
})->name('login');

Route::get('/signup', function(){
	return view('signup');
})->name('signup');


Route::group(['prefix'=>'students'], function(){
    Route::get('/', 'StudentController@index')->name('studentsIndex');
    Route::get('/detail/{alias}', 'StudentController@detail');
	Route::get('delete/{alias}', 'StudentController@delete');
	Route::get('edit/{alias}', 'StudentController@edit');
	Route::get('fetch_data', 'StudentController@fetch_data');
	Route::post('save', 'StudentController@save');
	Route::post('update', 'StudentController@update');	

	Route::get('rating/{id}', 'RatingController@detail')->name('student-rating');
	Route::post('rating/upload', 'RatingController@upload')->name('upload-comment');
});

Route::get('subject','SubjectController@index')->name('subjectsIndex');
Route::get('subject/detail/{subjectName}','SubjectController@detail');
Route::get('subject/create','SubjectController@create');
Route::post('subject/create','SubjectController@postForm');
Route::get('subject/delete/{name}','SubjectController@delete');
Route::get('subject/edit/{name}','SubjectController@edit');
Route::post('subject/edit/','SubjectController@update');

Route::group(['prefix'=>'group'], function(){
	Route::get('/', 'GroupController@index')->name('groupsIndex');
    Route::get('/detail/{id}', 'GroupController@detail');
	Route::get('/delete/{id}', 'GroupController@delete');
	Route::get('/edit/{id}', 'GroupController@edit');
	Route::get('fetch_data', 'GroupController@fetch_data');
	Route::post('save', 'GroupController@save');
	Route::post('update', 'GroupController@update');
});
