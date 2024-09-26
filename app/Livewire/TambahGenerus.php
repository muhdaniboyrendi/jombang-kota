<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;
use Illuminate\Support\Facades\DB;

class TambahGenerus extends Component
{
    public $nama;
    public $tanggal_lahir;
    public $tempat_lahir;
    public $jenis_kelamin;
    public $kelas;
    public $sekolah;
    public $pekerjaan;
    public $bapak;
    public $ibu;
    public $kelompok_id;

    public $desa_id;

    protected $rules = [
        'nama' => 'required|string|max:255|min:3',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255|min:3',
        'jenis_kelamin' => 'required',
        'kelas' => 'required|string|max:50',
        'sekolah' => 'nullable|string|max:255|min:3',
        'pekerjaan' => 'nullable|string|max:255|min:3',
        'bapak' => 'required|string|max:255|min:3',
        'ibu' => 'required|string|max:255|min:3',
        'kelompok_id' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        Generus::create([
            'nama' => $this->nama,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tempat_lahir' => $this->tempat_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'kelas' => $this->kelas,
            'sekolah' => $this->sekolah,
            'pekerjaan' => $this->pekerjaan,
            'bapak' => $this->bapak,
            'ibu' => $this->ibu,
            'kelompok_id' => $this->kelompok_id,
        ]);

        session()->flash('message', 'Data generus berhasil ditambahkan.');

        $this->reset();
    }

    public function render()
    {
        $desas = Desa::all();
        $kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.tambah-generus', [
            'desas' => $desas,
            'kelompoks' => $kelompoks
        ]);
    }
}
