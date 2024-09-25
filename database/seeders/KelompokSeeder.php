<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelompok::create([
            'nama' => 'Duren',
            'desa_id' => 1,
        ]);
        Kelompok::create([
            'nama' => 'Kabuh',
            'desa_id' => 1,
        ]);
        Kelompok::create([
            'nama' => 'Kedung Lempuk',
            'desa_id' => 1,
        ]);
        Kelompok::create([
            'nama' => 'Mojo',
            'desa_id' => 2,
        ]);
        Kelompok::create([
            'nama' => 'Juwet',
            'desa_id' => 2,
        ]);
        Kelompok::create([
            'nama' => 'Kepatihan Utara 1',
            'desa_id' => 2,
        ]);
        Kelompok::create([
            'nama' => 'Kepatihan Utara 2',
            'desa_id' => 2,
        ]);
        Kelompok::create([
            'nama' => 'Kepatihan Selatan',
            'desa_id' => 2,
        ]);
        Kelompok::create([
            'nama' => 'Pulo',
            'desa_id' => 2,
        ]);
        Kelompok::create([
            'nama' => 'Bendung Sari 1',
            'desa_id' => 3,
        ]);
        Kelompok::create([
            'nama' => 'Bendung Sari 2',
            'desa_id' => 3,
        ]);
        Kelompok::create([
            'nama' => 'Sumber Bendo 1',
            'desa_id' => 3,
        ]);
        Kelompok::create([
            'nama' => 'Sumber Bendo 2',
            'desa_id' => 3,
        ]);
        Kelompok::create([
            'nama' => 'Dongeng',
            'desa_id' => 3,
        ]);
        Kelompok::create([
            'nama' => 'Sengon',
            'desa_id' => 4,
        ]);
        Kelompok::create([
            'nama' => 'Gondekan',
            'desa_id' => 4,
        ]);
        Kelompok::create([
            'nama' => 'Plandi',
            'desa_id' => 4,
        ]);
    }
}
