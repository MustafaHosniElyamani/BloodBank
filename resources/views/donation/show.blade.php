@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Stats</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('url', []) }}">Home</a></li>
                        <li class="breadcrumb-item active">Donation Request Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Donation Request Details</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered text-center" >
                        <thead>
                            <tr>

                                <th>Patient name</th>
                                <th>Patient phone</th>
                                <th>City</th>
                                <th>Hospital name</th>
                                <th>Hospital address</th>

                                <th>Blood type</th>
                                <th>Age</th>
                                <th># of bags</th>
                                <th>Other details</th>
                                <th>Client phone</th>


                            </tr>
                        </thead>
                        <tbody>


                            <tr>

                                <td>{{ $model->patient_name }}</td>
                                <td>{{ $model->patient_phone }}</td>
                                <td>{{ $model->city->name }}</td>
                                <td>{{ $model->hospital_name }}</td>
                                    <td>{{ $model->hospital_address }}</td>
                                            <td>{{ $model->blood_type->name }}</td>
                                <td>{{ $model->patient_age }}</td>
                                <td>{{ $model->bags_num }}</td>

                                <td>{{ $model->details }}</td>
                                <td>{{ $model->client->phone }}</td>

                            </tr>


                        </tbody>
                    </table>
                <div class="table-responsive ">
                    <table class="table table-bordered text-center table-centered" >
                        <thead>
                            <tr>

                                <td><strong>Location:</strong> </td>

                                <th> <iframe width="600" height="600"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src = "https://maps.google.com/maps?q={{$model->latitude}},{{$model->longtitude}}&hl=es;z=14&amp;output=embed"></iframe>
                                </th>


                            </tr>
                        </thead>

                    </table>

                {{-- <form method="GET" action="{{ route('client.index') }}">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="blood_type_id">Blood Type:</label>
                                <select class="form-control" id="blood_type_id" name="blood_type_id">
                                    <option value="">-- Select Blood Type --</option>
                                    @foreach ($records as $record)
                                        <option value="{{ $record->blood_type_id }}" {{ $record->blood_type_id == app('request')->input('blood_type_id') ? 'selected' : '' }}>{{ $record->blood_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="last_donation_date">Last Donation Date:</label>
                                <input class="form-control" type="date" id="last_donation_date" name="last_donation_date" value="{{ app('request')->input('last_donation_date') }}">
                            </div>
                            <div class="col-sm-3">
                                <label for="city">City:</label>
                                <select class="form-control" id="city_id" name="city_id">
                                    <option value="">-- Select City --</option>
                                    @foreach ($records as $record)
                                        <option value="{{ $record->city_id }}" {{ $record->city_id == app('request')->input('city_id') ? 'selected' : '' }}>{{ $record->city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="governorate">Governorate:</label>
                                <select class="form-control" id="governorate_id" name="governorate_id">
                                    <option value="">-- Select Governorate --</option>
                                    @foreach ($records as $record)
                                        <option value="{{ $record->city->governorate_id}}" {{ $record->city->governorate_id == app('request')->input('governorate_id') ? 'selected' : '' }}>{{ $record->city->governorate->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form> --}}

            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
