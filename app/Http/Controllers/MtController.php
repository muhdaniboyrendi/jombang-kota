<?php

namespace App\Http\Controllers;

use App\Models\Mt;
use App\Models\Desa;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class MtController extends Controller
{
    public function index() {
        return view('mt.index', ['title' => 'MT', 'active' => 'mt']);
    }

    public function edit($id) {
        $mt = Mt::find($id);
        $desa = Desa::find($mt->desa_id);
        $kelompok = Kelompok::find($mt->kelompok_id);
        
        return view('mt.edit', [
            'title' => 'Edit Data MT', 
            'active' => 'mt',
            'mt' => $mt,
            'desa' => $desa,
            'kelompok' => $kelompok,
            'mtId' => $id,
        ]);
    }
}
