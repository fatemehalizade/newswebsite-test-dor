@extends('layouts/contentNavbarLayout')

@section('title', 'اخبار')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"> اخبار / </span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card" style="min-height: 90%;">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست اخبار</h5>
            <div class="align-items-center">
                <form action="{{route("news.index")}}" method="get" id="searchFormSec">
                    @csrf
                    <div class="d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="search" id="searchSec" class="form-control border-0 shadow-none"
                               placeholder="جستجو..." aria-label="Search..." name="search">
                    </div>
                </form>
            </div>
            @can("ثبت-اخبار")
                <h6 class="btn btn-primary "><a class="text-white" href="{{route("news.create")}}">ثبت آیتم جدید</a></h6>
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
                    <th>عکس</th>
                    <th>عنوان</th>
                    <th>دسته</th>
                    <th>آخرین ویرایش</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($news))
                    @foreach($news as $item)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>
                                @if($item->image)
                                    <img src="{{asset("storage/".$item->image)}}" width="80px" height="80px" />
                                @endif
                            </td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->Category->name}}</td>
                            <td>{{convertDateTimeToFarsi($item->updated_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="text-align: right;">
                                        @can("ویرایش-اخبار")
                                            <a class="dropdown-item" href="{{route('news.edit',['id'=>$item->id])}}"><i
                                                    class="bx bx-edit-alt me-2"></i> ویرایش</a>
                                        @endcan
                                        @can("حذف-اخبار")
                                            <a class="dropdown-item" href="{{route('news.destroy',['id'=>$item->id])}}"><i
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
                            $message="تاکنون خبر جدیدی ثبت نشده است";
                        @endphp
                    @endif
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td style="color: red;font-weight: bold;">{{$message}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="pagination-style">
                    {{ $news->links() }}
            </div>


        </div>
    </div>
@endsection
