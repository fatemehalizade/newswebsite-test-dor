<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\ProvinceRepository\InterfaceProvinceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private InterfaceProvinceRepository $interfaceProvinceRepository;

    public function __construct(InterfaceProvinceRepository $interfaceProvinceRepository){
        $this->interfaceProvinceRepository = $interfaceProvinceRepository;
    }

    public function loginPage(){
        if (Auth::check())
            return redirect()->route("dashboardPage");
        return view('login');
    }

    public function registerPage(){
        $provinces=$this->interfaceProvinceRepository->query()->get();
        if (Auth::check())
            return redirect()->route("dashboardPage");
        return view('register',compact("provinces"));
    }

    public function login(LoginRequest $request){
        try {
            if (!Auth::attempt(['username' => $request->username,'password' => $request->password])){
                Session::flash('fails', __('auth.failed'));
                return redirect()->back();
            }
            return redirect()->route('dashboardPage');
        }
        catch (\Exception $ex){
            DB::rollBack();
            Log::debug($ex->getMessage() . ' - ' . $ex->getTraceAsString());
            return redirect()->back();
        }
    }

    public function logout(){
        Session::flush();
        Auth::guard('web')->logout();
        return redirect()->route('loginPage');
    }
}
