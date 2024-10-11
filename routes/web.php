<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GenerusController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// DASHBOARD
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);


// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth', 'verified']);

Route::get('/email/verify', function () {
    return view('auth.verify-email', ['title' => 'Email Verification']);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// PROFILE
Route::get('/profile/{id}', [AuthController::class, 'profile'])->middleware(['auth', 'verified']);
Route::get('/profile-edit/{id}', [AuthController::class, 'edit'])->middleware(['auth', 'verified']);
Route::delete('/account-delete/{id}', [AuthController::class, 'destroy'])->middleware(['auth', 'verified']);


// GENERUS
Route::get('/generus', function () {
    return view('generus.index', ['title' => 'Generus', 'active' => 'generus']);
})->middleware(['auth', 'verified']);

Route::get('/generus-tambah', function () {
    return view('generus.tambah', ['title' => 'Tambah Generus', 'active' => 'generus']);
})->middleware(['auth', 'verified']);

Route::get('/generus-insert', function () {
    return view('generus.insert', ['title' => 'Form Generus Jombang Kota']);
});

Route::get('/print-generus-data/{generus:id}', [GenerusController::class, 'print'])->middleware(['auth', 'verified']);


// MT
Route::get('/mt', function () {
    return view('mt.index', ['title' => 'MT', 'active' => 'mt']);
})->middleware(['auth', 'verified']);

Route::get('/mt-tambah', function () {
    return view('mt.tambah', ['title' => 'Tambah MT', 'active' => 'mt']);
})->middleware(['auth', 'verified']);

Route::get('/mt-insert', function () {
    return view('mt.insert', ['title' => 'Form Mubaligh Tugasan Jombang Kota']);
});


// MS
Route::get('/ms', function () {
    return view('ms.index', ['title' => 'MS', 'active' => 'ms']);
})->middleware(['auth', 'verified']);

Route::get('/ms-tambah', function () {
    return view('ms.tambah', ['title' => 'Tambah MS', 'active' => 'ms']);
})->middleware(['auth', 'verified']);


// ADMIN
Route::get('/admin', function () {
    return view('admin.index', ['title' => 'Admin', 'active' => 'admin']);
})->middleware(['auth', 'verified']);

Route::get('/admin-tambah', function () {
    return view('admin.tambah', ['title' => 'Tambah Admin', 'active' => 'admin']);
})->middleware(['auth', 'verified']);


// ACARA
Route::get('/acara', function () {
    return view('acara.index', ['title' => 'Acara', 'active' => 'acara']);
})->middleware(['auth', 'verified']);

Route::get('/acara/{event}', [EventController::class, 'showAttendance'])->name('acara.kehadiran')->middleware(['auth', 'verified']);
Route::post('/acara/{event}/absensi', [EventController::class, 'recordAttendance'])->name('acara.absensi')->middleware(['auth', 'verified']);