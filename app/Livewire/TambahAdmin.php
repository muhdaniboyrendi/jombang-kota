<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\User;
use Livewire\Component;
use App\Models\Kelompok;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class TambahAdmin extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $is_admin = false;
    public $desa_id;
    public $kelompok_id;


    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'is_admin' => 'boolean',
        'desa_id' => 'required',
        'kelompok_id' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_admin' => $this->is_admin,
            'desa_id' => $this->desa_id,
            'kelompok_id' => $this->kelompok_id,
        ]);

        event(new Registered($user));

        session()->flash('message', 'Admin baru berhasil ditambahkan. Silahkan minta pengguna untuk memverifikasi email');

        $this->reset();
    }

    public function render()
    {
        $desas = Desa::all();
        $kelompoks = Kelompok::where('desa_id', $this->desa_id)->get();

        return view('livewire.tambah-admin', [
            'desas' => $desas,
            'kelompoks' => $kelompoks
        ]);
    }
}
