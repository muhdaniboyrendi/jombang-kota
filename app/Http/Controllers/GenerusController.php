<?php

namespace App\Http\Controllers;

use App\Models\Generus;
use Illuminate\Http\Request;

class GenerusController extends Controller
{
    public function print() {
        $generuses = Generus::with('desa', 'kelompok')->get();

        return view('generus.print', ['generuses' => $generuses]);
    }
}
