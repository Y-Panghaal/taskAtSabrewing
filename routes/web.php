<?php

use Illuminate\Support\Facades\Auth;
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

Route::redirect('/', '/login');
Route::middleware('guest')->group(function() {
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);
    Route::get('/register', [\App\Http\Controllers\RegistrationController::class, 'index']);
    Route::post('/validate', [\App\Http\Controllers\RegistrationController::class, 'validateForm']);
    Route::get('/login/google', [\App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);
    Route::get('/login/google/callback', [\App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);
});
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
});
