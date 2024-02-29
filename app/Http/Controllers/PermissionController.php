<?php

namespace App\Http\Controllers;

use App\Enums\RoleTypes;
use App\Http\Requests\Permission\PermissionRequest;
use App\Repositories\PermissionRepository\InterfacePermissionRepository;
use App\Repositories\UserRepository\InterfaceUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    private InterfacePermissionRepository $interfacePermissionRepository;
    private InterfaceUserRepository $interfaceUserRepository;

    public function __construct(InterfacePermissionRepository $interfacePermissionRepository,InterfaceUserRepository $interfaceUserRepository){
        $this->interfacePermissionRepository = $interfacePermissionRepository;
        $this->interfaceUserRepository = $interfaceUserRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function userPermissions(int $id)
    {
        $user=$this->interfaceUserRepository->getUsersByRole(RoleTypes::admin)->where("id",$id)->first();
        if($user){
            $permissions = $user->permissions()->paginate(5);
            return view("Permission.index",compact("permissions","id"));
        }
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
        $user=$this->interfaceUserRepository->getUsersByRole(RoleTypes::admin)->where("id",$id)->first();
        if($user){
            $userPermissions = $user->getDirectPermissions();
            $permissions=$this->interfacePermissionRepository->getAll()->get();
            $userPermissionsArr=convertObjToArr($userPermissions,"name");
            return view("Permission.edit",compact("permissions","userPermissionsArr","id"));
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, int $id)
    {
        $user=$this->interfaceUserRepository->getUsersByRole(RoleTypes::admin)->where("id",$id)->first();
        if($user){
            $user->syncPermissions($request->permissions);
            Session::flash('success', "مجوز (ها) با موفقیت ثبت شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $name,int $id)
    {
        $user=$this->interfaceUserRepository->getUsersByRole(RoleTypes::admin)->where("id",$id)->first();
        if($user){
            if($user->revokePermissionTo($name)){
                Session::flash('success', "مجوز با موفقیت حذف شد");
                return redirect()->back();
            }
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
