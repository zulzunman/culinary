<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route untuk verifikasi email
// Email verification routes
Route::get('/email/verify', [RegisterController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}', [RegisterController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('signed');

Route::post('/email/verification-notification', [RegisterController::class, 'resendVerification'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
// Route::get('verify/{id}', [RegisterController::class, 'verify'])->name('verification.verify')->middleware('signed');
// Route untuk halaman setelah login
Route::get('/', function () {
    return view('welcome');
})->name('dashboard')->middleware('auth');
