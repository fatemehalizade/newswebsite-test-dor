<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Exportable;

class Visit extends Model
{
    use HasFactory,Exportable;
    protected $table="visits";
    protected $fillable = [
        "url",
        "ip",
        "status",
        "continent",
        "country",
        "region",
        "region_code",
        "city",
        "latitude",
        "longitude"
    ];
}
