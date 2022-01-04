<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\UserAPIController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//USER
Route::POST('user', 'App\Http\Controllers\API\UserAPIController@store');
Route::GET('user', 'App\Http\Controllers\API\UserAPIController@show');
Route::PATCH('user', 'App\Http\Controllers\API\UserAPIController@update');
Route::GET('login', 'App\Http\Controllers\API\UserAPIController@login');

//OFFER
Route::GET('offer', 'App\Http\Controllers\API\OfferAPIController@index');

