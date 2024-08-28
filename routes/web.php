<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ChildController;

// Rute untuk halaman depan
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk reset password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Rute untuk pendaftaran
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rute untuk dashboard (hanya untuk pengguna yang sudah login)
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// Kelompok rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

    // Rute untuk halaman daftar formulir
    Route::get('/forms', [FormController::class, 'index'])->name('forms.index');

    // Rute untuk menampilkan halaman create form
    Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');

    // Rute untuk menyimpan data form
    Route::post('/forms', [FormController::class, 'store'])->name('forms.store');

    // Rute untuk menampilkan halaman edit form
    Route::get('forms/{form}/edit', [FormController::class, 'edit'])->name('forms.edit');

    // Rute untuk mengupdate data form
    Route::put('forms/{form}', [FormController::class, 'update'])->name('forms.update');

    // Rute untuk menghapus form
    Route::delete('forms/{form}', [FormController::class, 'destroy'])->name('forms.destroy');

    // Rute untuk menampilkan detail form
    Route::get('forms/{form}', [FormController::class, 'show'])->name('forms.show');

    // Rute untuk menambahkan child form
    Route::get('forms/{form}/add-child', [FormController::class, 'addChild'])->name('forms.addChild');

    // Rute untuk menyimpan data child
    Route::post('/child/store', [ChildController::class, 'store'])->name('child.store');
});
