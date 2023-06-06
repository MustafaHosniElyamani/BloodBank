@extends('front.app')
@section('body-class','create')

@section('content')
    <!--form-->
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                    </ol>
                </nav>
            </div>
            <div class="account-form">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form action="{{url(route('front.registerSave'))}}" method="post">


                @csrf
                    <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="الإسم">

                    <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="البريد الإلكترونى">

                    <input name="d_o_b" placeholder="تاريخ الميلاد" class="form-control" type="text" onfocus="(this.type='date')"
                        id="date">
                        @inject('bloodtypes', 'App\Models\BloodType')

                        {!! Form::select('blood_type_id', $bloodtypes->pluck('name', 'id'), null, [
                            'class' => 'form-control',

                            'required',
                            'placeholder' => 'فصيلة الدم',
                        ]) !!}
                    @inject('governorates', 'App\Models\Governorate')
                    {!! Form::select('governorate_id', $governorates->pluck('name', 'id'), null, [
                        'class' => 'form-control',
                        'id' => 'governorates',
                        'required',
                        'placeholder' => 'المحافظة',
                    ]) !!}
                    {!! Form::select('city_id', $governorates->cities->pluck('name', 'id'), null, [
                        'class' => 'form-control',
                        'id' => 'cities',
                        'required',
                        'placeholder' => 'المدينة',
                    ]) !!}





                    <input name="phone" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="رقم الهاتف">

                    <input name="last_donation_date" placeholder="آخر تاريخ تبرع" class="form-control" type="text" onfocus="(this.type='date')"
                        id="date">

                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">

                    <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" placeholder="تأكيد كلمة المرور">

                    <div class="create-btn">
                        <input type="submit" value="إنشاء"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $("#governorates").change(function(e) {

                e.preventDefault();
                var governorateId = $("#governorates").val();
                if (governorateId) {

                    // {{-- $("#cities").empty();
            // var option = '<option value=""> المدينة </option>';
            // $("#cities").append(option); --}}
                    $.ajax({
                        url: '{{ url('api/v1/cities?governorate_id=') }}' + governorateId,
                        type: 'get',
                        success: function(data) {
                            $("#cities").empty()
                            $("#cities").append('<option  >المدينة</option>');
                            if (data.status == 1) {
                                jQuery.each(data.data, function(i, city) {
                                    $("#cities").append('<option value="'+city.id +'">'+city.name+'</option>');



                                });
                            }
                        },

                        error: function() {

                            console.log("error");
                        }
                    })

                } else {
                    $("#cities").empty()
                    $("#cities").append('<option  >المدينة</option>');
                }


            });
        </script>
    @endpush
@endsection
