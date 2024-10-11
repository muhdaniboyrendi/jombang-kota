<?php

namespace App\Http\Controllers;

use App\Models\Generus;
use Illuminate\Http\Request;

class GenerusController extends Controller
{
    public function prints() {
        $generuses = Generus::with('desa', 'kelompok')->get();

        return view('generus.prints', ['generuses' => $generuses]);
    }

    public function print($id) {
        $generus = Generus::with('desa', 'kelompok')->find($id);

        return view('generus.print', ['generus' => $generus]);
    }
}
