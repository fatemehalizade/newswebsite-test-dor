<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>وبسایت خبری | جزئیات خبر</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{asset("assets/img/favicon/favicon.jpg")}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset("assets/lib/owlcarousel/assets/owl.carousel.min.css")}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset("assets/css/style.css")}}" rel="stylesheet">
</head>

<body>

<!-- Topbar Start -->
<div class="container-fluid d-none d-lg-block">
    <div class="row align-items-center bg-dark px-lg-5">
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-sm bg-dark p-0">
                <ul class="navbar-nav mr-n2">
                    <li class="nav-item border-left border-secondary">
                        <a class="nav-link text-body small" href="#">{{\Morilog\Jalali\Jalalian::forge(now()->format("Y-m-d"))->format('%B %d، %Y')}}</a>
                    </li>
{{--                    <li class="nav-item border-left border-secondary">--}}
{{--                        <a class="nav-link text-body small" href="#">تبلیغات</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item border-left border-secondary">--}}
{{--                        <a class="nav-link text-body small" href="#">تماس با ما</a>--}}
{{--                    </li>--}}
                    @if (Auth::check())
                        <li class="nav-item border-left border-secondary">
                            <a class="nav-link text-body small text-danger"
                               href="{{route("dashboardPage")}}">{{ Auth::user()->first_name." ".Auth::user()->last_name }}</a>
                        </li>
                        <li class="nav-item">

                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="nav-link text-body small text-danger" style="background-color: transparent;border:0;">
                                    <span class="align-middle">خروج</span>
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item border-left border-secondary">
                            <a class="nav-link text-body small" href="{{route("loginPage")}}">ورود</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body small" href="{{route("registerPage")}}">ثبت نام</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
{{--        <div class="col-lg-3 text-right d-none d-md-block">--}}
{{--            <nav class="navbar navbar-expand-sm bg-dark p-0">--}}
{{--                <ul class="navbar-nav ml-auto ml-n2">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-body" href="#"><small class="fab fa-twitter"></small></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-body" href="#"><small class="fab fa-facebook-f"></small></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-body" href="#"><small class="fab fa-linkedin-in"></small></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-body" href="#"><small class="fab fa-instagram"></small></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-body" href="#"><small class="fab fa-google-plus-g"></small></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link text-body" href="#"><small class="fab fa-youtube"></small></a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </nav>--}}
{{--        </div>--}}
    </div>
    <div class="row align-items-center bg-white py-3 px-lg-5">
        <div class="col-lg-4">
            <a href="{{route("site.index")}}" class="navbar-brand p-0 d-none d-lg-block">
                <h1 class="m-0 display-4 text-uppercase text-primary">خبر <span class="text-secondary font-weight-normal">باما</span></h1>
            </a>
        </div>
        <div class="col-lg-8 text-center text-lg-right">

        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
        <a href="{{route("site.index")}}" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-4 text-uppercase text-primary">باما<span class="text-white font-weight-normal">خبر</span></h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav ml-auto py-0">
                <a href="{{route("site.index")}}" class="nav-item nav-link active">خانه</a>
{{--                <a href="#" class="nav-item nav-link">دسته بندی</a>--}}
{{--                <a href="#" class="nav-item nav-link">اخبار</a>--}}
{{--                <a href="#" class="nav-item nav-link">تماس با ما</a>--}}
            </div>
{{--            <div class="input-group mr-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">--}}
{{--                <input type="text" class="form-control border-0" placeholder="جستجو کنید...">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="input-group-text bg-primary text-dark border-0 px-3"><i--}}
{{--                            class="fa fa-search"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </nav>
</div>
<!-- Navbar End -->


<!-- Breaking News Start -->
{{--<div class="container-fluid bg-dark py-3 mb-3">--}}
{{--    <div class="container">--}}
{{--        <div class="row align-items-center bg-dark">--}}
{{--            <div class="col-12">--}}
{{--                <div class="d-flex justify-content-between">--}}
{{--                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">خبر فوری</div>--}}
{{--                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"--}}
{{--                         style="width: calc(100% - 170px); padding-left: 90px;">--}}
{{--                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="">--}}
{{--                                این یک خبر تستی و تکراری است .!!این یک خبر تستی و تکراری است .!!این یک خبر تستی و تکراری است .!!این یک خبر تستی و تکراری است .!!</a></div>--}}
{{--                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="">--}}
{{--                                این یک خبر تستی و تکراری است .!!این یک خبر تستی و تکراری است .!!این یک خبر تستی و تکراری است .!!این یک خبر تستی و تکراری است .!!</a></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Breaking News End -->


<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-8">
                <!-- News Detail Start -->
                <div class="position-relative mb-3">
                    <img class="img-fluid w-100" src="{{$news->image ? asset("storage/".$news->image) : asset("assets/img/news-110x110-5.jpg")}}"
                         style="object-fit: cover;height: 400px;">
                    <div class="bg-white border border-top-0 p-4">
                        <div class="mb-3">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                               href="">{{$news->Category->name}}</a>
                            <a class="text-body" href="">{{\Morilog\Jalali\Jalalian::forge(convertShamsiToMiladi($news->published_at))->format('%B %d، %Y')}}</a>
                        </div>
                        <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{!! $news->title !!}</h1>
                        <p>
                            {!! $news->description !!}
                        </p>


                    </div>
                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                        <div class="d-flex align-items-center">
                            <span class="ml-3"><i class="far fa-eye ml-2"></i>{{$news->views+1}}</span>
                            <span class="ml-3"><i class="far fa-comment ml-2"></i>123</span>
                            <form action="{{route("favorites.store")}}" method="POST" class="ml-2">
                                <input type="hidden" name="newsId" value="{{$news->id}}" id="">
                                <button type="submit" style="border: 0;background-color: transparent;" class="
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            @if($news->Favorites()->checkFavorite(\Illuminate\Support\Facades\Auth::id(),$news->id)->where("is_active",\App\Enums\BoolStatus::yes)->first())
                                                {{"text-danger"}}
                                            @endif
                                        @endif
                                    ">
                                    <i class="fas fa-heart"></i>
                                </button>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <!-- News Detail End -->

                <!-- Comment List Start -->
                {{--                    <div class="mb-3">--}}
                {{--                        <div class="section-title mb-0">--}}
                {{--                            <h4 class="m-0 text-uppercase font-weight-bold">نظرات</h4>--}}
                {{--                        </div>--}}
                {{--                        <div class="bg-white border border-top-0 p-4">--}}
                {{--                            <div class="media mb-4">--}}
                {{--                                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">--}}
                {{--                                <div class="media-body">--}}
                {{--                                    <h6><a class="text-secondary font-weight-bold" href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>--}}
                {{--                                    <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore--}}
                {{--                                        accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>--}}
                {{--                                    <button class="btn btn-sm btn-outline-secondary">Reply</button>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="media">--}}
                {{--                                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">--}}
                {{--                                <div class="media-body">--}}
                {{--                                    <h6><a class="text-secondary font-weight-bold" href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>--}}
                {{--                                    <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore--}}
                {{--                                        accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>--}}
                {{--                                    <button class="btn btn-sm btn-outline-secondary">Reply</button>--}}
                {{--                                    <div class="media mt-4">--}}
                {{--                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"--}}
                {{--                                            style="width: 45px;">--}}
                {{--                                        <div class="media-body">--}}
                {{--                                            <h6><a class="text-secondary font-weight-bold" href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>--}}
                {{--                                            <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor--}}
                {{--                                                labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed--}}
                {{--                                                eirmod ipsum.</p>--}}
                {{--                                            <button class="btn btn-sm btn-outline-secondary">Reply</button>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <!-- Comment List End -->

                <!-- Comment Form Start -->
                <div class="mb-3">
                    <div class="section-title mb-0">
                        <h4 class="m-0 text-uppercase font-weight-bold">نظرتان را بنویسید</h4>
                    </div>
                    <div class="bg-white border border-top-0 p-4">
                        <form action="{{route("comments.store")}}" method="post">
                            @csrf

                            @if(!\Illuminate\Support\Facades\Auth::check())
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">نام و نام خانوادگی *</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname">
                                        </div>
                                        @error("fullname")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">ایمیل *</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                        @error("email")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="message">پیام *</label>
                                <textarea id="message" cols="30" rows="5" class="form-control" name="comment"></textarea>
                                @error("comment")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <input type="hidden" name="newsId" value="{{$news->id}}">
                            <input type="hidden" name="parentId" value="0">
                            <div class="form-group mb-0">
                                <input type="submit" value="ارسال نظر"
                                       class="btn btn-primary font-weight-semi-bold py-2 px-3">
                            </div>

                            @if(session("message"))
                                <p class="text-success mt-4">{{session("message")}}</p>
                            @endif
                        </form>
                    </div>
                </div>
                <!-- Comment Form End -->
            </div>

{{--            <div class="col-lg-4">--}}
{{--                <!-- Social Follow Start -->--}}
{{--                <div class="mb-3">--}}
{{--                    <div class="section-title mb-0">--}}
{{--                        <h4 class="m-0 text-uppercase font-weight-bold">ما را دنبال کنید</h4>--}}
{{--                    </div>--}}
{{--                    <div class="bg-white border border-top-0 p-3">--}}
{{--                        <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #39569E;">--}}
{{--                            <i class="fab fa-facebook-f text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>--}}
{{--                            <span class="font-weight-medium">12,345 هوادار</span>--}}
{{--                        </a>--}}
{{--                        <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #52AAF4;">--}}
{{--                            <i class="fab fa-twitter text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>--}}
{{--                            <span class="font-weight-medium">12,345 دنبال کننده</span>--}}
{{--                        </a>--}}
{{--                        <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #0185AE;">--}}
{{--                            <i class="fab fa-linkedin-in text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>--}}
{{--                            <span class="font-weight-medium">12,345 مخاطب</span>--}}
{{--                        </a>--}}
{{--                        <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #C8359D;">--}}
{{--                            <i class="fab fa-instagram text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>--}}
{{--                            <span class="font-weight-medium">12,345 دنبال کننده</span>--}}
{{--                        </a>--}}
{{--                        <a href="" class="d-block w-100 text-white text-decoration-none mb-3" style="background: #DC472E;">--}}
{{--                            <i class="fab fa-youtube text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>--}}
{{--                            <span class="font-weight-medium">12,345 مشترکین</span>--}}
{{--                        </a>--}}
{{--                        <a href="" class="d-block w-100 text-white text-decoration-none" style="background: #055570;">--}}
{{--                            <i class="fab fa-vimeo-v text-center py-4 mr-3" style="width: 65px; background: rgba(0, 0, 0, .2);"></i>--}}
{{--                            <span class="font-weight-medium">12,345 دنبال کننده</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Social Follow End -->--}}

{{--                <!-- Ads Start -->--}}
{{--                <div class="mb-3">--}}
{{--                    <div class="section-title mb-0">--}}
{{--                        <h4 class="m-0 text-uppercase font-weight-bold">تبلیغات</h4>--}}
{{--                    </div>--}}
{{--                    <div class="bg-white text-center border border-top-0 p-3">--}}
{{--                        <a href=""><img class="img-fluid" src="{{asset("assets/img/news-800x500-2.jpg")}}" alt=""></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Ads End -->--}}

{{--                <!-- Newsletter Start -->--}}
{{--                <div class="mb-3">--}}
{{--                    <div class="section-title mb-0">--}}
{{--                        <h4 class="m-0 text-uppercase font-weight-bold">خبرنامه</h4>--}}
{{--                    </div>--}}
{{--                    <div class="bg-white text-center border border-top-0 p-3">--}}
{{--                        <p>برای اطلاعات بیشتر در خبرنامه ما عضو شوید ...</p>--}}
{{--                        <div class="input-group mb-2" style="width: 100%;">--}}
{{--                            <input type="text" class="form-control form-control-lg" placeholder="ایمیل شما : ">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <button class="btn btn-primary font-weight-bold px-3">ثبت نام</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <small>این یک متن تستی است...</small>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Newsletter End -->--}}

{{--                <!-- Tags Start -->--}}
{{--                <div class="mb-3">--}}
{{--                    <div class="section-title mb-0">--}}
{{--                        <h4 class="m-0 text-uppercase font-weight-bold">برچسب ها</h4>--}}
{{--                    </div>--}}
{{--                    <div class="bg-white border border-top-0 p-3">--}}
{{--                        <div class="d-flex flex-wrap m-n1">--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">سیاسی</a>--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">کار</a>--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">شرکت های بزرگ</a>--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">مالی</a>--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">سلامتی</a>--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">آموزشی</a>--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">علمی</a>--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">غذا</a>--}}
{{--                            <a href="" class="btn btn-sm btn-outline-secondary m-1">سفر</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Tags End -->--}}
{{--            </div>--}}
        </div>
    </div>
</div>
<!-- News With Sidebar End -->


<!-- Footer Start -->
{{--<div class="container-fluid bg-dark pt-5 px-sm-3 px-md-5 mt-5">--}}
{{--    <div class="row py-4">--}}
{{--        <div class="col-lg-3 col-md-6 mb-5">--}}
{{--            <h5 class="mb-4 text-white text-uppercase font-weight-bold">باما در تماس باشید</h5>--}}
{{--            <p class="font-weight-medium"><i class="fa fa-map-marker-alt ml-2"></i>مازندران،ساری،بلوار خزر</p>--}}
{{--            <p class="font-weight-medium"><i class="fa fa-phone-alt ml-2"></i>01133270789</p>--}}
{{--            <p class="font-weight-medium"><i class="fa fa-envelope ml-2"></i>info@example.com</p>--}}
{{--            <h6 class="mt-4 mb-3 text-white text-uppercase font-weight-bold">مارا دنبال کنید</h6>--}}
{{--            <div class="d-flex justify-content-start">--}}
{{--                <a class="btn btn-lg btn-secondary btn-lg-square ml-2" href="#"><i class="fab fa-twitter"></i></a>--}}
{{--                <a class="btn btn-lg btn-secondary btn-lg-square ml-2" href="#"><i class="fab fa-facebook-f"></i></a>--}}
{{--                <a class="btn btn-lg btn-secondary btn-lg-square ml-2" href="#"><i class="fab fa-linkedin-in"></i></a>--}}
{{--                <a class="btn btn-lg btn-secondary btn-lg-square ml-2" href="#"><i class="fab fa-instagram"></i></a>--}}
{{--                <a class="btn btn-lg btn-secondary btn-lg-square" href="#"><i class="fab fa-youtube"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 col-md-6 mb-5">--}}
{{--            <h5 class="mb-4 text-white text-uppercase font-weight-bold">خبرهای مشهور</h5>--}}
{{--            <div class="mb-3">--}}
{{--                <div class="mb-2">--}}
{{--                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 ml-2" href="">کاری</a>--}}
{{--                    <a class="text-body" href=""><small>1402-02-19</small></a>--}}
{{--                </div>--}}
{{--                <a class="small text-body text-uppercase font-weight-medium" href="">این یک خبر تستی است ...</a>--}}
{{--            </div>--}}
{{--            <div class="mb-3">--}}
{{--                <div class="mb-2">--}}
{{--                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 ml-2" href="">مالی</a>--}}
{{--                    <a class="text-body" href=""><small>1402-07-01</small></a>--}}
{{--                </div>--}}
{{--                <a class="small text-body text-uppercase font-weight-medium" href="">این یک خبر تستی است ...</a>--}}
{{--            </div>--}}
{{--            <div class="">--}}
{{--                <div class="mb-2">--}}
{{--                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 ml-2" href="">سفر</a>--}}
{{--                    <a class="text-body" href=""><small>1402-01-16</small></a>--}}
{{--                </div>--}}
{{--                <a class="small text-body text-uppercase font-weight-medium" href="">این یک خبر تستی است ...</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 col-md-6 mb-5">--}}
{{--            <h5 class="mb-4 text-white text-uppercase font-weight-bold">دسته بندی</h5>--}}
{{--            <div class="m-n1">--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">سیاسی</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">کار</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">شرکت بزرگ</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">سلامتی</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">آموزشی</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">علمی</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">غذا</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">سرگرمی</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">سفر</a>--}}
{{--                <a href="" class="btn btn-sm btn-secondary m-1">استایل</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-3 col-md-6 mb-5">--}}
{{--            <h5 class="mb-4 text-white text-uppercase font-weight-bold">عکس های فلیکر</h5>--}}
{{--            <div class="row">--}}
{{--                <div class="col-4 mb-3">--}}
{{--                    <a href=""><img class="w-100" src="img/news-110x110-1.jpg" alt=""></a>--}}
{{--                </div>--}}
{{--                <div class="col-4 mb-3">--}}
{{--                    <a href=""><img class="w-100" src="img/news-110x110-2.jpg" alt=""></a>--}}
{{--                </div>--}}
{{--                <div class="col-4 mb-3">--}}
{{--                    <a href=""><img class="w-100" src="img/news-110x110-3.jpg" alt=""></a>--}}
{{--                </div>--}}
{{--                <div class="col-4 mb-3">--}}
{{--                    <a href=""><img class="w-100" src="img/news-110x110-4.jpg" alt=""></a>--}}
{{--                </div>--}}
{{--                <div class="col-4 mb-3">--}}
{{--                    <a href=""><img class="w-100" src="img/news-110x110-5.jpg" alt=""></a>--}}
{{--                </div>--}}
{{--                <div class="col-4 mb-3">--}}
{{--                    <a href=""><img class="w-100" src="img/news-110x110-1.jpg" alt=""></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="container-fluid py-4 px-sm-3 px-md-5" style="background: #111111;">
    <p class="m-0 text-center">&copy; <a href="{{route("site.index")}}">شرکت ما</a>. تمامی حقوق مادی و معنوی محفوظ است .
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{asset("assets/lib/easing/easing.min.js")}}"></script>
<script src="{{asset("assets/lib/owlcarousel/owl.carousel.min.js")}}"></script>

<!-- Template Javascript -->
<script src="{{asset("assets/js/main-1.js")}}"></script>
</body>

</html>
