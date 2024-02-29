@extends('layouts/contentNavbarLayout')

@section('title', 'بازدید سایت')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">بازید سایت /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card" style="min-height: 90%;">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست بازدید سایت</h5>
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
                    <th>آدرس صفحه</th>
                    <th>IP</th>
                    <th>وضعیت</th>
                    <th>continent</th>
                    <th>کشور</th>
                    <th>region</th>
                    <th>region code</th>
                    <th>شهرستان</th>
                    <th>latitude</th>
                    <th>longitude</th>
                    <th>مشاهده در</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($visits))
                    @foreach($visits as $visit)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$visit->url}}</td>
                            <td>{{$visit->ip}}</td>
                            <td>{{$visit->success}}</td>
                            <td>{{$visit->continent}}</td>
                            <td>{{$visit->country}}</td>
                            <td>{{$visit->region}}</td>
                            <td>{{$visit->region_code}}</td>
                            <td>{{$visit->city}}</td>
                            <td>{{$visit->latitude}}</td>
                            <td>{{$visit->longitude}}</td>
                            <td>{{convertDateTimeToFarsi($visit->created_at)}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td></td>
                        <td style="color: red;font-weight: bold;">تاکنون شهرستان جدیدی ثبت نشده است</td>
                        <td></td>
                        <td></td>
                        <td></td>
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
                {{ $visits->links() }}
            </div>


        </div>
    </div>
@endsection
