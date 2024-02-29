<?php

namespace App\Http\Controllers;

use App\Enums\RoleTypes;
use App\Http\Requests\User\UserRequest;
use App\Repositories\CityRepository\InterfaceCityRepository;
use App\Repositories\ProvinceRepository\InterfaceProvinceRepository;
use App\Repositories\UserRepository\InterfaceUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
    public function index(Request $request)
    {
        $users=$this->interfaceUserRepository->getUsersByRole(RoleTypes::user)->paginate(5);
        if($request->searchText)
            $users=$this->interfaceUserRepository->search($request->searchText,RoleTypes::user)->get();
        return view("User.index",["users" => $users,"search" => $request->searchText ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces=$this->interfaceProvinceRepository->query()->get();
        return view("User.create",compact("provinces"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $path=null;
        $image=$request->file("image");
        if($image)
            $path=UploadFunc($image,"user");

        $data = [
            "code" => randomCode(5),
            "first_name" => $request->firstName,
            "last_name" => $request->lastName,
            "nationalcode" => $request->nationalCode,
            "gender" => $request->gender,
            "mobile" => $request->mobile,
            "email" => $request->email,
            "image" => $path,
            "username" => $request->username,
            "password" => Hash::make($request->password),
            "province_id" => $request->provinceId,
            "city_id" => $request->cityId,
            "duty_system_status" => $request->dutySystemStatus
        ];

        $newUser=$this->interfaceUserRepository->insertData($data);
        $newUser->assignRole(RoleTypes::user);
        emailTo([
            "fullname" => $request->firstName." ".$request->lastName,
            "email" => $request->email,
            "username" => $request->username,
            "password" => $request->password
        ]);
        Session::flash('success', "کاربر جدید با موفقیت ثبت شد");
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
        $user=$this->interfaceUserRepository->getUsersByRole(RoleTypes::user)->where("id",$id)->first();
        $provinces=$this->interfaceProvinceRepository->query()->get();
        $cities=$this->interfaceCityRepository->query()->get();
        if($user)
            return view("User.edit",compact("user","provinces","cities"));
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, int $id)
    {
        $user=$this->interfaceUserRepository->getUsersByRole(RoleTypes::user)->where("id",$id)->first();
        if($user){
            $path=$user->image;
            $image=$request->file("image");
            if($image)
                $path=UploadFunc($image,"user");

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

            $this->interfaceUserRepository->updateItem($id,$data);
            Session::flash('success', "اطلاعات کاربر با موفقیت ویرایش شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $user=$this->interfaceUserRepository->getUsersByRole(RoleTypes::user)->where("id",$id)->first();
            if($user){
                if($user->image)
                    unlink("storage/".$user->image);
                $this->interfaceUserRepository->deleteData($id);
                Session::flash('success', "کاربر موردنظر با موفقیت حذف شد");
                return redirect()->back();
            }
            Session::flash('fails', "اطلاعات نادرست است!");
            return redirect()->back();
        }
        catch (\Exception $ex){
            DB::rollBack();
            if($ex->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                // return error to user here
                Session::flash('fails', "از اطلاعات کاربر موردنظر، در اطلاعات دیگر استفاده شده است و قادر به حذف آن نمی باشید!");
            }
            else{
                Session::flash('fails', $ex->getMessage() . ' - ' . $ex->getTraceAsString());
            }
            return redirect()->back();
        }
    }
}
