<?php

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
    return view('generus.tambah', ['title' => 'Generus', 'active' => 'generus']);
});
Route::get('/tambah-generus', TambahGenerus::class);