<?php

namespace Database\Seeders;

use App\Models\Hasil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hasils')->truncate();

        $data = [
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '001'],
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '002'],
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '003'],
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '004'],
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '005'],
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '006'],
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '007'],
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '008'],
            ['kecamatan' => '3307010', 'desa' => '3307010001', 'tps' => '009'],
        ];

        Hasil::insert($data);
    }
}
