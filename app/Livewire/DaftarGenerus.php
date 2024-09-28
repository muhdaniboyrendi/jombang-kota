<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class DaftarGenerus extends Component
{
    use WithPagination;

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
    public $desa_id;
    public $kelompok_id;

    public $desaId;

    // search
    public $search = '';
    public $kelompok = '';

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
        $this->dataDetails = Generus::with(['kelompok', 'desa'])->find($id);
    }

    public function delete($id) 
    {
        $this->dataId = $id;
        $this->nama = Generus::find($id)->nama;
    }

    public function destroy()
    {
        Generus::find($this->dataId)->delete();

        session()->flash('message', 'Data generus berhasil dihapus.');
    }

    public function edit($id) 
    {
        $this->dataId = $id;
        $this->nama = Generus::find($id)->nama;
        $this->tempat_lahir = Generus::find($id)->tempat_lahir;
        $this->tanggal_lahir = Generus::find($id)->tanggal_lahir;
        $this->jenis_kelamin = Generus::find($id)->jenis_kelamin;
        $this->kelas = Generus::find($id)->kelas;
        $this->sekolah = Generus::find($id)->sekolah;
        $this->pekerjaan = Generus::find($id)->pekerjaan;
        $this->bapak = Generus::find($id)->bapak;
        $this->ibu = Generus::find($id)->ibu;
        $this->desa_id = Generus::find($id)->desa_id;
        $this->kelompok_id = Generus::find($id)->kelompok_id;
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
        'desa_id' => 'required',
        'kelompok_id' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update() 
    {
        $this->validate();

        Generus::find($this->dataId)->update(
            [
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
            ]
        );

        session()->flash('updated', 'Data generus berhasil diperbarui.');
    }

    public function render()
    {
        $generuses = Generus::with('kelompok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->whereHas('kelompok', function($query) {
                $query->where('nama', 'like', '%' . $this->kelompok . '%');
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
