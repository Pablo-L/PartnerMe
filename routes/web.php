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


Route::group(['prefix'=>'users'], function(){
    Route::get('/', 'UserController@index')->name('usersIndex');
    Route::get('/detail/{alias}', 'UserController@detail');
    Route::get('delete/{alias}', 'UserController@delete');
    Route::get('edit/{alias}', 'UserController@edit');
    Route::get('fetch_data', 'UserController@fetch_data');
    Route::post('save', 'UserController@save');
    Route::post('update', 'UserController@update');  

    Route::get('rating/{id}', 'RatingController@detail')->name('user-rating');
    Route::post('rating/upload', 'RatingController@upload')->name('upload-comment');
});

Route::get('subject','SubjectController@index')->name('subjectsIndex');
Route::get('subject/detail/{subjectName}','SubjectController@detail');
Route::get('subject/create','SubjectController@create')->name('subjectCreate');
Route::post('subject/create','SubjectController@postForm');
Route::get('subject/delete/{name}','SubjectController@delete');
Route::get('subject/edit/{name}','SubjectController@edit');
Route::post('subject/edit/','SubjectController@update');


/*
|--------------------------------------------------------------
| Rutas de los grupos
|--------------------------------------------------------------
*/
Route::group(['prefix'=>'group'], function(){
    Route::get('delete/{id}', 'GroupController@delete');
    Route::get('edit/{id}', 'GroupController@edit');
    Route::get('create', 'GroupController@create')->name('groupCreate');
    Route::post('update', 'GroupController@update');
    Route::post('save', 'GroupController@save');
    Route::get('detail/{id}', 'GroupController@detail');
});

Route::get('my_groups','GroupController@list');
Route::get('groups', 'GroupController@index')->name('groupsIndex');

/*
|--------------------------------------------------------------
| Rutas de los turnos
|--------------------------------------------------------------
*/
Route::group(['prefix'=>'turn'], function(){
    Route::get('delete/{id}', 'TurnController@delete');
    Route::get('edit/{id}', 'TurnController@edit');
    Route::get('create', 'TurnController@create')->name('turnCreate');
    Route::post('create', 'TurnController@postForm');
    Route::post('update', 'TurnController@update');
    Route::post('save', 'TurnController@save');
    Route::get('detail/{id}', 'TurnController@detail');
});

Route::get('turns', 'TurnController@index')->name('turnsIndex');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
