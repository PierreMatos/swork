<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('get', [App\Http\Controllers\Controller::class, 'get'])->name('get');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/password/reset/{token}/{email}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset2');



Route::get('/password/reset/{token}/{email}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset2');

Route::get('/mailable2', function () {

    $name="ze miguel";
    $token="45ds6a4d56sad4as564df6";
    return new App\Mail\ResetPasswordMail($name, $token);
});

Route::get('/mailable3', function () {

    $name="ze miguel2";
    $email="pierrematos@remotepartner.co";
    $token="45ds6a4d56sad4as564df6";
    return (Mail::to($email)->send(new \App\Mail\ConfirmAccountMail($email, $name, $token)));

    return new App\Mail\ConfirmAccountMail($email, $name, $token);
});