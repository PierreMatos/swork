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
Route::PATCH('user/{id}', 'App\Http\Controllers\API\UserAPIController@update');
Route::GET('login', 'App\Http\Controllers\API\UserAPIController@login');
Route::DELETE('destroy/{id}', 'App\Http\Controllers\API\UserAPIController@destroy');

// Job Experience
Route::POST('job_experience', 'App\Http\Controllers\API\UserAPIController@addJobExperience');
Route::GET('job_experience', 'App\Http\Controllers\API\UserAPIController@getJobExperience');
Route::PATCH('job_experience', 'App\Http\Controllers\API\UserAPIController@updateJobExperience');
Route::DELETE('job_experience', 'App\Http\Controllers\API\UserAPIController@destroyJobExperience');

//OFFER
Route::GET('offer', 'App\Http\Controllers\API\OfferAPIController@index');
Route::GET('offer/{id}', 'App\Http\Controllers\API\OfferAPIController@show');

//GENERAL
Route::GET('countries', 'App\Http\Controllers\API\UserAPIController@countries');
Route::GET('districts', 'App\Http\Controllers\API\UserAPIController@districts');
Route::GET('counties', 'App\Http\Controllers\API\UserAPIController@counties');
Route::GET('locations', 'App\Http\Controllers\API\UserAPIController@locations');
Route::GET('skills', 'App\Http\Controllers\API\UserAPIController@skills');
Route::GET('abilities', 'App\Http\Controllers\API\UserAPIController@abilities');
Route::GET('documentTypes', 'App\Http\Controllers\API\UserAPIController@documentTypes');
Route::GET('workingHours', 'App\Http\Controllers\API\UserAPIController@getWorkingHours');
Route::PATCH('workingHours', 'App\Http\Controllers\API\UserAPIController@updateWorkingHours');
Route::GET('workingAreas', 'App\Http\Controllers\API\UserAPIController@getWorkingAreas');
Route::PATCH('workingAreas', 'App\Http\Controllers\API\UserAPIController@updateWorkingAreas');


Route::POST('uploadfile', 'App\Http\Controllers\API\UserAPIController@uploadFile');


