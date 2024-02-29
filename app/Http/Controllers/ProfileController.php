<?php

namespace App\Http\Controllers;

use App\Enums\RoleTypes;
use App\Http\Requests\User\UserRequest;
use App\Repositories\CityRepository\InterfaceCityRepository;
use App\Repositories\ProvinceRepository\InterfaceProvinceRepository;
use App\Repositories\UserRepository\InterfaceUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    private InterfaceUserRepository $interfaceUserRepository;
    private InterfaceProvinceRepository $interfaceProvinceRepository;
    private InterfaceCityRepository $interfaceCityRepository;

    public function __construct(InterfaceUserRepository $interfaceUserRepository,InterfaceProvinceRepository $interfaceProvinceRepository,
                                InterfaceCityRepository $interfaceCityRepository){
        $this->interfaceUserRepository = $interfaceUserRepository;
        $this->interfaceProvinceRepository = $interfaceProvinceRepository;
        $this->interfaceCityRepository = $interfaceCityRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=$this->interfaceUserRepository->findById(Auth::id());
        $provinces=$this->interfaceProvinceRepository->query()->get();
        $cities=$this->interfaceCityRepository->query()->get();
        if($user)
            return view("Profile.index",compact("user","provinces","cities"));
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
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
    public function update(UserRequest $request,int $id)
    {
        if(Auth::id() == $id){
            $user=$this->interfaceUserRepository->findById(Auth::id());
            $path=$user->image;
            $image=$request->file("image");
            if($image)
                $path=UploadFunc($image,"admin");

            $data = [
                "first_name" => $request->firstName,
                "last_name" => $request->lastName,
                "nationalcode" => $request->nationalCode,
                "gender" => $request->gender,
                "mobile" => $request->mobile,
                "email" => $request->email,
                "image" => $path,
                "username" => $request->username,
                "password" => $request->password ? Hash::make($request->password) : $user->password,
                "province_id" => $request->provinceId,
                "city_id" => $request->cityId,
                "duty_system_status" => $request->dutySystemStatus
            ];

            $this->interfaceUserRepository->updateItem(Auth::id(),$data);
            Session::flash('success', "اطلاعاتتان با موفقیت ویرایش شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
