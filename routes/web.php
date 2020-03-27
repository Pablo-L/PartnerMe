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

Route::group(['prefix'=>'students'], function(){
    Route::get('/', 'StudentController@index');
    Route::get('/detail/{alias}', 'StudentController@detail');
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