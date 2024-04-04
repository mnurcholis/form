<?php

namespace Database\Seeders;

use App\Models\ComCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code_cd' => 'USIA_TP_01', 'code_nm' => '10-14 Tahun', 'code_group' => 'USIA_TP',
            ],
            [
                'code_cd' => 'USIA_TP_02', 'code_nm' => '15-17 Tahun', 'code_group' => 'USIA_TP',
            ],
            [
                'code_cd' => 'USIA_TP_03', 'code_nm' => 'Lebih Dari 18 Tahun', 'code_group' => 'USIA_TP',
            ],
            [
                'code_cd' => 'KATEGORI_TP_01', 'code_nm' => 'Remaja Putri', 'code_group' => 'KATEGORI_TP',
            ],
            [
                'code_cd' => 'KATEGORI_TP_02', 'code_nm' => 'Calon Pengantin', 'code_group' => 'KATEGORI_TP',
            ],
            [
                'code_cd' => 'KATEGORI_TP_03', 'code_nm' => 'Ibu Hamil', 'code_group' => 'KATEGORI_TP',
            ],
            [
                'code_cd' => 'KATEGORI_TP_04', 'code_nm' => 'Ibu Menyusui', 'code_group' => 'KATEGORI_TP',
            ],

        ];

        foreach ($data as $item) {
            ComCode::create($item);
        }
    }
}
