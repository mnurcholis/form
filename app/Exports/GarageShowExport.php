<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GarageShowExport implements FromCollection, WithHeadings
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'TYPE',
            'NAMA SKLH/ORG',
            'NAMA',
            'NO HANDPHONE',
            'EMAIL',
        ];
    }
}
