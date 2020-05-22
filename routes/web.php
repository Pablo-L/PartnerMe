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

use App\Http\Controllers\SubjectController;

Route::get('/', function () {
    return view('index');
})->name('main');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users', 'can:puntuate-users')->group(function(){
    //No necesito crear ni guardar usuarios puesto que pueden registrarse
    Route::get('delete/{id}', 'UsersController@delete')->name('delete');
    Route::get('deleteSearch/{id}', 'UsersController@deleteSearch')->name('deleteFromSearch');
    Route::get('fetchData', 'UsersController@fetchData')->name('fetch_data');
    Route::get('search/{search?}', 'UsersController@search')->name('search');
});


Route::resource('admin/users', 'Admin\UsersController',['as' => 'admin'], ['names' => ['index' => 'users.index']] , ['except' => ['create', 'store']]);

Route::get('/getUsers', 'Admin\UsersController@getUsers');
Route::get('/searchUsers/{query}/{special?}', 'Admin\UsersController@searchUsers');

Route::get('rating/{id}', 'RatingController@detail')->name('user-rating');
Route::get('rating/delete/{creatorId}/{receiverId}/{ratingId}', 'RatingController@delete')->name('delete-comment');
Route::post('rating/upload/{authUser?}', 'RatingController@upload')->name('upload-comment');


/*
|--------------------------------------------------------------
| Rutas de las asignaturas
|--------------------------------------------------------------
*/
Route::prefix('subject')->middleware('can:manage-subjects')->group(function(){
    Route::get('/','SubjectController@index')->name('subjectsIndex');
    Route::get('/create','SubjectController@create')->name('subjectCreate');
    Route::post('/create','SubjectController@postForm');
    Route::get('/delete/{name}','SubjectController@delete')->name('subjectDelete');
    Route::get('/edit/{name}','SubjectController@edit')->name('subjectEdit');
    Route::post('/edit','SubjectController@update');
});

Route::get('subject/detail/{subjectName}','SubjectController@detail')->name('subjectDetail');
Route::get('/searchSubjects/{query}', 'SubjectController@searchSubjects');

/*
|--------------------------------------------------------------
| Rutas de los grupos
|--------------------------------------------------------------
*/
Route::group(['prefix'=>'group'], function(){
    Route::get('delete/{id}', 'GroupController@delete')->name('groupDelete');
    Route::get('edit/{id}', 'GroupController@edit')->name('groupEdit');
    Route::get('create', 'GroupController@create')->name('groupCreate');
    Route::post('update/{group}', 'GroupController@update')->name('groupUpdate');
    Route::post('save', 'GroupController@save');
    Route::get('detail/{id}', 'GroupController@detail');
});

Route::get('my_groups','GroupController@list');
Route::get('groups', 'GroupController@index')->name('groupsIndex');
Route::get('/searchGroups/{query}', 'GroupController@searchGroups');

/*
|--------------------------------------------------------------
| Rutas de los turnos
|--------------------------------------------------------------
*/
Route::prefix('turn')->middleware('can:manage-turns')->group(function(){
    Route::get('/', 'TurnController@index')->name('turnsIndex');
    Route::get('delete/{id}', 'TurnController@delete')->name('turnDelete');
    Route::get('edit/{id}', 'TurnController@edit')->name('turnEdit');
    Route::get('create', 'TurnController@create')->name('turnCreate');
    Route::post('create', 'TurnController@postForm');
    Route::post('update', 'TurnController@update');
    Route::post('save', 'TurnController@save');
});

Route::get('/turn/detail/{id}', 'TurnController@detail');
Route::get('/searchTurns/{query}', 'TurnController@searchTurns');
Route::get('turn/getTurns/{id}', 'TurnController@getTurnsOfSubject');


/*
Route::get('/login', function() {
    return view('login');
})->name('login');

Route::get('/signup', function(){
    return view('signup');
})->name('signup');
*/