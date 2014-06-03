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
    Route::get('/team', 'TeamController@showTeam');
    Route::get('/about', 'AboutController@showAbout');
    Route::get('/signup', 'SignupController@showSignUp');
    Route::get('/privacy', 'PrivacyController@showPrivacyInfo');
    Route::get('/oauth/refusal', 'AuthController@showRefusal');
    Route::get('/oauth/confirm', 'AuthController@loginWithGitHub');
    Route::get('/toggle-optout', 'AuthController@toggleOptout');
});

/* API - NO AUTH REQUIRED */
Route::group(array(), function () {
    Route::get('/api/participants', 'ApiController@getParticipants');
    Route::get('/api/points', 'ApiController@getPoints');
    Route::get('/api/session', 'ApiController@getSessionData');
});

/* LOGGED IN USERS ONLY */
Route::group(array('before' => 'AuthenticationFilter'), function () {
    Route::get('/register/participant', "AppController@showApplyParticipant");
    Route::get('/times/select', "TimeController@showUserTimes");
    Route::get('/times/thanks', "TimeController@showThanks");
    Route::get('/register/judge', "AppController@showApplyJudge");

});

/* CSRF PROTECTED AUTH PAGES */
Route::group(array('before' => 'AuthenticationFilter|csrf'), function () {
    Route::post('/apply/{type}', 'AppController@processApplication');
});

/* JUDGES ONLY */
Route::group(array('before' => 'StaffFilter'), function () {
    Route::get('/list', 'AppController@listApps');
    Route::get('/test/staff', function() {
        return "Staff only test endpoint.";
    });
});

/* ORGANIZERS ONLY */
Route::group(array('before' => 'AdminFilter'), function () {
    Route::get('/decline/{id}', 'AppController@declineJudgeApp');
    Route::get('/test/admin', function() {
        return Response::json(Session::all());
    });
});


