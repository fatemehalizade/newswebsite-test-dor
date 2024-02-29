@extends('layouts/contentNavbarLayout')

@section('title', 'لاگ')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"> لاگ / </span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card" style="min-height: 90%;">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست لاگ</h5>
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
                    <th>توضیحات</th>
                    <th>رویداد</th>
                    <th>خبر</th>
                    <th>کاربر</th>
                    <th>جزئیات</th>
                    <th>ثبت در</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($newsLogs))
                    @foreach($newsLogs as $newsLog)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$newsLog->description}}</td>
                            <td>{{$newsLog->event}}</td>
                            @php
                                if($newsLog->subject_type)
                                    $news=$newsLog->subject_type::find($newsLog->subject_id);
                                else
                                    $news=null;
                            @endphp
                            @if($news)
                                <td>{{$news->title}}</td>
                            @else
                                <td class="text-danger">حذف شده</td>
                            @endif

                            @php
                                if($newsLog->causer_type)
                                    $user=$newsLog->causer_type::find($newsLog->causer_id);
                                else
                                    $user=null;
                            @endphp
                            @if($user)
                                <td>{{$user->first_name." ".$user->last_name}}</td>
                            @else
                                <td class="text-danger">حذف شده</td>
                            @endif
                            <td>{!! $newsLog->properties !!}</td>
                            <td>{{convertDateTimeToFarsi($newsLog->created_at)}}</td>
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
                            $message="تاکنون لاگ جدیدی ثبت نشده است";
                        @endphp
{{--                    @endif--}}
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td style="color: red;font-weight: bold;">{{$message}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                   @endif
                </tbody>
            </table>

            <div class="pagination-style">
                {{ $newsLogs->links() }}
            </div>


        </div>
    </div>
@endsection
