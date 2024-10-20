<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Generus;
use App\Models\Kelompok;
use App\Exports\MultiSheetExport;
use Maatwebsite\Excel\Facades\Excel;

class GenerusController extends Controller
{
    public function index() {
        return view('generus.index', ['title' => 'Generus', 'active' => 'generus']);
    }

    public function edit($id) {
        $generus = Generus::find($id);
        $desa = Desa::find($generus->desa_id);
        $kelompok = Kelompok::find($generus->kelompok_id);
        
        return view('generus.edit', [
            'title' => 'Edit Data Generus', 
            'active' => 'generus',
            'generus' => $generus,
            'desa' => $desa,
            'kelompok' => $kelompok,
            'generusId' => $id,
        ]);
    }

    public function prints() {
        $generuses = Generus::with('desa', 'kelompok')->get();

        return view('generus.prints', ['generuses' => $generuses]);
    }

    public function print($id) {
        $generus = Generus::with('desa', 'kelompok')->find($id);

        return view('generus.print', ['generus' => $generus]);
    }

    public function export()
    {
        return Excel::download(new MultiSheetExport, 'data-generus-jombang-kota.xlsx');
    }
}
