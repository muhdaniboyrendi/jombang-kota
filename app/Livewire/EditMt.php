<?php

namespace App\Livewire;

use App\Models\Mt;
use App\Models\Desa;
use Livewire\Component;
use App\Models\Kelompok;

class EditMt extends Component
{    
    public $mtId;
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
    public $desas = [];
    public $kelompoks = [];

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

    public function mount($mtId)
    {
        $mt = Mt::findOrFail($mtId);
        $this->mtId = $mt->id;
        $this->nama = $mt->nama;
        $this->tempat_lahir = $mt->tempat_lahir;
        $this->tanggal_lahir = $mt->tanggal_lahir;
        $this->jenis_kelamin = $mt->jenis_kelamin;
        $this->daerah = $mt->daerah;
        $this->pondok = $mt->pondok;
        $this->no_hp = $mt->no_hp;
        $this->mulai_tugas = $mt->mulai_tugas;
        $this->selesai_tugas = $mt->selesai_tugas;
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
            $mt = Mt::findOrFail($this->mtId);

            $mt->update([
                'nama' => $this->nama,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'daerah' => $this->daerah,
                'pondok' => $this->pondok,
                'no_hp' => $this->no_hp,
                'mulai_tugas' => $this->mulai_tugas,
                'selesai_tugas' => $this->selesai_tugas,
                'desa_id' => $this->desa_id,
                'kelompok_id' => $this->kelompok_id,
            ]);

            session()->flash('updated', 'Data MT berhasil diperbarui.');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edit-mt');
    }
}
