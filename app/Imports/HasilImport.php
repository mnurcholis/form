<?php

namespace App\Imports;

use App\Models\ComRegion;
use App\Models\Hasil;
use Exception;
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
        $kecamatanData = ComRegion::where('region_nm', ucwords($row['kecamatan']))
            ->where('region_level', 3)
            ->first();

        if (!$kecamatanData) {
            // Skip if Kecamatan is not found
            return null;
        }

        // Fetch Desa under the specified Kecamatan
        $desaData = ComRegion::where('region_nm', ucwords($row['desa']))
            ->where('region_level', 4)
            ->where('region_root', $kecamatanData->region_cd)
            ->first();

        if (!$desaData) {
            // Skip if Desa is not found
            return null;
        }

        $user = Hasil::create([
            'kecamatan' => $kecamatanData->region_cd,
            'desa' => $desaData->region_cd,
            'tps' => $row['tps'],
            'dpt' => $row['dpt'],
            'dptb' => $row['dptb'],
        ]);
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
