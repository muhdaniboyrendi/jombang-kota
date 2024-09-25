<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Desa::create([
            'nama' => 'Utara 1',
        ]);
        Desa::create([
            'nama' => 'Utara 2',
        ]);
        Desa::create([
            'nama' => 'Selatan 1',
        ]);
        Desa::create([
            'nama' => 'Selatan 2',
        ]);
    }
}
