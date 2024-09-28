<?php

namespace App\Livewire;

use App\Models\Mt;
use App\Models\Desa;
use Livewire\Component;
use App\Models\Kelompok;

class TambahMt extends Component
{
    public $nama;
    public $tanggal_lahir;
    public $tempat_lahir;
    public $jenis_kelamin;
    public $no_hp;
    public $daerah;
    public $pondok;
    public $mulai_tugas;
    public $selesai_tugas;
    public $desa_id;
    public $kelompok_id;


    protected $rules = [
        'nama' => 'required|string|max:255|min:3',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255|min:3',
        'jenis_kelamin' => 'required',
        'no_hp' => 'numeric|digits_between:9, 14',
        'daerah' => 'required|string|max:255|min:3',
        'pondok' => 'required|string|max:255|min:3',
        'mulai_tugas' => 'required|date|max:255|min:3',
        'selesai_tugas' => 'nullable',
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

        Mt::create([
            'nama' => $this->nama,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tempat_lahir' => $this->tempat_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_hp' => $this->no_hp,
            'daerah' => $this->daerah,
            'pondok' => $this->pondok,
            'mulai_tugas' => $this->mulai_tugas,
            'selesai_tugas' => $this->selesai_tugas,
            'desa_id' => $this->desa_id,
            'kelompok_id' => $this->kelompok_id,
        ]);

        session()->flash('message', 'Data MT berhasil ditambahkan.');

        $this->reset();
    }

    public function render()
    {
        $desas = Desa::all();
        $kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.tambah-mt', [
            'desas' => $desas,
            'kelompoks' => $kelompoks
        ]);
    }
}
