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

Route::prefix('v1')->group(function () {
    Route::post('/users', 'UsersController@store');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Route::post('/users', function (Request $request) {
//    App\User::create(request(['name', 'email', 'password']));
// });



Route::fallback(function() {
    $errors_response['error'] = 'Not found';
    $errors_response['message'] = 'page not found';
    $errors_response['status'] = 404;
    return response()->json([
        'data' => $errors_response]);
});