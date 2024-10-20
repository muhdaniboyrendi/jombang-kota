<?php

namespace App\Http\Controllers;

use App\Models\Ms;
use App\Models\Desa;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class MsController extends Controller
{
    public function index() {
        return view('ms.index', ['title' => 'MS', 'active' => 'ms']);
    }

    public function edit($id) {
        $ms = Ms::find($id);
        $desa = Desa::find($ms->desa_id);
        $kelompok = Kelompok::find($ms->kelompok_id);
        
        return view('ms.edit', [
            'title' => 'Edit Data MS', 
            'active' => 'ms',
            'ms' => $ms,
            'desa' => $desa,
            'kelompok' => $kelompok,
            'msId' => $id,
        ]);
    }
}
