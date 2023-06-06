
@extends('front.app')
@section('body-class', 'inside-request')
@section('content')
<div class="ask-donation">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="donation-requests.html">طلبات التبرع</a></li>
                    <li class="breadcrumb-item active" aria-current="page">طالب التبرع: {{$donation->patient_name}}</li>
                </ol>
            </nav>
        </div>
        <div class="details">
            <div class="person">
                <div class="row">
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>الإسم</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->patient_name}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>فصيلة الدم</p>
                                </div>
                                <div class="light">
                                    <p dir="ltr">{{$donation->blood_type->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>العمر</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->patient_age}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>عدد الأكياس المطلوبة</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->bags_num}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>المشفى</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->hospital_name}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>رقم الجوال</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->patient_phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="inside">
                            <div class="info">
                                <div class="special-dark dark">
                                    <p>عنوان المشفى</p>
                                </div>
                                <div class="special-light light">
                                    <p>{{$donation->hospital_address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="details-button">
                    <a href="#">التفاصيل</a>
                </div>
            </div>
            <div class="text">
                <p>{{$donation->details}}
                </p>
            </div>
            <div class="location">
                <iframe width="600" height="600"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src = "https://maps.google.com/maps?q={{$donation->latitude}},{{$donation->longtitude}}&hl=es;z=14&amp;output=embed"></iframe>

            </div>
        </div>
    </div>
</div>
@endsection
