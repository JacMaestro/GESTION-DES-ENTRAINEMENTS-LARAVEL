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
    Route::get('/home', function () {
        return view('admin.index');
    }); 
 
    Route::get('/addGamers', 'PlayersController@addGamers')->name('addGamers');
    Route::post('/createGames', 'PlayersController@createGames');
    Route::get('/listsUsers', 'PlayersController@listsUsers')->name('lists.users');
});
Route::group(['middleware' => ['player'], 'prefix' => '/player'], function () { 

    Route::get('/home', function () {
        return view('admin.index');
    });  

});