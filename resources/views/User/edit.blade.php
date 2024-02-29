@extends('layouts/contentNavbarLayout')

@section('title', 'ویرایش کاربر')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('users.index')}}">کاربران</a> /</span> ویرایش </h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ویرایش</h5> <small class="text-muted float-end"><a href="{{route('users.index')}}">بازگشت</a></small>
                </div>
                <div class="card-body">

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

                    <form action="{{route('users.update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">عکس</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <div class="col-sm-10">
                                @if($user->image)
                                    <img src="{{asset("storage/".$user->image)}}" width="100px" height="100px" />
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">نام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="نام" value="{{$user->first_name}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">نام خانوادگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="نام خانوادگی"  value="{{$user->last_name}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">کدملی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nationalCode" id="nationalCode" placeholder="کدملی"  value="{{$user->nationalcode}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">شماره همراه</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="شماره همراه"  value="{{$user->mobile}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">ایمیل</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل"  value="{{$user->email}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">وضعیت نظام وظیفه</label>
                            <div class="col-sm-10">
                                <select name="dutySystemStatus" class="form-control">
                                    <option value="">وضعیت نظام وظیفه خود را انتخاب کنید ...</option>
                                    <option value="0" @selected($user->duty_system_status == \App\Enums\DutySystemStatus::exempt)>معاف</option>
                                    <option value="1" @selected($user->duty_system_status == \App\Enums\DutySystemStatus::serving)>درحال خدمت</option>
                                    <option value="2" @selected($user->duty_system_status == \App\Enums\DutySystemStatus::end)>پایان خدمت</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">جنسیت</label>
                            <div class="col-sm-10">
                                <input type="radio"  name="gender" id="showInSlider" value="1" @checked($user->gender == \App\Enums\GenderTypes::female)/>
                                <label class="col-sm-1 col-form-label" for="gender">زن</label>

                                <input type="radio"  name="gender" id="showInSlider" value="0" @checked(\App\Enums\GenderTypes::male)/>
                                <label class="col-sm-1 col-form-label" for="gender">مرد</label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-md-1 col-form-label" for="basic-default-name">استان</label>
                            <div class="col-sm-10 col-md-2">
                                <select name="provinceId" id="provinceSec" class="form-control">
                                    <option value="">استان را انتخاب کنید...</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}" onclick="citiesFunc({{$province->id}})" id="{{$province->id}}"
                                            @selected($user->province_id == $province->id)>{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-2 col-md-1 col-form-label" for="basic-default-name">شهر</label>
                            <div class="col-sm-10 col-md-2">
                                <select name="cityId" id="citySec" class="form-control">
                                    <option value="">شهر را انتخاب کنید...</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" @selected($user->city_id == $city->id)>
                                            {{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">نام کاربری</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" placeholder="نام کاربری" value="{{$user->username}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">رمزعبور</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" placeholder="رمزعبور"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">تکرار رمزعبور</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="تکرار رمزعبور"/>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                @can("ویرایش-کاربران")
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Basic with Icons -->
    </div>

    <script>


        ClassicEditor
            .create(document.querySelector('#context'))


        ClassicEditor
            .create(document.querySelector('#short_text'))
    </script>
@endsection
