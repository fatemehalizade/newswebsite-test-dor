<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Repositories\VisitRepository\InterfaceVisitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VisitController extends Controller
{
    private InterfaceVisitRepository $interfaceVisitRepository;

    public function __construct(InterfaceVisitRepository $interfaceVisitRepository){
        $this->interfaceVisitRepository = $interfaceVisitRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visits=$this->interfaceVisitRepository->getAll()->paginate(5);
        return view("Visit.index",compact("visits"));
    }

    /**
     * Download Excel listing of the resource.
     */
    public function downloadList()
    {
        $minDate=Carbon::now()->subDays(10)->toDateString()." 00:00:00";
        $maxDate=Carbon::now()." 23:59:59";
        return $this->interfaceVisitRepository->query()->
        select("url","ip","status","continent","country","region","region_code","city","latitude","longitude","created_at")
        ->where("created_at",">=",$minDate)->where("created_at","<=",$maxDate)->get()->downloadExcel(
            "visits-".convertDateToFarsi(now()->format("Y-m-d")).".xlsx",
            $writerType = null,
            $headings = true
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        //
    }
}
