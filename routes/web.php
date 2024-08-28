<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController; // Untuk dashboard
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Dashboard Route
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// Route untuk halaman formulir
Route::get('/forms', [FormController::class, 'index'])->name('forms.index');

// Rute untuk menampilkan halaman create form
Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');

// Rute untuk menyimpan data form
Route::post('/forms', [FormController::class, 'store'])->name('forms.store');

// Rute untuk menampilkan halaman edit form
Route::get('forms/{form}/edit', [FormController::class, 'edit'])->name('forms.edit');

// Rute untuk menghapus form
Route::delete('forms/{form}', [FormController::class, 'destroy'])->name('forms.destroy');

// Rute untuk menampilkan detail form
Route::get('forms/{form}', [FormController::class, 'show'])->name('forms.show');

// Rute untuk menambahkan child form
Route::get('forms/{form}/add-child', [FormController::class, 'addChild'])->name('forms.addChild');

// Update a form
Route::put('forms/{form}', [FormController::class, 'update'])->name('forms.update');
