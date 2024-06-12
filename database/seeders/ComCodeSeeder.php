<?php

namespace Database\Seeders;

use App\Models\ComCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('com_codes')->truncate();
        $data = [
            [
                'code_cd' => 'USIA_TP_01', 'code_nm' => '10-14 Tahun', 'code_group' => 'USIA_TP', 'code_value' => '18.5'
            ],
            [
                'code_cd' => 'USIA_TP_02', 'code_nm' => '15-17 Tahun', 'code_group' => 'USIA_TP', 'code_value' => '22'
            ],
            [
                'code_cd' => 'USIA_TP_03', 'code_nm' => 'Lebih Dari 18 Tahun', 'code_group' => 'USIA_TP', 'code_value' => '23.5'
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
            [
                'code_cd' => 'JENIS_SO_01', 'code_nm' => 'Sekolah', 'code_group' => 'JENIS_SO',
            ],
            [
                'code_cd' => 'JENIS_SO_02', 'code_nm' => 'Organisasi', 'code_group' => 'JENIS_SO',
            ],

        ];

        foreach ($data as $item) {
            ComCode::create($item);
        }
    }
}
