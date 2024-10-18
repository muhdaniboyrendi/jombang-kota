<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\User;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login', ['title' => 'Login']);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            if (Auth::user()->user_verified === 0) {
                $userId = Auth::id();

                return redirect("/profile/$userId")->with('warning', 'Akun Anda belum diverifikasi. Maka dari itu anda belum bisa mengakses apapun');
            }
    
            return redirect('/');
        }

        return back()->with('error', 'Email or password is incorrect.');
    }

    public function logout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function profile($id) {
        $profile = User::find($id);
        $desa = Desa::find($profile->desa_id);
        $kelompok = Kelompok::find($profile->kelompok_id);
        
        return view('profile.index', [
            'title' => 'Profile', 
            'active' => 'profile',
            'profile' => $profile,
            'desa' => $desa,
            'kelompok' => $kelompok,
        ]);
    }

    public function edit($id) {
        $profile = User::find($id);
        $desa = Desa::find($profile->desa_id);
        $kelompok = Kelompok::find($profile->kelompok_id);
        
        return view('profile.edit', [
            'title' => 'Profile', 
            'active' => 'profile',
            'profile' => $profile,
            'desa' => $desa,
            'kelompok' => $kelompok,
            'userId' => $id,
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if (Auth::id() === $user->id) {
            $user->delete();
            Auth::logout();

            return redirect('/login')->with('message', 'Akun Anda telah dihapus.');
        }

        return redirect()->back()->with('error', 'Anda tidak berhak menghapus akun ini.');
    }
}
