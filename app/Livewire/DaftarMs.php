<?php

namespace App\Livewire;

use App\Models\Ms;
use App\Models\Desa;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithPagination;

class DaftarMs extends Component
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
    public $no_hp;
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
        $this->dataDetails = Ms::with(['kelompok', 'desa'])->find($id);
    }

    public function delete($id) 
    {
        $this->dataId = $id;
        $this->nama = Ms::find($id)->nama;
    }

    public function destroy()
    {
        Ms::find($this->dataId)->delete();

        session()->flash('message', 'Data MS berhasil dihapus.');
    }

    public function edit($id) 
    {
        $this->dataId = $id;
        $this->nama = Ms::find($id)->nama;
        $this->tempat_lahir = Ms::find($id)->tempat_lahir;
        $this->tanggal_lahir = Ms::find($id)->tanggal_lahir;
        $this->jenis_kelamin = Ms::find($id)->jenis_kelamin;
        $this->no_hp = Ms::find($id)->no_hp;
        $this->desa_id = Ms::find($id)->desa_id;
        $this->kelompok_id = Ms::find($id)->kelompok_id;
    }

    protected $rules = [
        'nama' => 'required|string|max:255|min:3',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string|max:255|min:3',
        'jenis_kelamin' => 'required',
        'no_hp' => 'numeric|digits_between:9, 14',
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

        Ms::find($this->dataId)->update(
            [
                'nama' => $this->nama,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'no_hp' => $this->no_hp,
                'desa_id' => $this->desa_id,
                'kelompok_id' => $this->kelompok_id,
            ]
        );

        session()->flash('updated', 'Data MS berhasil diperbarui.');
    }

    public function render()
    {
        $mses = Ms::with('kelompok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->whereHas('kelompok', function($query) {
                $query->where('nama', 'like', '%' . $this->kelompok . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $kelompoks = Kelompok::all();

        $editDesas = Desa::all();
        $editKelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.daftar-ms', [
            'mses' => $mses,
            'kelompoks' => $kelompoks,
            'editDesas' => $editDesas,
            'editKelompoks' => $editKelompoks,
            'nama' => $this->nama
        ]);
    }
}
