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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');




Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    //No necesito crear ni guardar usuarios puesto que pueden registrarse
    Route::get('/users/delete/{id}', 'UsersController@delete');
    Route::get('/users/fetchData', 'UsersController@fetchData');
    Route::get('/users/search/{search?}', 'UsersController@search');
    Route::resource('/users', 'UsersController', ['except' => ['create', 'store']]);
    
});


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

/*
|--------------------------------------------------------------
| Rutas de las asignaturas
|--------------------------------------------------------------
*/
Route::prefix('subject')->middleware('can:manage-subjects')->group(function(){
    Route::get('/','SubjectController@index')->name('subjectsIndex');
    Route::get('/detail/{subjectName}','SubjectController@detail');
    Route::get('/create','SubjectController@create')->name('subjectCreate');
    Route::post('/create','SubjectController@postForm');
    Route::get('/delete/{name}','SubjectController@delete');
    Route::get('/edit/{name}','SubjectController@edit');
    Route::post('/edit/','SubjectController@update');
});


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
Route::prefix('turn')->middleware('can:manage-turns')->group(function(){
    Route::get('/', 'TurnController@index')->name('turnsIndex');
    Route::get('delete/{id}', 'TurnController@delete');
    Route::get('edit/{id}', 'TurnController@edit');
    Route::get('create', 'TurnController@create')->name('turnCreate');
    Route::post('create', 'TurnController@postForm');
    Route::post('update', 'TurnController@update');
    Route::post('save', 'TurnController@save');
    Route::get('detail/{id}', 'TurnController@detail');
});


/*
Route::get('/login', function() {
    return view('login');
})->name('login');

Route::get('/signup', function(){
    return view('signup');
})->name('signup');
*/