<?php

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

Route::group(['prefix' => config('constants.API_PREFIX'), 'middleware' => 'CheckHeaders'], function ()
{
    Route::post('/users', 'UsersController@store');
    Route::group(['middleware' => 'Token'], function()
    {
        Route::get('/users', function () {
            return 'test';
        });
    });
});
