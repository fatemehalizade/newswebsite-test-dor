<?php

namespace App\Http\Controllers;

use App\Repositories\VisitRepository\InterfaceVisitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    private InterfaceVisitRepository $interfaceVisitRepository;

    public function __construct(InterfaceVisitRepository $interfaceVisitRepository){
        $this->interfaceVisitRepository = $interfaceVisitRepository;
    }

    public function dashboardPage(){
        $minDate=Carbon::now()->subDays(10)->toDateString();
        $maxDate=Carbon::now()->addDay()->toDateString();
        $chart_options = [
            'chart_title' => 'بازدید ده روز اخیر سایت',
            'name' => 'بازدید روز',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Visit',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'filter_field' => 'created_at',
            'range_date_start' => $minDate,
            'range_date_end' => $maxDate,
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-12',
            'entries_number' => '5',
            'continuous_time' => true,
        ];

        $newsChart = new LaravelChart($chart_options);

        $allVisitsCount=$this->interfaceVisitRepository->getAll()->count();
        $todayVisitsCount=$this->interfaceVisitRepository->todayVisits()->count();

        return view('dashboard', compact('newsChart','allVisitsCount','todayVisitsCount'));
    }

}
