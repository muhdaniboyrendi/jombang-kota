<?php

namespace App\Livewire;

use App\Models\Ms;
use App\Models\Mt;
use App\Models\User;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Kelompok;

class Dashboard extends Component
{
    public function render()
    {
        $totalGenerus = Generus::count();
        $totalMt = Mt::where('selesai_tugas', null)->count();
        $totalMs = Ms::count();
        $totalAdmin = User::count();

        $totalGenerusLakiLaki = Generus::where('jenis_kelamin', 'Laki-laki')->count();
        $totalGenerusPerempuan = Generus::where('jenis_kelamin', 'Perempuan')->count();

        $totalMsLakiLaki = Ms::where('jenis_kelamin', 'Laki-laki')->count();
        $totalMsPerempuan = Ms::where('jenis_kelamin', 'Perempuan')->count();

        $totalGenerusPerKelompok = Kelompok::withCount([
            'generuses as total_generus',
            'generuses as total_laki_laki' => function($query) {
                $query->where('jenis_kelamin', 'Laki-laki');
            },
            'generuses as total_perempuan' => function($query) {
                $query->where('jenis_kelamin', 'Perempuan');
            }
        ])->get();

        $totalMsPerKelompok = Kelompok::withCount([
            'ms as total_ms',
            'ms as total_ms_laki_laki' => function($query) {
                $query->where('jenis_kelamin', 'Laki-laki');
            },
            'ms as total_ms_perempuan' => function($query) {
                $query->where('jenis_kelamin', 'Perempuan');
            }
        ])->get();
        
        return view('livewire.dashboard', [
            'totalGenerus' => $totalGenerus,
            'totalMt' => $totalMt,
            'totalMs' => $totalMs,
            'totalAdmin' => $totalAdmin,
            'totalGenerusLakiLaki' => $totalGenerusLakiLaki,
            'totalGenerusPerempuan' => $totalGenerusPerempuan,
            'totalMsLakiLaki' => $totalMsLakiLaki,
            'totalMsPerempuan' => $totalMsPerempuan,
            'totalGenerusPerKelompok' => $totalGenerusPerKelompok,
            'totalMsPerKelompok' => $totalMsPerKelompok,
        ]);
    }
}
