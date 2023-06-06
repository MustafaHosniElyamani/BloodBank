@extends('front.app')
@section('body-class', 'signin-account')
@section('content')
         <!--form-->
         <div class="form">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                        </ol>
                    </nav>
                </div>
                <div class="signin-form">
                    <form action="{{ url(route('front.login'))  }}" method="post">
                        @csrf 
                        <div class="logo">
                            <img src="{{ asset('frontend/imgs/logo.png') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" placeholder="الجوال">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="كلمة المرور">
                        </div>
                        <div class="row options">

                            <div class="  forgot">
                                <img src="{{ asset('frontend/imgs/complain.png') }} ">
                                <a href="#">هل نسيت كلمة المرور</a>
                            </div>
                        </div>
                        <div class="row buttons">
                            <div class="col-md-6  right  ">
                                <button type="submit">دخول</button>
                            </div>
                            <div class="col-md-6 left">
                                <a href="create-account.html">انشاء حساب جديد</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
