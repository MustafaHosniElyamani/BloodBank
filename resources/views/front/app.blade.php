<!doctype html>
<html lang="en" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css') }}"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

    <!--google fonts css-->
    <link href="{{ url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap') }}"
        rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet"
        href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css') }}">
    <link rel="icon" href="{{ asset('frontend/imgs/Icon.png') }}">

    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}">

    <!--style css-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    <title>Blood Bank</title>
</head>

<body class="@yield('body-class')">
    <!--upper-bar-->
    <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="social">
                        <div class="icons">
                            <a href="{{ url($settings->fb_link) }}" class="facebook"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{ url($settings->insta_link) }}" class="instagram"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="{{ url($settings->tw_link) }}" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>


                @auth('front')
                    <div class="member">
                        <p class="welcome">مرحباً بك</p>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                احمد محمد
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{url(route('front.index'))}}">
                                    <i class="fas fa-home"></i>
                                    الرئيسية
                                </a>

                                <a class="dropdown-item" href="fav">
                                    <i class="far fa-heart"></i>
                                    المفضلة
                                </a>
                                <a class="dropdown-item" href="{{url(route('front.contacts'))}}">
                                    <i class="fas fa-phone-alt"></i>
                                    تواصل معنا
                                </a>
                                <form action="{{ route('front.logOut') }}" method="POST">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                @guest('front')
                    <div class="col-lg-4">
                        <div class="info" dir="ltr">
                            <div class="phone">
                                <i class="fas fa-phone-alt"></i>
                                <p>{{ $settings->phone }}</p>
                            </div>
                            <div class="e-mail">
                                <i class="far fa-envelope"></i>
                                <p>{{ $settings->email }}</p>
                            </div>
                        </div>
                    </div>
                @endguest










            </div>
        </div>
    </div>


    <!--nav-->
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{url(route('front.index'))}}">
                    <img src="{{ asset('frontend/imgs/logo.png') }}" class="d-inline-block align-top" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url(route('front.index'))}}">الرئيسية <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url(route('front.about'))}}">عن بنك الدم</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url(route('front.posts')) }}">المقالات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url(route('front.donations'))}}">طلبات التبرع</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url(route('front.contacts'))}}">اتصل بنا</a>
                        </li>
                    </ul>

                    @auth('front')
                        <a href="#" class="donate">
                            <img src="{{ asset('frontend/imgs/transfusion.svg') }}">
                            <p>طلب تبرع</p>
                        </a>
                    @endauth

                    @guest('front')
                        <div class="accounts">
                            <a href="{{ url(route('front.register')) }}" class="create">إنشاء حساب جديد</a>
                            <a href="{{ url(route('front.signin')) }}" class="signin">الدخول</a>
                        </div>
                    @endguest


                </div>
            </div>
        </nav>
    </div>
    @yield('content')

    <!--footer-->
    <div class="footer">
        <div class="inside-footer">
            <div class="container">
                <div class="row">
                    <div class="details col-md-4">
                        <img src="{{ asset('frontend/imgs/logo.png') }}">
                        <h4>بنك الدم</h4>
                        <p>
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                            العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى.
                        </p>
                    </div>
                    <div class="pages col-md-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                                href="index.html" role="tab" aria-controls="home">الرئيسية</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" href="#"
                                role="tab" aria-controls="profile">عن بنك الدم</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" href="#"
                                role="tab" aria-controls="messages">المقالات</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="donation-requests.html" role="tab" aria-controls="settings">طلبات
                                التبرع</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="who-are-us.html" role="tab" aria-controls="settings">من نحن</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="contact-us.html" role="tab" aria-controls="settings">اتصل بنا</a>
                        </div>
                    </div>
                    <div class="stores col-md-4">
                        <div class="availabe">
                            <p>متوفر على</p>
                            <a href="#">
                                <img src="{{ asset('frontend/imgs/google1.png') }}">
                            </a>
                            <a href="#">
                                <img src="{{ asset('frontend/imgs/ios1.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="other">
            <div class="container">
                <div class="row">
                    <div class="social col-md-4">
                        <div class="icons">
                            <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="rights col-md-8">
                        <p>جميع الحقوق محفوظة لـ <span>بنك الدم</span> &copy; 2019</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js') }}"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <script src="{{ url('https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js') }}"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous">
    </script>

    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    @stack('script')
</body>

</html>
