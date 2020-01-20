<?php
Route::get('/test1', function () {
    return 'test1';
});
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
