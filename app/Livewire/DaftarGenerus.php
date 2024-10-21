<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\Guest;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Imports\GenerusesImport;
use Maatwebsite\Excel\Facades\Excel;

class DaftarGenerus extends Component
{
    use WithPagination;
    use WithFileUploads;

    // menangkap data
    public $dataId;
    public $dataDetails;

    // insert form
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
    public $no_hp;

    // import
    public $file;
    public $importedRows = 0;
    public $isImporting = false;
    public $importFinished = false;

    public $infoNama;

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
        $this->infoNama = Generus::find($id)->nama;
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

            // Cek apakah generus memiliki foto yang tersimpan
            if ($generus->foto) {
                // Hapus file foto dari storage
                \Storage::disk('public')->delete($generus->foto);
            }

            $generus->delete();

            session()->flash('message', 'Data generus berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    protected $rules = [
        // generuses
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

        // guests
        'daerah' => 'nullable|string|max:255|min:3',
        'desa' => 'nullable|string|max:255|min:3',
        'kelompok' => 'nullable|string|max:255|min:3',
        'no_hp' => 'nullable|numeric|digits_between:9, 14',
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
        if ($this->daerah || $this->desa || $this->kelompok || $this->no_hp) {
            Guest::create([
                'daerah' => $this->daerah,
                'desa' => $this->desa,
                'kelompok' => $this->kelompok,
                'no_hp' => $this->no_hp,
                'generus_id' => $generus->id,
            ]);
        }

        session()->flash('created', 'Data generus berhasil ditambahkan.');
    
        $this->reset();
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $this->isImporting = true;
        $this->importFinished = false;

        try {
            $import = new GenerusesImport($this);
            Excel::import($import, $this->file);

            $this->importedRows = $import->getRowCount();
            $this->importFinished = true;
        } catch (\Exception $e) {
            session()->flash('error-import', 'Error: ' . $e->getMessage());
        }

        $this->isImporting = false;
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

        $searchKelompoks = Kelompok::all();

        $desas = Desa::all();
        $kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.daftar-generus', [
            'generuses' => $generuses,
            'searchKelompoks' => $searchKelompoks,
            'desas' => $desas,
            'kelompoks' => $kelompoks
        ]);
    }
}
