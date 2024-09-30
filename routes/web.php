<?php

use App\Livewire\DaftarMs;
use App\Livewire\DaftarMt;
use App\Livewire\TambahMs;
use App\Livewire\TambahMt;
use App\Livewire\DaftarAdmin;
use App\Livewire\TambahAdmin;
use App\Livewire\DaftarGenerus;
use App\Livewire\TambahGenerus;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);


// AUTH
Route::get('/login', function () {
    return view('auth.login', ['title' => 'Login', 'active' => 'login']);
});


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
