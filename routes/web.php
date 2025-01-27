<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
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
Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/users', [ApprovalController::class, 'index'])->name('users.index');
    Route::get('/admin/users/approve/{id}', [ApprovalController::class, 'approve'])->name('users.approve');
    Route::get('/admin/users/reject/{id}', [ApprovalController::class, 'reject'])->name('users.reject');
    Route::get('/admin/ipays/approve/{id}', [ApprovalController::class, 'approveIPay'])->name('ipays.approve');
    Route::get('/admin/ipays/reject/{id}', [ApprovalController::class, 'rejectIPay'])->name('ipays.reject');
    Route::get('/admin/monpays/approve/{id}', [ApprovalController::class, 'approveMonPay'])->name('monpays.approve');
    Route::get('/admin/monpays/reject/{id}', [ApprovalController::class, 'rejectMonPay'])->name('monpays.reject');

    Route::get('/admin/store-master', [StoreController::class, 'getAll'])->name('store-master.index');
    Route::get('/admin/store-master/detail/{id}', [StoreController::class, 'getDetail'])->name('store-master.detail');

    Route::get('/admin/event/index', [EventController::class, 'index'])->name('event.index');
    Route::get('/admin/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/admin/event/add', [EventController::class, 'add'])->name('event.add');
    Route::get('/admin/event/update/{id}', [EventController::class, 'update'])->name('event.update');
    Route::post('/admin/event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');

    Route::get('/merchant/index', [MerchantController::class, 'index'])->name('merchant.index');
    Route::get('/merchant/update', [MerchantController::class, 'update'])->name('merchant.update');
    Route::post('/merchant/edit', [MerchantController::class, 'edit'])->name('merchant.edit');

    Route::get('/store/index', [ProductController::class, 'index'])->name('store.index');
    Route::get('/store/update', [ProductController::class, 'update'])->name('store.update');
    Route::post('/store/edit', [ProductController::class, 'edit'])->name('store.edit');

    Route::get('/payment/index', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/ipay/create', [PaymentController::class, 'createIPay'])->name('ipay.create');
    Route::post('/payment/ipay/add', [PaymentController::class, 'addIPay'])->name('ipay.add');
    Route::get('/payment/monpay/create', [PaymentController::class, 'createMonPay'])->name('monpay.create');
    Route::post('/payment/monpay/add', [PaymentController::class, 'addMonPay'])->name('monpay.add');
});
