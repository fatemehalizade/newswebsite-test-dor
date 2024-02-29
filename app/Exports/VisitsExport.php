<?php

namespace App\Exports;

use App\Models\Visit;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class VisitsExport implements FromCollection
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $minDate=Carbon::now()->subDays(10)->toDateString()." 00:00:00";
        $maxDate=Carbon::now()." 23:59:59";
        return Visit::
        select("url","ip","status","continent","country","region","region_code","city","latitude","longitude","created_at")
        ->where("created_at",">=",$minDate)->where("created_at","<=",$maxDate)->get();
    }

    public function headings(): array
    {
        return ["URL","IP","Status","Continent","Country","Region","Region Code","City","Latitude","Longitude","Created At"];
    }
}
