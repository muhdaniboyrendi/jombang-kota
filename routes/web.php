<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GenerusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;


// WELCOME
Route::get('/', function () {
    return view('welcome', ['title' => 'Jombang Kota | Selamat Datang']);
})->middleware('guest');


// AUTH
Route::get('/register', function () {
    return view('auth.register', ['title' => 'Register', 'active' => 'register']);
})->middleware('guest');

Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('password/forgot', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// PROFILE
Route::get('/profile/{id}', [AuthController::class, 'profile'])->middleware('auth');
Route::get('/profile-edit/{id}', [AuthController::class, 'edit'])->middleware('auth');
Route::delete('/account-delete/{id}', [AuthController::class, 'destroy'])->middleware('auth');


// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


// GENERUS
Route::get('/generus', function () {
    return view('generus.index', ['title' => 'Generus', 'active' => 'generus']);
})->middleware('auth');

Route::get('/generus-edit/{id}', [GenerusController::class, 'edit'])->middleware('auth');
Route::get('/prints-generus-data', [GenerusController::class, 'prints'])->middleware('auth');
Route::get('/print-generus-data/{id}', [GenerusController::class, 'print'])->middleware('auth');


// MT
Route::get('/mt', function () {
    return view('mt.index', ['title' => 'MT', 'active' => 'mt']);
})->middleware('auth');

Route::get('/mt-tambah', function () {
    return view('mt.tambah', ['title' => 'Tambah MT', 'active' => 'mt']);
})->middleware('auth');

// Route::get('/mt-insert', function () {
//     return view('mt.insert', ['title' => 'Form Mubaligh Tugasan Jombang Kota']);
// });


// MS
Route::get('/ms', function () {
    return view('ms.index', ['title' => 'MS', 'active' => 'ms']);
})->middleware('auth');

Route::get('/ms-tambah', function () {
    return view('ms.tambah', ['title' => 'Tambah MS', 'active' => 'ms']);
})->middleware('auth');

// Route::get('/ms-insert', function () {
//     return view('ms.insert', ['title' => 'Form Mubaligh Setempat Jombang Kota']);
// });


// ADMIN
Route::get('/admin', function () {
    return view('admin.index', ['title' => 'Admin', 'active' => 'admin']);
})->middleware('auth');


// ACARA
Route::get('/acara', function () {
    return view('acara.index', ['title' => 'Acara', 'active' => 'acara']);
})->middleware('auth');

Route::get('/acara/{event}', [EventController::class, 'showAttendance'])->name('acara.kehadiran')->middleware('auth');
Route::post('/acara/{event}/absensi', [EventController::class, 'recordAttendance'])->name('acara.absensi')->middleware('auth');