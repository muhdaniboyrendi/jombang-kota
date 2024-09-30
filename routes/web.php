<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);


// AUTH
Route::get('/login', function () {
    return view('auth.login', ['title' => 'Login', 'active' => 'login']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');  // Halaman untuk mengingatkan verifikasi email
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();  // Verifikasi email pengguna

    return redirect('/home');  // Redirect setelah berhasil verifikasi
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();  // Kirim ulang email verifikasi

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// GENERUS
Route::get('/generus', function () {
    return view('generus.index', ['title' => 'Generus', 'active' => 'generus']);
});

Route::get('/generus-tambah', function () {
    return view('generus.tambah', ['title' => 'Tambah Generus', 'active' => 'generus']);
});


// MT
Route::get('/mt', function () {
    return view('mt.index', ['title' => 'MT', 'active' => 'mt']);
});

Route::get('/mt-tambah', function () {
    return view('mt.tambah', ['title' => 'Tambah MT', 'active' => 'mt']);
});


// MS
Route::get('/ms', function () {
    return view('ms.index', ['title' => 'MS', 'active' => 'ms']);
});

Route::get('/ms-tambah', function () {
    return view('ms.tambah', ['title' => 'Tambah MS', 'active' => 'ms']);
});


// ADMIN
Route::get('/admin', function () {
    return view('admin.index', ['title' => 'Admin', 'active' => 'admin']);
});

Route::get('/admin-tambah', function () {
    return view('admin.tambah', ['title' => 'Tambah Admin', 'active' => 'admin']);
});
