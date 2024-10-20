<?php

namespace App\Exports;

use App\Models\Generus;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GenerusSheetExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Generus::select('id', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'kelas', 'sekolah', 'pekerjaan', 'bapak', 'ibu', 'desa_id', 'kelompok_id')->get();
    }

    /**
     * Define the headings for each column.
     */
    public function headings(): array
    {
        return [
            'ID Generus',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Kelas/Status',
            'Sekolah',
            'Pekerjaan',
            'Nama Bapak',
            'Nama Ibu',
            'ID Desa',
            'ID Kelompok',
        ];
    }

    /**
     * Set the title of the sheet.
     */
    public function title(): string
    {
        return 'Data Generus';
    }

    /**
     * Apply styles to the header row (bold for the first row).
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Membuat header di row 1 menjadi bold
            1 => ['font' => ['bold' => true]],
        ];
    }
}
