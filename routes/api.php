<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login')->name('login');
    Route::post('forgot-password', 'UserController@forgotPassword');
});

Route::get('user', 'UserController@authenticatedUser');
Route::group(['middleware' => 'auth:users'], function () {
    Route::prefix('user')->group(function () {
        Route::post('logout', 'UserController@logout');
        Route::get('user', 'UserController@authenticatedUser');
    });
});
