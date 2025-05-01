<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DashboardController;
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

Route::get('/locations/upload', [ManagementController::class, 'showUploadForm'])->name('locations.upload.form');
Route::post('/locations/upload', [ManagementController::class, 'uploadLocations'])->name('locations.upload');

// Route untuk register
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register/{id}', [RegisterController::class, 'showForm'])->name('form.lokasi');

// Route untuk login
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('credential');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/locations', [MapController::class, 'getLocations']);

// Grup route yang memerlukan autentikasi dan status approved
Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    });

    Route::get('/admin/users', [ApprovalController::class, 'index'])->name('users.index');
    Route::get('/admin/users/approve/{id}', [ApprovalController::class, 'approve'])->name('users.approve');
    Route::get('/admin/users/reject/{id}', [ApprovalController::class, 'reject'])->name('users.reject');
    Route::get('/admin/users/delete/{id}', [ApprovalController::class, 'deleteAccount'])->name('users.delete');
    Route::get('/admin/ipays/approve/{id}', [ApprovalController::class, 'approveIPay'])->name('ipays.approve');
    Route::get('/admin/ipays/reject/{id}', [ApprovalController::class, 'rejectIPay'])->name('ipays.reject');
    Route::get('/admin/monpays/approve/{id}', [ApprovalController::class, 'approveMonPay'])->name('monpays.approve');
    Route::get('/admin/monpays/reject/{id}', [ApprovalController::class, 'rejectMonPay'])->name('monpays.reject');
    Route::get('/admin/eventpays/approve/{id}', [ApprovalController::class, 'approveEventPay'])->name('eventpays.approve');
    Route::get('/admin/eventpays/reject/{id}', [ApprovalController::class, 'rejectEventPay'])->name('eventpays.reject');

    Route::get('/admin/store-master', [StoreController::class, 'getAll'])->name('store-master.index');
    Route::get('/admin/store-master/detail/{id}', [StoreController::class, 'getDetail'])->name('store-master.detail');
    Route::get('/cetak-pdf', [StoreController::class, 'printCard'])->name('store.print');

    Route::get('/admin/event/index', [EventController::class, 'index'])->name('event.index');
    Route::get('/admin/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/admin/event/add', [EventController::class, 'add'])->name('event.add');
    Route::get('/admin/event/update/{id}', [EventController::class, 'update'])->name('event.update');
    Route::post('/admin/event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
    Route::post('/admin/event/delete/{id}', [EventController::class, 'delete'])->name('event.delete');

    Route::get('/merchant/index', [MerchantController::class, 'index'])->name('merchant.index');
    Route::get('/merchant/update', [MerchantController::class, 'update'])->name('merchant.update');
    Route::post('/merchant/edit', [MerchantController::class, 'edit'])->name('merchant.edit');
    // Route untuk menampilkan form edit setelah registrasi
    Route::get('/merchant/edit-after-regist', [MerchantController::class, 'updateAfterRegist'])
        ->name('merchant.edit-after-regist');

    // Route untuk memproses form edit setelah registrasi
    Route::post('/merchant/edit-after-regist', [MerchantController::class, 'editAfterRegist'])
        ->name('merchant.update-after-regist');

    Route::get('/store/index', [ProductController::class, 'index'])->name('store.index');
    Route::get('/store/update', [ProductController::class, 'update'])->name('store.update');
    Route::post('/store/edit', [ProductController::class, 'edit'])->name('store.edit');
    Route::get('/store/edit-after-regist', [ProductController::class, 'updateAfterRegist'])
        ->name('store.edit-after-regist');
    Route::post('/store/edit-after-regist', [ProductController::class, 'editAfterRegist'])
        ->name('store.update-after-regist');

    Route::get('/admin/payment', [PaymentController::class, 'indexAdmin'])->name('payment.indexAdmin');
    Route::get('/payment/index', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/ipay/create', [PaymentController::class, 'createIPay'])->name('ipay.create');
    Route::post('/payment/ipay/add', [PaymentController::class, 'addIPay'])->name('ipay.add');
    Route::get('/payment/monpay/create', [PaymentController::class, 'createMonPay'])->name('monpay.create');
    Route::post('/payment/monpay/add', [PaymentController::class, 'addMonPay'])->name('monpay.add');
    Route::get('/payment/eventpay/create', [PaymentController::class, 'createEventPay'])->name('eventpay.create');
    Route::post('/payment/eventpay/add', [PaymentController::class, 'addEventPay'])->name('eventpay.add');
});
