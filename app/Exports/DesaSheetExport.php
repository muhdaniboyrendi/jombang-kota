<?php

namespace App\Exports;

use App\Models\Desa;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DesaSheetExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Desa::select('id', 'nama')->get();
    }

    /**
     * Define the headings for each column.
     */
    public function headings(): array
    {
        return [
            'ID Desa',
            'Desa',
        ];
    }

    /**
     * Set the title of the sheet.
     */
    public function title(): string
    {
        return 'Data Desa';
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
