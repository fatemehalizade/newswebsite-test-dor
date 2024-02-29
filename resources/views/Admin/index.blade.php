@extends('layouts/contentNavbarLayout')

@section('title', 'ادمین ها')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"> ادمین ها / </span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card" style="min-height: 90%;">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست ادمین ها</h5>
            <div class="align-items-center">
                <form action="{{route("admins.index")}}" method="get" id="searchFormSec">
                    @csrf
                    <div class="d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="search" id="searchSec" class="form-control border-0 shadow-none"
                               placeholder="جستجو..." aria-label="Search..." name="searchText">
                    </div>
                </form>
            </div>
            @can("ثبت-ادمین")
                <h6 class="btn btn-primary "><a class="text-white" href="{{route("admins.create")}}">ثبت آیتم جدید</a></h6>
            @endcan
        </div>

        @if(@\Illuminate\Support\Facades\Session::has('fails'))
            @include('share.messages.error')
        @endif

        @if(@\Illuminate\Support\Facades\Session::has('success'))
            @include('share.messages.success')
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>کدملی</th>
                    <th>جنسیت</th>
                    <th>مجوزها</th>
                    <th>آخرین ویرایش</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($users))
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->nationalcode}}</td>
                            <td>{{$user->gender == \App\Enums\GenderTypes::female ? "زن" : "مرد"}}</td>
                            <td>
                                @can("لیست-مجوز")
                                    <a href="{{route("permissions.userPermissions",["id" => $user->id])}}">مجوزها</a>
                                @endcan
                            </td>
                            <td>{{convertDateTimeToFarsi($user->updated_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="text-align: right;">
                                        @can("ویرایش-ادمین")
                                            <a class="dropdown-item" href="{{route('admins.edit',['id'=>$user->id])}}"><i
                                                    class="bx bx-edit-alt me-2"></i> ویرایش</a>
                                        @endcan
                                        @can("حذف-ادمین")
                                            <a class="dropdown-item" href="{{route('admins.destroy',['id'=>$user->id])}}"><i
                                                class="bx bx-trash me-2"></i> حذف</a>
                                            @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @php
                        $message="";
                    @endphp
                    @if($search)
                        @php
                            $message="نتیجه ای یافت نشد";
                        @endphp
                    @else
                        @php
                            $message="تاکنون ادمین جدیدی ثبت نشده است";
                        @endphp
                    @endif
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td style="color: red;font-weight: bold;">{{$message}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="pagination-style">
                @if(!$search)
                    {{ $users->links() }}
                @endif
            </div>


        </div>
    </div>
@endsection
