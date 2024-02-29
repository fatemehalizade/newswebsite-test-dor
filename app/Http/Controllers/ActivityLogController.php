<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityLogRepository\InterfaceActivityLogRepository;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    private InterfaceActivityLogRepository $interfaceActivityLogRepository;

    public function __construct(InterfaceActivityLogRepository $interfaceActivityLogRepository){
        $this->interfaceActivityLogRepository = $interfaceActivityLogRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsLogs=$this->interfaceActivityLogRepository->getAll()->where("log_name","News")->paginate(5);
        return view("Log.index",compact("newsLogs"));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
