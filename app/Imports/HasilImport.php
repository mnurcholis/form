<?php

namespace App\Imports;

use App\Models\Hasil;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithValidation;

class HasilImport  implements ToModel, WithHeadingRow, WithProgressBar,  WithEvents, WithValidation
{
    use Importable;
    protected $errors = [];
    public $component;
    public $total = 0;
    public $terinput = 0;


    public function __construct($component)
    {
        $this->component = $component;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $this->total = (int)collect($event->reader->getTotalRows())->flatten()->values()[0];
            },
        ];
    }

    public function rules(): array
    {
        return [
            '*.kecamatan' => 'required|string',
            '*.desa' => 'required|string',
            '*.tps' => 'required',
            '*.dpt' => 'required',
        ];
    }


    public function model(array $row)
    {
        DB::beginTransaction();
        try {

            $this->terinput = $this->terinput + 1;

            $kecamatan = $row['kecamatan'] ?? null;
            $desa = $row['desa'] ?? null;
            $tps = $row['tps'] ?? null;
            $dpt = $row['dpt'] ?? null;
            $dptb = $row['dptb'] ?? 0;
            $a = DB::table('com_regions')
                ->where('region_nm', ucwords($kecamatan))
                ->where('region_level', 3)
                ->first();
            $ak = $a ? $a->region_cd : 'null';
            $b = DB::table('com_regions')
                ->where('region_nm', ucwords($desa))
                ->where('region_level', 4)
                ->first();
            $bd = $b ? $b->region_cd : 'null';

            $user = Hasil::create([
                'kecamatan' => $ak,
                'desa' => $bd,
                'tps' => $tps,
                'dpt' => $dpt,
                'dptb' => $dptb
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function progress($done, $total)
    {
        $this->component->setProgress(($done / $total) * 100);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
