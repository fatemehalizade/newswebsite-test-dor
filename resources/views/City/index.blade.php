@extends('layouts/contentNavbarLayout')

@section('title', 'شهرستان ها')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">شهرستان ها /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card" style="min-height: 90%;">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست شهرستان ها</h5>
            @can("ثبت-شهرستان")
                <h6 class="btn btn-primary "><a class="text-white" href="{{route("cities.create")}}">ثبت آیتم جدید</a></h6>
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
                    <th>استان</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($cities))
                    @foreach($cities as $city)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$city->name}}</td>
                            <td>{{$city->Province->name}}</td>
                            <td>{{convertDateTimeToFarsi($city->updated_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="text-align: right;">
                                        @can("ویرایش-شهرستان")
                                        <a class="dropdown-item" href="{{route('cities.edit',['id'=>$city->id])}}"><i
                                                class="bx bx-edit-alt me-2"></i> ویرایش</a>
                                        @endcan
                                        @can("حذف-شهرستان")
                                            <a class="dropdown-item" href="{{route('cities.destroy',['id'=>$city->id])}}"><i
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
                            $message="تاکنون شهرستان جدیدی ثبت نشده است";
                        @endphp
                    @endif
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td style="color: red;font-weight: bold;">{{$message}}</td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="pagination-style">
                    {{ $cities->links() }}
            </div>


        </div>
    </div>
@endsection
