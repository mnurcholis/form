<?php

namespace App\Exports;

use App\Models\Lila;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LilaExport implements FromCollection, WithHeadings
{
    protected $data;
    /**
     * @return \Illuminate\Support\Collection
     */
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
            'NAMA',
            'NIK',
            'KECAMATAN',
            'DESA',
            'ALAMAT',
            'SEKOLAH',
            'KATEGORI',
            'USIA',
            'LiLA',
        ];
    }
}
