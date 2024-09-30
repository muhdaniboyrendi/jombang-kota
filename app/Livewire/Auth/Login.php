<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at === null) {
                Auth::logout();
                session()->flash('error', 'You need to verify your email before logging in.');
                return redirect()->route('verification.notice');
            }

            session()->regenerate();
            return redirect('/');
        } else {
            session()->flash('error', 'Email or password is incorrect.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
