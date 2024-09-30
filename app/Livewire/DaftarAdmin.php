<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\User;
use Livewire\Component;
use App\Models\Kelompok;
use Livewire\WithPagination;

class DaftarAdmin extends Component
{
    use WithPagination;

    // menangkap data
    public $dataId;
    public $dataDetails;

    // update form
    public $name;
    public $email;
    public $is_admin;
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
        $this->dataDetails = User::with(['kelompok', 'desa'])->find($id);
    }

    public function delete($id) 
    {
        $this->dataId = $id;
        $this->name = User::find($id)->name;
    }

    public function destroy()
    {
        User::find($this->dataId)->delete();

        session()->flash('message', 'Admin berhasil dihapus.');
    }

    public function edit($id) 
    {
        $this->dataId = $id;
        $this->name = User::find($id)->name;
        $this->email = User::find($id)->email;
        $this->is_admin = User::find($id)->is_admin;
        $this->desa_id = User::find($id)->desa_id;
        $this->kelompok_id = User::find($id)->kelompok_id;
    }

    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'email' => 'required|email|unique|max:255|min:3',
        'is_admin' => 'boolean',
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

        User::find($this->dataId)->update(
            [
                'name' => $this->name,
                'email' => $this->email,
                'is_admin' => $this->is_admin,
                'desa_id' => $this->desa_id,
                'kelompok_id' => $this->kelompok_id,
            ]
        );

        session()->flash('updated', 'Data Admin berhasil diperbarui.');
    }

    public function render()
    {
        $users = User::with('kelompok')
            ->where('name', 'like', '%' . $this->search . '%')
            ->whereHas('kelompok', function($query) {
                $query->where('nama', 'like', '%' . $this->kelompok . '%');
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        $kelompoks = Kelompok::all();

        $editDesas = Desa::all();
        $editKelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.daftar-admin', [
            'users' => $users,
            'kelompoks' => $kelompoks,
            'editDesas' => $editDesas,
            'editKelompoks' => $editKelompoks,
            'name' => $this->name
        ]);
    }
}
