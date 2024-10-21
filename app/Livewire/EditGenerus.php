<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\Guest;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithFileUploads;

class EditGenerus extends Component
{
    use WithFileUploads;
    
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
    public $foto;
    public $qr_code;
    public $desa_id;
    public $kelompok_id;
    public $daerah;
    public $desa;
    public $kelompok;
    public $no_hp;
    public $desas = [];
    public $kelompoks = [];

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
        'foto' => 'nullable|image|max:1024',
        'desa_id' => 'required|exists:desas,id',
        'kelompok_id' => 'required|exists:kelompoks,id',
        'daerah' => 'nullable|string|max:255|min:3',
        'desa' => 'nullable|string|max:255|min:3',
        'kelompok' => 'nullable|string|max:255|min:3',
        'no_hp' => 'nullable|numeric|digits_between:9, 14',
    ];

    public function mount($generusId)
    {
        $generus = Generus::findOrFail($generusId);
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
        $this->desa_id = $generus->desa_id;
        $this->kelompok_id = $generus->kelompok_id;

        if($generus->guest) {
            $this->daerah = $generus->guest->daerah;
            $this->desa = $generus->guest->desa;
            $this->kelompok = $generus->guest->kelompok;
            $this->no_hp = $generus->guest->no_hp;
        }

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
            $generus = Generus::findOrFail($this->generusId);
            
            if ($this->foto) {
                // Jika ada foto lama, hapus dari storage
                if ($generus->foto) {
                    \Storage::disk('public')->delete($generus->foto);
                }

                $fotoPath = $this->foto->store('fotos', 'public');
                $generus->update(['foto' => $fotoPath]);
            }

            $generus->update([
                'nama' => $this->nama,
                'tanggal_lahir' => $this->tanggal_lahir,
                'tempat_lahir' => $this->tempat_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'kelas' => $this->kelas,
                'sekolah' => $this->sekolah,
                'pekerjaan' => $this->pekerjaan,
                'bapak' => $this->bapak,
                'ibu' => $this->ibu,
                'desa_id' => $this->desa_id,
                'kelompok_id' => $this->kelompok_id,
            ]);

            if ($this->daerah && $this->desa && $this->kelompok) {
                Guest::updateOrCreate(
                    ['generus_id' => $generus->id],
                    [
                        'daerah' => $this->daerah,
                        'desa' => $this->desa,
                        'kelompok' => $this->kelompok,
                        'no_hp' => $this->no_hp,
                    ]
                );
            }

            session()->flash('updated', 'Data generus berhasil diperbarui.');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edit-generus');
    }
}
