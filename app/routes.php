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

/* NO AUTH REQUIRED */
Route::group(array(), function () {
    Route::get('/', "HomeController@index");
    Route::get('/points', 'PointsController@showLeaderboard');
    Route::get('/oauth/confirm', 'AuthController@loginWithGitHub');
    Route::get('/no-email', 'AppController@noEmail');
});

/* API - NO AUTH REQUIRED */
Route::group(array(), function () {
    Route::get('/api/participants', 'ApiController@getParticipants');
    Route::get('/api/points', 'ApiController@getPoints');
    Route::get('/api/session', 'ApiController@getSessionData');
});

/* LOGGED IN USERS ONLY */
Route::group(array('before' => 'AuthenticationFilter'), function () {
    Route::get('/register/participant', "AppController@applyParticipant");
    Route::get('/register/judge', "AppController@applyJudge");
    Route::post('/apply', 'AppController@processApplication');
});

/* JUDGES ONLY */
Route::group(array('before' => 'StaffFilter'), function () {
    Route::get('/list', 'AppController@listApps');
});

/* ORGANIZERS ONLY */
Route::group(array('before' => 'AdminFilter'), function () {
    Route::get('/decline/{id}', 'AppController@declineJudgeApp');
});


