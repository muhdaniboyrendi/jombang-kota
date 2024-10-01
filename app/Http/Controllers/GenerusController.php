<?php

namespace App\Http\Controllers;

use App\Models\Generus;
use Illuminate\Http\Request;

class GenerusController extends Controller
{
    public function print($id) {
        $generus = Generus::find($id);

        return view('generus.print', ['generus' => $generus]);
    }
}
