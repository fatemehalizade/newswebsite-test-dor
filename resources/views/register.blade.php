@extends('layouts/blankLayout')

@section('title', 'ثبت نام')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{route('registerPage')}}" class="app-brand-link gap-2"><i class='bx bx-log-in'></i> خوش آمدید </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">پنل کاربری</h4>
                        <p class="mb-4"><i class='bx bxs-user-account'></i> ثبت نام حساب کاربری </p>
                        @if ($errors->any())
                            <div class="container">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if(@\Illuminate\Support\Facades\Session::has('fails'))
                            @include('share.messages.error')
                        @endif

                        @if(@\Illuminate\Support\Facades\Session::has('success'))
                            @include('share.messages.success')
                        @endif

                        <form id="formAuthentication" class="mb-3" action="{{route('register')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">نام</label>
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                       placeholder="نام را وارد کنید" value="{{old('firstName')}}" autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">نام خانوادگی</label>
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                       placeholder="نام خانوادگی را وارد کنید" value="{{old('lastName')}}" autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">ایمیل</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="ایمیل را وارد کنید" value="{{old('email')}}" autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">کدملی</label>
                                <input type="text" class="form-control" id="nationalCode" name="nationalCode"
                                       placeholder="کدملی را وارد کنید" value="{{old('nationalCode')}}" autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">شماره همراه</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                       placeholder="شماره همراه را وارد کنید" value="{{old('mobile')}}" autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">جنسیت</label>
                                <div class="col-sm-10">
                                    <input type="radio"  name="gender" id="showInSlider" value="1" checked/>
                                    <label class="col-sm-1 col-form-label" for="gender">زن</label>

                                    <input type="radio"  name="gender" id="showInSlider" value="0"/>
                                    <label class="col-sm-1 col-form-label" for="gender">مرد</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">وضعیت نظام وظیفه</label>
                                <div class="col-sm-12">
                                    <select name="dutySystemStatus" class="form-control">
                                        <option value="">وضعیت نظام وظیفه خود را انتخاب کنید ...</option>
                                        <option value="0">معاف</option>
                                        <option value="1">درحال خدمت</option>
                                        <option value="2">پایان خدمت</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">استان</label>
                                <div class="col-sm-12">
                                    <select name="provinceId" id="provinceSec" class="form-control">
                                        <option value="">استان را انتخاب کنید...</option>
                                        @foreach($provinces as $province)
                                            <option value="{{$province->id}}" onclick="citiesFunc({{$province->id}})" id="{{$province->id}}" >{{$province->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">شهر</label>
                                <div class="col-sm-12">
                                    <select name="cityId" id="citySec" class="form-control">
                                        <option value="">شهر را انتخاب کنید...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label"> نام کاربری</label>
                                <input type="text" class="form-control" id="username" name="username"
                                       placeholder=" نام کاربری را وارد کنید" value="{{old('username')}}" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">رمزعبور</label>
                                </div>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control" name="password"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="password" style="border-top-left-radius: 0;border-top-right-radius: 5px;
                         border-bottom-left-radius: 0;border-bottom-right-radius: 5px;"/>
                                    <span class="input-group-text cursor-pointer" style="border-top-right-radius: 0;border-top-left-radius: 5px;
                  border-bottom-right-radius: 0;border-bottom-left-radius: 5px;border-right: 0;"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">تکرار رمزعبور</label>
                                </div>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control" name="password_confirmation"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="password" style="border-top-left-radius: 0;border-top-right-radius: 5px;
                         border-bottom-left-radius: 0;border-bottom-right-radius: 5px;"/>
                                    <span class="input-group-text cursor-pointer" style="border-top-right-radius: 0;border-top-left-radius: 5px;
                  border-bottom-right-radius: 0;border-bottom-left-radius: 5px;border-right: 0;"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">کد امنیتی</label>
                                <div class="col-sm-12 mb-3">
                                    {!! captcha_img() !!}
                                    <a href=""><i class="bx bx-refresh"></i></a>
                                </div>
                                <input type="text" class="form-control" id="captcha" name="captcha"
                                       placeholder="کد امنیتی را وارد کنید" autofocus>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">ثبت نام</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>حساب کاربری دارید؟</span>
                            <a href="{{route("loginPage")}}">
                                <span>ورود به حساب کاربری</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
    </div>
@endsection
