<?php

use App\Http\Controllers\ApprovalController;
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

// Route untuk register
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('credential');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Grup route yang memerlukan autentikasi dan status approved
// Route::middleware(['auth'])->group(function () {
Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/users', [ApprovalController::class, 'index'])->name('users.index');
    Route::get('/admin/users/approve/{id}', [ApprovalController::class, 'approve'])->name('users.approve');
    Route::get('/admin/users/reject/{id}', [ApprovalController::class, 'reject'])->name('users.reject');
});
