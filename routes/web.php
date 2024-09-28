<?php

use App\Livewire\DaftarMt;
use App\Livewire\TambahMt;
use App\Livewire\DaftarGenerus;
use App\Livewire\TambahGenerus;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);


// generus
Route::get('/generus', function () {
    return view('generus.index', ['title' => 'Generus', 'active' => 'generus']);
});
Route::get('/daftar-generus', DaftarGenerus::class);
Route::get('/generus-tambah', function () {
    return view('generus.tambah', ['title' => 'Tambah Generus', 'active' => 'generus']);
});
Route::get('/tambah-generus', TambahGenerus::class);


// MT
Route::get('/mt', function () {
    return view('mt.index', ['title' => 'MT', 'active' => 'mt']);
});
Route::get('/daftar-mt', DaftarMt::class);
Route::get('/mt-tambah', function () {
    return view('mt.tambah', ['title' => 'Tambah MT', 'active' => 'mt']);
});
Route::get('/tambah-mt', TambahMt::class);