<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\Guest;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithFileUploads;

class InsertGenerus extends Component
{
    use WithFileUploads;
    
    public $nama;
    public $tanggal_lahir;
    public $tempat_lahir;
    public $jenis_kelamin;
    public $kelas;
    public $sekolah;
    public $pekerjaan;
    public $bapak;
    public $ibu;
    public $foto;
    public $desa_id;
    public $kelompok_id;
    public $daerah;
    public $desa;
    public $kelompok;


    protected $rules = [
        'nama' => 'required|string|max:255|min:3',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255|min:3',
        'jenis_kelamin' => 'required',
        'kelas' => 'required',
        'sekolah' => 'nullable|string|max:255|min:3',
        'pekerjaan' => 'nullable|string|max:255|min:3',
        'bapak' => 'required|string|max:255|min:3',
        'ibu' => 'required|string|max:255|min:3',
        'foto' => 'nullable|image|max:1024',
        'desa_id' => 'required',
        'kelompok_id' => 'required',
        'daerah' => 'nullable|string|max:255|min:3',
        'desa' => 'nullable|string|max:255|min:3',
        'kelompok' => 'nullable|string|max:255|min:3',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        // Cek apakah file foto diunggah
        if ($this->foto) {
                // Jika ada file foto, simpan ke storage
            $fotoPath = $this->foto->store('fotos', 'public');
            if (!$fotoPath) {
                throw new \Exception('Gagal menyimpan file foto.');
            }
        } else {
            // Jika tidak ada foto, set ke null
            $fotoPath = null;
        }

        $generus = Generus::create([
            'nama' => $this->nama,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tempat_lahir' => $this->tempat_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'kelas' => $this->kelas,
            'sekolah' => $this->sekolah,
            'pekerjaan' => $this->pekerjaan,
            'bapak' => $this->bapak,
            'ibu' => $this->ibu,
            'foto' => $fotoPath,
            'desa_id' => $this->desa_id,
            'kelompok_id' => $this->kelompok_id,
        ]);
    
        // Membuat data guest hanya jika daerah diisi
        if ($this->daerah && $this->desa && $this->kelompok) {
            Guest::create([
                'daerah' => $this->daerah,
                'desa' => $this->desa,
                'kelompok' => $this->kelompok,
                'generus_id' => $generus->id,
            ]);
        }

        session()->flash('message', 'Data generus berhasil ditambahkan.');
    
        $this->reset();
    }
    
    public function render()
    {
        $desas = Desa::all();
        $kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();
        
        return view('livewire.insert-generus', [
            'desas' => $desas,
            'kelompoks' => $kelompoks
        ]);
    }
}
