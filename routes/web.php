<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\DaftarGenerus;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/generus', function () {
    return view('generus.index', ['title' => 'Generus', 'active' => 'generus']);
});
Route::get('/daftar-generus', DaftarGenerus::class);