<?php
Route::group(['prefix' => config('constants.API_PREFIX'), 'middleware' => ['CheckHeaders', 'Cors']], function ()
{
    Route::post('/users', 'UsersController@store');
    Route::get('/users', 'UsersController@get');
    Route::group(['middleware' => 'Token'], function()
    {
        // Route::get('/users', function () {
        //     return 'User testing';
        // });
    });
});
