@extends('layouts/contentNavbarLayout')

@section('title', 'ثبت خبر جدید')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('news.index')}}">اخبار</a> /</span> ثبت </h4>


    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ثبت</h5> <small class="text-muted float-end"><a href="{{route('news.index')}}">بازگشت</a></small>
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

                    <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">عکس</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">عنوان</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title" placeholder="عنوان"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">دسته بندی</label>
                            <div class="col-sm-10">
                                <select name="categoryId" class="form-control">
                                    <option value="">دسته را انتخاب کنید...</option>
                                    <x-categories-s-o :categories="$categories" :parentId="0"/>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">تاریخ انتشار</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="publishedAt" name="persianDatapicker" id="persianDatapicker">
                                <input type="hidden" name="publishedAtH" id="publishedAtH" value="{{convertDateToFarsi(now()->format("Y-m-d"))}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">توضیح مختصر</label>
                            <div class="col-sm-10">
                                <textarea id="context" name="summary"
                                          placeholder="توضیح مختصر"
                                          aria-label="توضیح مختصر"
                                          aria-describedby="basic-icon-default-message2"
                                ></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">توضیحات</label>
                            <div class="col-sm-10">
                                <textarea id="short_text" placeholder="توضیحات" name="description"
                                          aria-label="توضیحات"
                                          aria-describedby="basic-icon-default-message2"
                                ></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                @can("ثبت-اخبار")
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
