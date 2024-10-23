<?php

namespace App\Imports;

use App\Models\Hasil;
use Maatwebsite\Excel\Concerns\ToModel;

class TpsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Hasil([
            //
        ]);
    }
}
