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

Route::group(['prefix'=>'students'], function(){
    Route::get('/', 'StudentController@index')->name('studentsIndex');
    Route::get('/detail/{alias}', 'StudentController@detail');
	Route::get('delete/{alias}', 'StudentController@delete');
	Route::post('save', 'StudentController@save');
	Route::post('update', 'StudentController@update');
});

/*
Route::group(['prefix'=>'frutas'], function(){
	Route::get('index', 'FrutaController@index');
	Route::get('detail/{id}', 'FrutaController@detail');
	Route::get('crear', 'FrutaController@create');
	Route::post('save', 'FrutaController@save');
	Route::get('delete/{id}', 'FrutaController@delete');
	Route::get('editar/{id}', 'FrutaController@edit');
	Route::post('update', 'FrutaController@update');
});*/