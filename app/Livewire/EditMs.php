<?php

namespace App\Livewire;

use App\Models\Ms;
use App\Models\Desa;
use Livewire\Component;
use App\Models\Kelompok;

class EditMs extends Component
{
    public $msId;
    public $nama;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $no_hp;
    public $desa_id;
    public $kelompok_id;
    public $desas = [];
    public $kelompoks = [];

    protected $rules = [
        'nama' => 'required|string|max:255|min:3',
        'tempat_lahir' => 'required|string|max:255|min:3',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required',
        'no_hp' => 'numeric|digits_between:9, 14',
        'desa_id' => 'required',
        'kelompok_id' => 'required',
    ];

    public function mount($msId)
    {
        $mt = Ms::findOrFail($msId);
        $this->msId = $mt->id;
        $this->nama = $mt->nama;
        $this->tempat_lahir = $mt->tempat_lahir;
        $this->tanggal_lahir = $mt->tanggal_lahir;
        $this->jenis_kelamin = $mt->jenis_kelamin;
        $this->no_hp = $mt->no_hp;
        $this->desa_id = $mt->desa_id;
        $this->kelompok_id = $mt->kelompok_id;

        $this->desas = Desa::all();
        $this->kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();
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

    public function update()
    {
        $this->validate();

        try {
            $ms = Ms::findOrFail($this->msId);

            $ms->update([
                'nama' => $this->nama,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'no_hp' => $this->no_hp,
                'desa_id' => $this->desa_id,
                'kelompok_id' => $this->kelompok_id,
            ]);

            session()->flash('updated', 'Data MS berhasil diperbarui.');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edit-ms');
    }
}
