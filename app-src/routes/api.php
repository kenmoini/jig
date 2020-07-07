<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function() {
  Route::post('student-login', 'API\StudentLoginController@handleLogin');
  Route::post('access-workshop-event', 'API\StudentLoginController@handleEventID');
  Route::post('activity', 'API\StudentLoginController@handleFrontendActivity');
  Route::post('find-available-events', 'API\StudentLoginController@findAvailableEvents');
});


/*

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

*/