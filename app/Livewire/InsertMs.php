<?php

namespace App\Livewire;

use App\Models\Ms;
use App\Models\Desa;
use Livewire\Component;
use App\Models\Kelompok;

class InsertMs extends Component
{
    public $nama;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $no_hp;
    public $desa_id;
    public $kelompok_id;


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

        Ms::create([
            'nama' => $this->nama,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_hp' => $this->no_hp,
            'desa_id' => $this->desa_id,
            'kelompok_id' => $this->kelompok_id,
        ]);

        session()->flash('message', 'Data MS berhasil ditambahkan.');

        $this->reset();
    }
    
    public function render()
    {
        $desas = Desa::all();
        $kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();
        
        return view('livewire.insert-ms', [
            'desas' => $desas,
            'kelompoks' => $kelompoks
        ]);
    }
}
