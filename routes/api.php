<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserAPIController;

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
Route::POST('sendEmailConfirmation', 'App\Http\Controllers\API\UserAPIController@sendEmailConfirmation');
Route::GET('confirmAccount/{email}', 'App\Http\Controllers\API\UserAPIController@confirmAccount');

Route::GET('/userattachment/{id}/{name}', [UserAPIController::class, 'attachmentGet']);


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return '<h1> cache cleared</h1>';
    // Artisan::call('dump-autoload');
    // return what you wanta
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//USER
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    // Route::POST('login', [AuthController::class, 'login'])->name('login');
    Route::POST('login', [AuthController::class, 'login']);
    Route::GET('login', 'App\Http\Controllers\API\AuthController@login')->name('login2');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::POST('me', 'App\Http\Controllers\API\AuthController@me');
    Route::POST('user', 'App\Http\Controllers\API\UserAPIController@store');
    

    
    // Route::GET('login2', [AuthController::class, 'login']);
    // Route::get('/me', 'App\Http\Controllers\Auth\AuthController@me');
    
});



// LOGIN PROTECTED
Route::middleware('auth:api')->group(function(){

    // USER

    Route::GET('user', 'App\Http\Controllers\API\UserAPIController@show');
    Route::PATCH('user', 'App\Http\Controllers\API\UserAPIController@update');
    Route::DELETE('destroy/{id}', 'App\Http\Controllers\API\UserAPIController@destroy');
   
    Route::GET('workingHours', 'App\Http\Controllers\API\UserAPIController@getWorkingHours');
    Route::PATCH('workingHours', 'App\Http\Controllers\API\UserAPIController@patchWorkingHours');
    Route::GET('workingAreas', 'App\Http\Controllers\API\UserAPIController@getWorkingAreas');
    Route::PATCH('workingAreas', 'App\Http\Controllers\API\UserAPIController@patchWorkingAreas');
    Route::GET('jobcategories', 'App\Http\Controllers\API\UserAPIController@getJobCategories');
    Route::PATCH('jobcategories', 'App\Http\Controllers\API\UserAPIController@patchJobCategories');
    Route::POST('uploadfile', 'App\Http\Controllers\API\UserAPIController@uploadFile');

    Route::PATCH('userAbilities', 'App\Http\Controllers\API\UserAPIController@addUserAbilities');
    Route::GET('userAbilities', 'App\Http\Controllers\API\UserAPIController@userAbilities');
    Route::DELETE('userAbilities', 'App\Http\Controllers\API\UserAPIController@destroyAbilities');

    //CANDIDATO / colaborador
    Route::GET('medicine', 'App\Http\Controllers\API\UserAPIController@getMedicine');
    Route::GET('payroll', 'App\Http\Controllers\API\UserAPIController@getPayroll');
    Route::GET('timesheet', 'App\Http\Controllers\API\UserAPIController@getTimesheet');
    Route::GET('payrollpdf', 'App\Http\Controllers\API\UserAPIController@getPayrollPDF');
    Route::GET('contracts', 'App\Http\Controllers\API\UserAPIController@getContracts');
    Route::GET('contractpdf', 'App\Http\Controllers\API\UserAPIController@getContractPDF');
    Route::GET('recruitments', 'App\Http\Controllers\API\UserAPIController@getRecruitments');
    Route::GET('irs', 'App\Http\Controllers\API\UserAPIController@getIRS');
    Route::GET('workshifts', 'App\Http\Controllers\API\UserAPIController@getWorkShifts');
    Route::GET('workshiftslocals', 'App\Http\Controllers\API\UserAPIController@workshiftlocals');
    Route::GET('workshiftsyears', 'App\Http\Controllers\API\UserAPIController@workshiftyears');
    Route::GET('workshiftsmonths', 'App\Http\Controllers\API\UserAPIController@workshiftmonths');
    Route::PATCH('updateworkshifts', 'App\Http\Controllers\API\UserAPIController@updateWorkShifts');

    Route::GET('qualifications', 'App\Http\Controllers\API\UserAPIController@getQualifications');
    Route::DELETE('qualifications', 'App\Http\Controllers\API\UserAPIController@deleteQualifications');
    Route::PATCH('qualifications', 'App\Http\Controllers\API\UserAPIController@updateQualifications');
    Route::POST('qualifications', 'App\Http\Controllers\API\UserAPIController@postQualifications');

    Route::POST('job_experience', 'App\Http\Controllers\API\UserAPIController@postJobExperience');
    Route::GET('job_experience', 'App\Http\Controllers\API\UserAPIController@getJobExperience');
    Route::PATCH('job_experience', 'App\Http\Controllers\API\UserAPIController@updateJobExperience');
    Route::DELETE('job_experience', 'App\Http\Controllers\API\UserAPIController@destroyJobExperience');

    Route::GET('offerslist', 'App\Http\Controllers\API\UserAPIController@getOffersList');
    Route::POST('offerapply', 'App\Http\Controllers\API\UserAPIController@offerApply');

    Route::POST('/usernewattachment', [UserAPIController::class, 'attachmentNew']);
    // Route::DELETE('/userattachment', [UserAPIController::class, 'attachmentDestroy']);
    Route::GET('/userlistattachments', [UserAPIController::class, 'attachmentList']);

    Route::GET('messages', 'App\Http\Controllers\API\UserAPIController@getMessages');
    Route::POST('messages', 'App\Http\Controllers\API\UserAPIController@postMessages');


});

    //GENERAL
    Route::GET('countries', 'App\Http\Controllers\API\UserAPIController@countries');
    Route::GET('districts', 'App\Http\Controllers\API\UserAPIController@districts');
    Route::GET('counties', 'App\Http\Controllers\API\UserAPIController@counties');
    Route::GET('skills', 'App\Http\Controllers\API\UserAPIController@skills');
    Route::GET('abilities', 'App\Http\Controllers\API\UserAPIController@abilities');
    Route::GET('locations', 'App\Http\Controllers\API\UserAPIController@locations');
    Route::GET('documentTypes', 'App\Http\Controllers\API\UserAPIController@documentTypes');

// Route::middleware('auth:api')->group(function () {
// Job Experience

// });

//OFFER
// Route::middleware('auth:api')->group(function () {

    Route::GET('offer', 'App\Http\Controllers\API\OfferAPIController@index');
    Route::GET('offer/{id}', 'App\Http\Controllers\API\OfferAPIController@show');

// });


// Route::post('register', 'UserAPIController@register');
Route::POST('user', 'App\Http\Controllers\API\UserAPIController@store');
Route::POST('loginverify', 'App\Http\Controllers\API\UserAPIController@loginverify');

//PUBLIC ROUTES (for Register Form)
Route::GET('workingAreasPublic', 'App\Http\Controllers\API\UserAPIController@getWorkingAreasPublic');
Route::GET('jobcategoriesPublic', 'App\Http\Controllers\API\UserAPIController@getJobCategoriesPublic');
Route::GET('workingHoursPublic', 'App\Http\Controllers\API\UserAPIController@getWorkingHoursPublic');
Route::POST('/usernewattachmentpublic', [UserAPIController::class, 'attachmentNewPublic']);











