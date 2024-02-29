@extends('layouts/contentNavbarLayout')

@section('title', 'داشبورد')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

    @can("داشبورد")
        <div class="row">

            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h6 class="text-wrap text-primary text-center mb-2">کل بازدید سایت</h6>
                                </div>
                                <div class="mt-sm-auto">
                                    <h3 class="mb-0">{{$allVisitsCount}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                <div class="card-title">
                                    <h6 class="text-wrap text-primary text-center mb-2">بازدید امروز سایت</h6>
                                </div>
                                <div class="mt-sm-auto">
                                    <h3 class="mb-0">{{$todayVisitsCount}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <h6 class="btn btn-primary "><a class="text-white" href="{{route("visits.downloadList")}}">دانلود اکسل بازدید</a></h6>

                <h1>{{ $newsChart->options['chart_title'] }}</h1>
                {!! $newsChart->renderHtml() !!}

            </div>

            {!! $newsChart->renderChartJsLibrary() !!}
            {!! $newsChart->renderJs() !!}
        </div>
    @endcan

@endsection

