<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return redirect()->route('home');
        } else {
            session()->flash('error', 'Email or password is incorrect.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
