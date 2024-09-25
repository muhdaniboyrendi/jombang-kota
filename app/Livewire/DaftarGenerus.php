<?php

namespace App\Livewire;

use App\Models\Generus;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarGenerus extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $generuses = Generus::with('kelompok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('jenis_kelamin', 'like', '%' . $this->search . '%')
            ->orWhereHas('kelompok', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.daftar-generus', [
            'generuses' => $generuses,
        ]);
    }
}
