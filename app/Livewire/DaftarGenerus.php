<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithPagination;

class DaftarGenerus extends Component
{
    use WithPagination;

    // menangkap data
    public $dataId;
    public $dataDetails;
    public $dataDesa;
    public $idDesa;

    public $desa_id;

    // search
    public $search = '';
    public $kelompok = '';

    // table
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
        $this->dataDesa = Kelompok::where('id', $this->dataDetails->kelompok_id)->get();
        $idDesa = $this->dataDesa->desa_id;
    }

    public function delete($id) {
        $generus = Generus::find($id);
        $generus->delete();

        return redirect('/generus')->with('message', ' Data Generus berhasil dihapus!');
    }

    public function update() {
        $dataDesa = Kelompok::where('id', $this->dataDetails->kelompok_id)->get();
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

        $editDesas = Desa::all();
        $editKelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.daftar-generus', [
            'generuses' => $generuses,
            'kelompoks' => $kelompoks,
            'editDesas' => $editDesas,
            'editKelompoks' => $editKelompoks,
        ]);
    }
}
