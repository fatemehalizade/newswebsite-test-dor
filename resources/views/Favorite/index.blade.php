@extends('layouts/contentNavbarLayout')

@section('title', 'علاقه مندی ها')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">علاقه مندی ها /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card" style="min-height: 90%;">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست علاقه مندی ها</h5>
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
                    <th>عنوان</th>
                    <th>دسته</th>
                    <th>-</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($favorites))
                    @foreach($favorites as $favorite)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$favorite->News->title}}</td>
                            <td>{{$favorite->News->Category->name}}</td>
                            <td>
                                @can("حذف-علاقه مندی")
                                    <a class="dropdown-item" href="{{route('favorites.destroy',['id'=>$favorite->id])}}"><i
                                            class="bx bx-trash me-2"></i> حذف</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td style="color: red;font-weight: bold;">تاکنون خبر جدیدی به لیست علاقه مندی افزوده نشده است</td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="pagination-style">
                {{ $favorites->links() }}
            </div>


        </div>
    </div>
@endsection
