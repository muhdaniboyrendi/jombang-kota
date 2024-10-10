<?php

namespace App\Livewire;

use App\Models\Desa;
use Livewire\Component;
use App\Models\Kelompok;

class Profile extends Component
{
    public $desaId;
    public $kelompokId;

    public function render()
    {
        $desa = Desa::where('id', $this->desaId)->get();
        $kelompok = Kelompok::where('id', $this->kelompokId)->get();
        
        return view('livewire.profile', [
            'desa' => $desa,
            'kelompok' => $kelompok,
        ]);
    }
}
