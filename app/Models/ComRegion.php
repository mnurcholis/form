<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComRegion extends Model
{
    use HasFactory;
    protected $primaryKey = "region_cd";
    protected $guarded = [];
    public $incrementing = false;
}
