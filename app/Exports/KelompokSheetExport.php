<?php

namespace App\Exports;

use App\Models\Kelompok;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KelompokSheetExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kelompok::select('id', 'nama', 'desa_id')->get();
    }

    /**
     * Define the headings for each column.
     */
    public function headings(): array
    {
        return [
            'ID Kelompok',
            'Kelompok',
            'ID Desa',
        ];
    }

    /**
     * Set the title of the sheet.
     */
    public function title(): string
    {
        return 'Data Kelompok';
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
