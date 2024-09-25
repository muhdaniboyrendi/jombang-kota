<?php

namespace App\Livewire;

use App\Models\Generus;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarGenerus extends Component
{
    use WithPagination;

    public $search = '';
    public $kelompok = '';
    
    public $perPage = 10;

    public function delete(Generus $generus) {
        $generus->delete();
    }

    public function render()
    {
        $generuses = Generus::with('kelompok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('jenis_kelamin', 'like', '%' . $this->search . '%')
            ->orWhereHas('kelompok', function ($query) {
                $query->where('nama', 'like', '%' . $this->kelompok . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.daftar-generus', [
            'generuses' => $generuses,
        ]);
    }
}
