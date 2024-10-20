<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheetExport implements WithMultipleSheets
{
    /**
     * Return an array of sheets, each representing a table.
     */
    public function sheets(): array
    {
        return [
            new GenerusSheetExport(),
            new KelompokSheetExport(),
            new DesaSheetExport(),
            new GuestSheetExport(),
        ];
    }
}
