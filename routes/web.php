<?php

use Illuminate\Support\Facades\Route;

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


Route::redirect('/', '/login');

Route::get('/register', 'PlayersController@register')->name('register');

Route::post('/verify', 'PlayersController@verifyLogin')->name('verify');

Route::get('/login', 'PlayersController@login')->name('login'); 
Route::post('/resetPass', 'PlayersController@resetPass')->name('resetPass');
Route::get('/logout', 'PlayersController@logout')->name('logout');
Route::get('/forgot', 'PlayersController@forgot')->name('forgot'); 
Route::post('/createUser', 'PlayersController@createGames')->name('createUser');


Route::group(['middleware' => ['admin'], 'prefix' => '/admin'], function () { 
    
    Route::get('/addGamers', 'PlayersController@addGamers')->name('addGamers');
    Route::post('/createGames', 'PlayersController@createGames');
    Route::get('/listsUsers', 'PlayersController@listsUsers')->name('lists.users');

    Route::get('/newTraining', 'TrainingsController@create')->name('newTraining');
    Route::get('/newNotes', 'TrainingsController@newNotes')->name('newNotes');
    Route::get('/home', 'TrainingsController@index')->name('home');
    Route::get('/teamsInfos', 'TrainingsController@getInfos')->name('getInfos');
    Route::get('/teamsInfos2', 'TrainingsController@getInfos2')->name('getInfos2');
    Route::get('/teamsInfos3', 'TrainingsController@getInfos3')->name('getInfos3');
    Route::get('/playerInfos', 'TrainingsController@playerInfos')->name('playerInfos');
    Route::get('/playerNotes', 'TrainingsController@viewNotes')->name('playerNotes');
    Route::get('/pNotes', 'TrainingsController@pNotes')->name('pNotes');
    
    Route::post('/storeTraining', 'TrainingsController@storeTraining');
    Route::post('/storeWeek', 'TrainingsController@storeWeek');
    Route::post('/saveNotes', 'TrainingsController@storeNotes');
});
Route::group(['middleware' => ['player'], 'prefix' => '/player'], function () { 

    Route::get('/home', function () {
        return view('admin.index');
    });  

});