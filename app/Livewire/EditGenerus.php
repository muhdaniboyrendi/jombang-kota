<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;

class EditGenerus extends Component
{
    public $generusId;
    public $nama;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $kelas;
    public $sekolah;
    public $pekerjaan;
    public $bapak;
    public $ibu;
    public $qr_code;
    public $desa_id;
    public $kelompok_id;
    public $desas = [];
    public $kelompoks = [];

    public $showScanner = true;
    public $showForm = false;

    // public $desas;
    // public $kelompoks;

    protected $rules = [
        'nama' => 'required|string|max:255|min:3',
        'tempat_lahir' => 'required|string|max:255|min:3',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'kelas' => 'required|string|max:50',
        'sekolah' => 'nullable|string|max:255|min:3',
        'pekerjaan' => 'nullable|string|max:255|min:3',
        'bapak' => 'required|string|max:255|min:3',
        'ibu' => 'required|string|max:255|min:3',
        'desa_id' => 'required|exists:desas,id',
        'kelompok_id' => 'required|exists:kelompoks,id',
    ];

    public function mount()
    {
        $this->desas = Desa::all();
        $this->kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();
        // $this->kelompoks = collect();
        // $this->kelompoks = Kelompok::all();
    }

    public function render()
    {
        return view('livewire.edit-generus');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedDesaId($value)
    {
        $this->kelompoks = Kelompok::where('desa_id', $value)->get();
        $this->kelompok_id = null;
    }

    // public function updatedDesaId($value)
    // {
    //     $this->kelompoks = Kelompok::where('desa_id', $value)->get();
    //     $this->kelompok_id = '';
    // }

    public function scanQrCode($qrCode)
    {
        $generus = Generus::where('qr_code', $qrCode)->first();

        if ($generus) {
            $this->generusId = $generus->id;
            $this->nama = $generus->nama;
            $this->tempat_lahir = $generus->tempat_lahir;
            $this->tanggal_lahir = $generus->tanggal_lahir;
            $this->jenis_kelamin = $generus->jenis_kelamin;
            $this->kelas = $generus->kelas;
            $this->sekolah = $generus->sekolah;
            $this->pekerjaan = $generus->pekerjaan;
            $this->bapak = $generus->bapak;
            $this->ibu = $generus->ibu;
            $this->qr_code = $generus->qr_code;
            $this->desa_id = $generus->desa_id;
            $this->kelompok_id = $generus->kelompok_id;

            $this->showScanner = false;
            $this->showForm = true;
        } else {
            $this->addError('qrCode', 'Data generus tidak ditemukan');
        }
    }

    public function updateGenerus()
    {
        $this->validate();

        $generus = Generus::findOrFail($this->generusId);
        $generus->update([
            'nama' => $this->nama,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'kelas' => $this->kelas,
            'sekolah' => $this->sekolah,
            'pekerjaan' => $this->pekerjaan,
            'bapak' => $this->bapak,
            'ibu' => $this->ibu,
            'desa_id' => $this->desa_id,
            'kelompok_id' => $this->kelompok_id,
        ]);

        session()->flash('message', 'Data generus berhasil diperbarui.');
    }

    public function getListeners()
    {
        return ['qrCodeScanned' => 'scanQrCode'];
    }
}
