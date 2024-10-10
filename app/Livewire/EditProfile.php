<?php

namespace App\Livewire;

use App\Models\Desa;
use App\Models\User;
use Livewire\Component;
use App\Models\Kelompok;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditProfile extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $desa_id;
    public $kelompok_id;
    public $desas = [];
    public $kelompoks = [];

    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'email' => 'required|email|unique:users,email,',
        'password' => 'nullable|string|min:8|confirmed',
        'desa_id' => 'required|exists:desas,id',
        'kelompok_id' => 'required|exists:kelompoks,id',
    ];

    public function mount($userId)
    {
        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->desa_id = $user->desa_id;
        $this->kelompok_id = $user->kelompok_id;

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
        $this->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|string|min:6|confirmed',
            'desa_id' => 'required|exists:desas,id',
            'kelompok_id' => 'required|exists:kelompoks,id',
        ]);

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->desa_id = $this->desa_id;
        $user->kelompok_id = $this->kelompok_id;
        $user->save();

        session()->flash('message', 'Akun anda berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
