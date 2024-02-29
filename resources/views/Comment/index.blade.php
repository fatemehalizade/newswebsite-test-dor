@extends('layouts/contentNavbarLayout')

@section('title', 'نظرات')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">نظرات /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card" style="min-height: 90%;">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست نظرات</h5>
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
                    <th>نظر</th>
                    <th>والد</th>
                    <th>خبر</th>
                    <th>وضعیت</th>
                    <th>ثبت در</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($comments))
                    @foreach($comments as $comment)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$comment->comment}}</td>
                            <td>{{$comment->parent_id != 0 ? $comment->Parent->comment : "---"}}</td>
                            <td>{{$comment->News->title}}</td>

                            @if($comment->is_show == \App\Enums\BoolStatus::no)
                                <td class="text-danger">عدم نمایش</td>
                            @else
                                <td class="text-success">نمایش</td>
                            @endif

                            <td>{{convertDateTimeToFarsi($comment->created_at)}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td style="color: red;font-weight: bold;">تاکنون نظر جدیدی ثبت نشده است</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="pagination-style">
                {{ $comments->links() }}
            </div>


        </div>
    </div>
@endsection
