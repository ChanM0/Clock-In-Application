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


Route::group([
    'middleware' => 'api',
    'prefix' => 'jwt/auth'
], function ($router) {
    Route::post('signup', 'UserAuthController@signup');
    Route::post('login', 'UserAuthController@login');
    Route::post('logout', 'UserAuthController@logout');
    Route::post('refresh', 'UserAuthController@refresh');
    Route::post('me', 'UserAuthController@me');
    Route::get('/users', 'UserAuthController@getAllUsers')->name('clockIn');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'empl/clock'
], function ($router) {
    Route::post('/in', 'ClockInController@clockIn')->name('clockIn');
    Route::put('/out', 'ClockInController@clockOut')->name('clockOut');
    Route::post('/all/logs', 'ClockInController@getAllUsersLogs')->name('getAllUsersLogs');
    Route::post('/day/logs', 'ClockInController@getAllLogsOnThisDay')->name('getAllLogsOnThisDay');
});