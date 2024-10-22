<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kecamatanTPS()
    {
        return $this->belongsTo(ComRegion::class, 'kecamatan', 'region_cd');
    }
    public function desaTPS()
    {
        return $this->belongsTo(ComRegion::class, 'desa', 'region_cd');
    }
}
