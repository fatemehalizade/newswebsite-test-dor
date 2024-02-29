<?php

namespace App\Http\Controllers;

use App\Http\Requests\Province\ProvinceRequest;
use App\Repositories\ProvinceRepository\InterfaceProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProvinceController extends Controller
{
    private InterfaceProvinceRepository $interfaceProvinceRepository;
    public function __construct(InterfaceProvinceRepository $interfaceProvinceRepository){
        $this->interfaceProvinceRepository = $interfaceProvinceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces=$this->interfaceProvinceRepository->getAll()->paginate(5);
        return view("Province.index",compact("provinces"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Province.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProvinceRequest $request)
    {
        $data = [
            "name" => $request->name
        ];
        $this->interfaceProvinceRepository->insertData($data);
        Session::flash('success', "استان جدید با موفقیت ثبت شد");
        return redirect()->back();
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
    public function edit(int $id)
    {
        $province=$this->interfaceProvinceRepository->findById($id);
        return view("Province.edit",compact("province"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProvinceRequest $request, int $id)
    {
        $data = [
            "name" => $request->name
        ];
        $this->interfaceProvinceRepository->updateItem($id,$data);
        Session::flash('success', "اطلاعات استان با موفقیت ویرایش شد");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            if($this->interfaceProvinceRepository->deleteData($id)){
                Session::flash('success', "اطلاعات استان با موفقیت حذف شد");
                return redirect()->back();
            }
            Session::flash('fails', "اطلاعات نادرست است!");
            return redirect()->back();
        }
        catch (\Exception $ex){
            DB::rollBack();
            if($ex->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                // return error to user here
                Session::flash('fails', "از اطلاعات استان موردنظر، در اطلاعات دیگر استفاده شده است و قادر به حذف آن نمی باشید!");
            }
            else{
                Session::flash('fails', $ex->getMessage() . ' - ' . $ex->getTraceAsString());
            }
            return redirect()->back();
        }
    }
}
