<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardKantor;
use App\Http\Controllers\DashboardMerchant;

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PembelianController;


// Sistem Login

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/register-user', [AuthController::class, 'register_user'])->name('register_user');
Route::post('/register', [AuthController::class, 'register'])->name('post-register');
Route::post('/login', [AuthController::class, 'login'])->name('post-login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rute untuk dashboard merchant

Route::get('/merchant-dashboard',[DashboardMerchant::class,'DashboardMerchant'])->middleware(['auth', 'check.level:merchant'])->name('merchant');
Route::get('/merchant-data',[DashboardMerchant::class,'DataMakanan'])->middleware(['auth', 'check.level:merchant'])->name('DataMakanan');
Route::post('/merchant-tambah',[DashboardMerchant::class,'merchant_tambah'])->middleware(['auth', 'check.level:merchant'])->name('merchant_tambah');
Route::post('/merchant-edit/{id}',[DashboardMerchant::class,'merchant_edit'])->middleware(['auth', 'check.level:merchant'])->name('merchant_edit');
Route::get('/merchant-delete/{id}',[DashboardMerchant::class,'merchant_delete'])->middleware(['auth', 'check.level:merchant'])->name('merchant_delete');

// Rute untuk dashboard kantor
Route::get('/kantor-dashboard',[DashboardKantor::class,'DashboardKantor'])->middleware(['auth', 'check.level:kantor'])->name('kantor');
Route::get('/kantor-tambah',[DashboardKantor::class,'kantor-tambah'])->middleware(['auth', 'check.level:kantor'])->name('kantor-tambah');
Route::get('/kantor-cari/{id}',[DashboardKantor::class,'kantor-edit'])->middleware(['auth', 'check.level:kantor'])->name('kantor-cari');




// route sistem marketplace
Route::apiResource('users', UserController::class);
Route::apiResource('menus', MenuController::class);
Route::apiResource('pembelians', PembelianController::class);
Route::apiResource('invoices', InvoiceController::class);
