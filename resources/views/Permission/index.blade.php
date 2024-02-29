@extends('layouts/contentNavbarLayout')

@section('title', 'مجوزها')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">مجوزها /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card" style="min-height: 90%;">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست مجوزها</h5>
            @can("ویرایش-مجوز")
                <h6 class="btn btn-primary "><a class="text-white" href="{{route("permissions.edit",["id" => $id])}}">ثبت مجوز جدید</a></h6>
            @endcan
            <small class="text-muted float-end"><a href="{{route('admins.index')}}">بازگشت</a></small>
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
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($permissions))
                    @foreach($permissions as $permission)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$permission->name}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="text-align: right;">
                                        @can("حذف-مجوز")
                                            <a class="dropdown-item" href="{{route('permissions.destroy',["name" => $permission->name,'id'=>$id])}}"><i
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
{{--                    @if($search)--}}
{{--                        @php--}}
{{--                            $message="نتیجه ای یافت نشد";--}}
{{--                        @endphp--}}
{{--                    @else--}}
                        @php
                            $message="تاکنون مجوز جدیدی ثبت نشده است";
                        @endphp
{{--                    @endif--}}
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td style="color: red;font-weight: bold;">{{$message}}</td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="pagination-style">
                    {{ $permissions->links() }}
            </div>


        </div>
    </div>
@endsection
