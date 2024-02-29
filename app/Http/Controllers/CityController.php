<?php

namespace App\Http\Controllers;

use App\Http\Requests\City\CityRequest;
use App\Models\City;
use App\Repositories\CityRepository\InterfaceCityRepository;
use App\Repositories\ProvinceRepository\InterfaceProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    private InterfaceCityRepository $interfaceCityRepository;
    private InterfaceProvinceRepository $interfaceProvinceRepository;

    public function __construct(InterfaceCityRepository $interfaceCityRepository,InterfaceProvinceRepository $interfaceProvinceRepository){
        $this->interfaceCityRepository = $interfaceCityRepository;
        $this->interfaceProvinceRepository = $interfaceProvinceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities=$this->interfaceCityRepository->getAll()->paginate(5);
        return view("City.index",compact("cities"));
    }

    /**
     * Display a listing of the resource.
     */
    public function citiesByProvince(string $provinceId)
    {
        $cities=$this->interfaceCityRepository->getByProvinceId($provinceId)->get();
        return $cities;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces=$this->interfaceProvinceRepository->query()->all();
        return view("City.create",compact("provinces"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $data = [
            "name" => $request->name,
            "province_id" => $request->provinceId
        ];
        $this->interfaceCityRepository->insertData($data);
        Session::flash('success', "شهرستان جدید با موفقیت ثبت شد");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $city=$this->interfaceCityRepository->findById($id);
        $provinces=$this->interfaceProvinceRepository->query()->all();
        return view("City.edit",compact("city","provinces"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, int $id)
    {
        $data = [
            "name" => $request->name,
            "province_id" => $request->provinceId
        ];
        $this->interfaceCityRepository->updateItem($id,$data);
        Session::flash('success', "اطلاعات شهرستان با موفقیت ویرایش شد");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            if($this->interfaceCityRepository->deleteData($id)){
                Session::flash('success', "اطلاعات شهرستان با موفقیت حذف شد");
                return redirect()->back();
            }
            Session::flash('fails', "اطلاعات نادرست است!");
            return redirect()->back();
        }
        catch (\Exception $ex){
            DB::rollBack();
            if($ex->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                // return error to user here
                Session::flash('fails', "از اطلاعات شهرستان موردنظر، در اطلاعات دیگر استفاده شده است و قادر به حذف آن نمی باشید!");
            }
            else{
                Session::flash('fails', $ex->getMessage() . ' - ' . $ex->getTraceAsString());
            }
            return redirect()->back();
        }
    }
}
