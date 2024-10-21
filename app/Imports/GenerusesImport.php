<?php

namespace App\Imports;

use App\Models\Generus;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class GenerusesImport implements ToModel, WithHeadingRow, WithChunkReading
{
    protected $livewire;
    protected $rowCount = 0;

    public function __construct($livewire)
    {
        $this->livewire = $livewire;
    }

    public function model(array $row)
    {
        $this->rowCount++;
        
        // Update progress setiap 100 baris
        if ($this->rowCount % 100 === 0) {
            $this->livewire->importedRows = $this->rowCount;
        }

        return new Generus([
            'nama' => $row['nama'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'kelas' => $row['kelas'],
            'sekolah' => $row['sekolah'],
            'pekerjaan' => $row['pekerjaan'],
            'bapak' => $row['bapak'],
            'ibu' => $row['ibu'],
            'desa_id' => $row['desa_id'],
            'kelompok_id' => $row['kelompok_id'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}
