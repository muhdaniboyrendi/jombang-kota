<?php

namespace App\Livewire;

use App\Models\Generus;
use App\Models\Kelompok;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarGenerus extends Component
{
    use WithPagination;

    public $dataId;
    public $dataDetails;

    public $search = '';
    public $kelompok = '';

    public $sortBy = 'created_at';
    public $sortDir  = 'DESC';

    public function setSortBy($sortByField) {
        if($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir == "ASC" ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }
    
    public $perPage = 10;

    public function updatedSearch() {
        $this->resetPage();
    }

    public function modal($id)
    {
        $this->dataId = $id;
        $this->dataDetails = Generus::find($id);
    }

    public function delete(Generus $generus) {
        $generus->delete();

        session()->flash('message', 'Data generus berhasil dihapus.');
    }

    public function render()
    {
        $generuses = Generus::with('kelompok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->whereHas('kelompok', function($query) {
                $query->where('nama', 'like', '%' . $this->kelompok . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $kelompoks = Kelompok::all();

        return view('livewire.daftar-generus', [
            'generuses' => $generuses,
            'kelompoks' => $kelompoks,
        ]);
    }
}
