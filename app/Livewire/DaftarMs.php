<?php

namespace App\Livewire;

use App\Models\Ms;
use App\Models\Desa;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithPagination;

class DaftarMs extends Component
{
    use WithPagination;

    // menangkap data
    public $dataId;
    public $dataDetails;

    // update form
    public $nama;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $no_hp;
    public $desa_id;
    public $kelompok_id;

    public $infoNama;

    // search
    public $search = '';
    public $kelompok = '';

    // table
    public $sortBy = 'created_at';
    public $sortDir  = 'DESC';

    public function setSortBy($sortByField) 
    {
        if($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir == "ASC" ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }
    
    public $perPage = 10;

    public function updatedSearch() 
    {
        $this->resetPage();
    }

    public function modal($id)
    {
        $this->dataId = $id;
        $this->dataDetails = Ms::with(['kelompok', 'desa'])->find($id);
    }

    public function delete($id) 
    {
        $this->dataId = $id;
        $this->infoNama = Ms::find($id)->nama;
    }

    public function destroy()
    {
        Ms::find($this->dataId)->delete();

        session()->flash('message', 'Data MS berhasil dihapus.');
    }

    protected $rules = [
        'nama' => 'required|string|max:255|min:3',
        'tempat_lahir' => 'required|string|max:255|min:3',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required',
        'no_hp' => 'numeric|digits_between:9, 14',
        'desa_id' => 'required',
        'kelompok_id' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        $ms = Ms::create([
            'nama' => $this->nama,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_hp' => $this->no_hp,
            'desa_id' => $this->desa_id,
            'kelompok_id' => $this->kelompok_id,
        ]);

        session()->flash('created', 'Data MS berhasil ditambahkan.');
    
        $this->reset();
    }

    public function render()
    {
        $mses = Ms::with('kelompok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->whereHas('kelompok', function($query) {
                $query->where('nama', 'like', '%' . $this->kelompok . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $searchKelompoks = Kelompok::all();

        $desas = Desa::all();
        $kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.daftar-ms', [
            'mses' => $mses,
            'searchKelompoks' => $searchKelompoks,
            'desas' => $desas,
            'kelompoks' => $kelompoks,
        ]);
    }
}
