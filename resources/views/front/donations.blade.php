@extends('front.app')
@section('body-class', 'donation-requests')
@section('content')
<div class="all-requests">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                </ol>
            </nav>
        </div>

        <!--requests-->
        <div class="requests">
            <div class="head-text">
                <h2>طلبات التبرع</h2>
            </div>
            <div class="content">
                <form class="row filter" method="get">
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">

                                {!! Form::select(
                                    'blood_type_id',
                                    $bloodtypes->pluck('name', 'id'),
                                    request('blood_type_id'),
                                    ['class' => 'form-control', 'placeholder' => 'اختر فصيلة الدم','id'=>'exampleFormControlSelect1'],
                                ) !!}
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 city">
                        <div class="form-group">
                            <div class="inside-select">

                                {!! Form::select('city_id',
                                $cities->pluck('name', 'id'),
                                request('city_id'), [
                               'class' => 'form-control',
                               'placeholder' => 'اختر المدينة',
                               'id' => 'exampleFormControlSelect1'
                           ]) !!}

                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 search">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="patients">
              @foreach ($donations as $donation)
                <div class="details">
                        <div class="blood-type">
                            <h2 dir="ltr">{{$donation->blood_type->name}}</h2>
                        </div>
                        <ul>
                            <li><span>اسم الحالة:</span>{{$donation->patient_name}}</li>
                            <li><span>مستشفى:</span>{{$donation->hospital_name}}</li>
                            <li><span>المدينة:</span>{{$donation->city->name}}</li>
                        </ul>
                        <a href="inside-request.html">التفاصيل</a>
                    </div>
                    @endforeach



                </div>

                {{ $donations->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>
</div>

@endsection
