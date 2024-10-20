<?php

namespace App\Exports;

use App\Models\Guest;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuestSheetExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Guest::select('daerah', 'desa', 'kelompok', 'no_hp', 'generus_id')->get();
    }

    /**
     * Define the headings for each column.
     */
    public function headings(): array
    {
        return [
            'Daerah',
            'Desa',
            'Kelompok',
            'No. HP Pengurus',
            'ID Generus',
        ];
    }

    /**
     * Set the title of the sheet.
     */
    public function title(): string
    {
        return 'Data Tempat Sambung';
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
