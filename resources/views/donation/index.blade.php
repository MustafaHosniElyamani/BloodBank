@extends('layouts.app')
@inject('city', 'App\Models\City')
@inject('bloodType', 'App\Models\BloodType')
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
                        <li class="breadcrumb-item active">Donation Requests</li>
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
                <h3 class="card-title">Donation Requests</h3>

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

                @include('flash::message')
                @if (count($records))
                    <div class="row mb-3">
                        <div class="col-md-2">
                            {!! Form::open(['method' => 'get']) !!}

                            {!! Form::text('patient_name', request('patient_name'), ['class' => 'form-control', 'placeholder' => 'patient name']) !!}

                        </div>
                        <div class="col-md-2">
                             
                            {!! Form::select(
                                'blood_type_id',
                                $bloodType->pluck('name', 'id'),
                                request('blood_type_id'),
                                ['class' => 'form-control', 'placeholder' => 'Blood Type'],
                            ) !!}

                        </div>
                        <div class="col-md-2">

                            {!! Form::select('city_id',
                                 $city->pluck('name', 'id'),
                                 request('city_id'), [
                                'class' => 'form-control',
                                'placeholder' => 'City',
                            ]) !!}

                        </div>
                        <div class="col-md-2 ">

                            {!! Form::select(
                                'sort', ['asc' => 'Ascending',
                                 'desc' => 'Descending'],
                                 request('sort'), [
                                'class' => 'form-control',
                                'placeholder' => 'sort by Date',
                            ]) !!}


                        </div>
                        <div class="col-md-2 ">

                            {!! Form::select(
                                'age', ['asc' => 'Ascending',
                                 'desc' => 'Descending'],
                                 request('age'), [
                                'class' => 'form-control',
                                'placeholder' => 'sort by age',
                            ]) !!}


                        </div>
                        <div class="col-md-2">
                            {!! Form::button('filter', [
                                'type' => 'submit',
                                'class' => 'btn btn-primary',
                            ]) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Patient Age</th>
                                    <th>Blood Type</th>

                                    <th>City</th>
                                    <th>Show details</th>

                                    <th>Delete</th>


                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($records as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->patient_name }}</td>
                                        <td>{{ $record->patient_age }}</td>
                                        <td>{{ $record->blood_type->name }}</td>

                                        <td>{{ $record->city->name }}</td>
                                        <td><a href="{{ url(route('donation.show', $record->id)) }}"
                                            class="btn btn-primary "> click here</i></a></td>


                                        <td>
                                            {{-- {!! Form::model($record, ['route' => ['governorate.destroy', $record->id], 'method' => 'DELETE']) !!}
                                            {!! Form::token() !!}
                                            <button type="submit" class="btn btn-danger "> <i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!} --}}
                                            {!! Form::open([
                                                'action' => ['App\Http\Controllers\DonationRequestController@destroy', $record->id],
                                                'method' => 'delete',
                                            ]) !!}
                                            {!! Form::token() !!}
                                            <button type="submit" class="btn btn-danger "> <i
                                                    class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}




                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
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
                @else
                    <div class="alert alert-danger" role="alert">
                        No Governorates
                    </div>
                @endif
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
