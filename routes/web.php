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

Route::get('/', function () {
    return view('index');
})->name('main');

Route::get('/login', function() {
	return view('login');
})->name('login');

Route::get('/signup', function(){
	return view('signup');
})->name('signup');

Route::get('/rating', function(){
	return view('rating.rating-page');
});

Route::group(['prefix'=>'students'], function(){
    Route::get('/', 'StudentController@index')->name('studentsIndex');
    Route::get('/detail/{alias}', 'StudentController@detail');
	Route::get('delete/{alias}', 'StudentController@delete');
	Route::get('edit/{alias}', 'StudentController@edit');
	Route::get('fetch_data', 'StudentController@fetch_data');
	Route::post('save', 'StudentController@save');
	Route::post('update', 'StudentController@update');	
});

