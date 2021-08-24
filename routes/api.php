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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([], function(){

    Route::post('login', 'App\Http\Controllers\LoginController@login');

//    Route::get('unauth', 'App\Http\Controllers\AuthController@unAuthMessage')->name('unauth');

    Route::group(['middleware'=>'auth:api'], function(){
//        Route::get('logout', 'Auth\AuthController@logout');//logout
    });
});
