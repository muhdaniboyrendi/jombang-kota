<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\Guest;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DaftarGenerus extends Component
{
    use WithPagination;
    use WithFileUploads;

    // menangkap data
    public $dataId;
    public $dataDetails;

    // update form
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
    public $desa_id;
    public $kelompok_id;
    public $daerah;
    public $desa;
    public $kelompok;

    public $desaId;

    // search
    public $search = '';
    public $searchKelompok = '';

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
        $this->dataDetails = Generus::with(['kelompok', 'desa', 'guest'])->find($id);
    }

    public function delete($id) 
    {
        $this->dataId = $id;
        $this->nama = Generus::find($id)->nama;
    }

    public function destroy()
    {
        try {
            // Hapus data dari tabel guests terlebih dahulu
            $guest = Guest::where('generus_id', $this->dataId)->first();
            if ($guest) {
                $guest->delete();
            }

            // Hapus data dari tabel generuses
            $generus = Generus::findOrFail($this->dataId);
            $generus->delete();

            session()->flash('message', 'Data generus berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function edit($id) 
    {
        $generus = Generus::findOrFail($id);

        // Set data ke properti form berdasarkan data yang diambil
        $this->dataId = $generus->id;
        $this->nama = $generus->nama;
        $this->tanggal_lahir = $generus->tanggal_lahir;
        $this->tempat_lahir = $generus->tempat_lahir;
        $this->jenis_kelamin = $generus->jenis_kelamin;
        $this->kelas = $generus->kelas;
        $this->sekolah = $generus->sekolah;
        $this->pekerjaan = $generus->pekerjaan;
        $this->bapak = $generus->bapak;
        $this->ibu = $generus->ibu;
        $this->foto = $generus->foto;
        $this->desa_id = $generus->desa_id;
        $this->kelompok_id = $generus->kelompok_id;
        $this->daerah = optional($generus->guest)->daerah;
        $this->desa = optional($generus->guest)->desa;
        $this->kelompok = optional($generus->guest)->kelompok;
    }

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

    public function update() 
    {
        $this->validate();

        try {
            $generus = Generus::findOrFail($this->dataId);
            
            if ($this->foto) {
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
        $generuses = Generus::with('kelompok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->whereHas('kelompok', function($query) {
                $query->where('nama', 'like', '%' . $this->searchKelompok . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $kelompoks = Kelompok::all();

        $editDesas = Desa::all();
        $editKelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.daftar-generus', [
            'generuses' => $generuses,
            'kelompoks' => $kelompoks,
            'editDesas' => $editDesas,
            'editKelompoks' => $editKelompoks,
            'nama' => $this->nama
        ]);
    }
}
