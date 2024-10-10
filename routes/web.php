<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GenerusController;
use App\Http\Controllers\DashboardController;

// DASHBOARD
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');


// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


// PROFILE
Route::get('/profile/{id}', [AuthController::class, 'profile'])->middleware('auth');
Route::get('/profile-edit/{id}', [AuthController::class, 'edit'])->middleware('auth');
Route::delete('/account-delete/{id}', [AuthController::class, 'destroy'])->middleware('auth');


// GENERUS
Route::get('/generus', function () {
    return view('generus.index', ['title' => 'Generus', 'active' => 'generus']);
})->middleware('auth');

Route::get('/generus-tambah', function () {
    return view('generus.tambah', ['title' => 'Tambah Generus', 'active' => 'generus']);
})->middleware('auth');

Route::get('/print-generus-data/{generus:id}', [GenerusController::class, 'print'])->middleware('auth');


// MT
Route::get('/mt', function () {
    return view('mt.index', ['title' => 'MT', 'active' => 'mt']);
})->middleware('auth');

Route::get('/mt-tambah', function () {
    return view('mt.tambah', ['title' => 'Tambah MT', 'active' => 'mt']);
})->middleware('auth');


// MS
Route::get('/ms', function () {
    return view('ms.index', ['title' => 'MS', 'active' => 'ms']);
})->middleware('auth');

Route::get('/ms-tambah', function () {
    return view('ms.tambah', ['title' => 'Tambah MS', 'active' => 'ms']);
})->middleware('auth');


// ADMIN
Route::get('/admin', function () {
    return view('admin.index', ['title' => 'Admin', 'active' => 'admin']);
})->middleware('auth');

Route::get('/admin-tambah', function () {
    return view('admin.tambah', ['title' => 'Tambah Admin', 'active' => 'admin']);
})->middleware('auth');


// ACARA
Route::get('/acara', function () {
    return view('acara.index', ['title' => 'Acara', 'active' => 'acara']);
})->middleware('auth');

Route::get('/acara/{event}', [EventController::class, 'showAttendance'])->name('acara.kehadiran')->middleware('auth');
Route::post('/acara/{event}/absensi', [EventController::class, 'recordAttendance'])->name('acara.absensi')->middleware('auth');