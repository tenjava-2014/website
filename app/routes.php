<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', "HomeController@showWelcome");
Route::get('/register', "AppController@applyParticipant");
Route::get('/judge', "AppController@applyJudge");
Route::any('/oauth/confirm', 'AuthController@loginWithGitHub');
Route::post('/apply', 'AppController@processApplication');
Route::get('/list', 'AppController@listApps');
Route::get('/no-email', 'AppController@noEmail');
Route::get('/points', 'PointsController@showLeaderboard');