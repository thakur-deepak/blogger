<?php
Route::get('/test1', function () {
    return 'test1';
});
Route::group(['prefix' => config('constants.API_PREFIX'), 'middleware' => 'CheckHeaders'], function ()
{
    Route::get('/test2', function () {
        return 'test2';
    });
    Route::post('/users', 'UsersController@store');
    Route::group(['middleware' => 'Token'], function()
    {
        Route::get('/users', function () {
            return 'test';
        });
    });
});
