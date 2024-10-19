<?php

namespace App\Livewire;

use App\Models\Mt;
use App\Models\Desa;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithPagination;

class DaftarMt extends Component
{
    use WithPagination;

    // menangkap data
    public $dataId;
    public $dataDetails;

    // insert form
    public $nama;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $daerah;
    public $pondok;
    public $no_hp;
    public $mulai_tugas;
    public $selesai_tugas;
    public $desa_id;
    public $kelompok_id;

    // public $desaId;

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
        $this->dataDetails = Mt::with(['kelompok', 'desa'])->find($id);
    }

    public function delete($id) 
    {
        $this->dataId = $id;
        $this->nama = Mt::find($id)->nama;
    }

    public function destroy()
    {
        Mt::find($this->dataId)->delete();

        session()->flash('message', 'Data MT berhasil dihapus.');
    }

    protected $rules = [
        'nama' => 'required|string|max:255|min:3',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255|min:3',
        'jenis_kelamin' => 'required',
        'daerah' => 'required|string|max:255|min:3',
        'pondok' => 'required|string|max:255|min:3',
        'no_hp' => 'numeric|digits_between:9, 14',
        'mulai_tugas' => 'required|date',
        'selesai_tugas' => 'nullable|date',
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

        $mt = Mt::create([
            'nama' => $this->nama,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tempat_lahir' => $this->tempat_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'daerah' => $this->daerah,
            'pondok' => $this->pondok,
            'no_hp' => $this->no_hp,
            'mulai_tugas' => $this->mulai_tugas,
            'selesai_tugas' => $this->selesai_tugas,
            'desa_id' => $this->desa_id,
            'kelompok_id' => $this->kelompok_id,
        ]);

        session()->flash('created', 'Data MT berhasil ditambahkan.');
    
        $this->reset();
    }

    public function render()
    {
        $mts = Mt::with('kelompok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->whereHas('kelompok', function($query) {
                $query->where('nama', 'like', '%' . $this->kelompok . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $searchKelompoks = Kelompok::all();

        $desas = Desa::all();
        $kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.daftar-mt', [
            'mts' => $mts,
            'searchKelompoks' => $searchKelompoks,
            'nama' => $this->nama,
            'desas' => $desas,
            'kelompoks' => $kelompoks
        ]);
    }
}
