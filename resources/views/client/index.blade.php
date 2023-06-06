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
                        <li class="breadcrumb-item active">Clients</li>
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
                <h3 class="card-title">List of Clients </h3>

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
                        <div class="col-md-3">
                            {!! Form::open(['method' => 'get']) !!}
                            {!! Form::select(
                                'blood_type_id',
                                $bloodType->pluck('name', 'id'),
                                request('blood_type_id'),
                                ['class' => 'form-control', 'placeholder' => 'Blood Type'],
                            ) !!}

                        </div>
                        <div class="col-md-3">

                            {!! Form::select('city_id',
                                 $city->pluck('name', 'id'),
                                 request('city_id'), [
                                'class' => 'form-control',
                                'placeholder' => 'City',
                            ]) !!}

                        </div>
                        <div class="col-md-3 ">

                            {!! Form::select(
                                'sort', ['ldd_asc' => 'Ascending',
                                 'ldd_desc' => 'Descending'],
                                 request('sort'), [
                                'class' => 'form-control',
                                'placeholder' => 'last Donation Date',
                            ]) !!}


                        </div>
                        <div class="col-md-3">
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
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Blood Type</th>
                                    <th>Date of Birth</th>
                                    <th>Last Donation Date</th>
                                    <th>City</th>
                                    <th>Governorate</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                    <th>Delete</th>


                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($records as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->phone }}</td>
                                        <td>{{ $record->email }}</td>
                                        <td>{{ $record->blood_type->name }}</td>
                                        <td>{{ $record->d_o_b }}</td>
                                        <td>{{ $record->last_donation_date }}</td>
                                        <td>{{ $record->city->name }}</td>
                                        <td>{{ $record->city->governorate->name }}</td>
                                        <td>{{ $record->is_active ? 'Yes' : 'No' }}</td>
                                        <td>
                                            {!! Form::model($record, [
                                                'action' => ['App\Http\Controllers\ClientController@toggleActive', $record],
                                                'method' => 'put',
                                            ]) !!}

                                            <button type="submit"
                                                class="btn btn-sm btn-{{ $record->is_active ? 'danger' : 'success' }}">
                                                {{ $record->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                            {!! Form::close() !!}

                                            {{--
                                            <form method="POST" action="{{ route('client.toggle-active', $record) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-{{ $record->is_active ? 'danger' : 'success' }}">
                                                    {{ $record->is_active ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form> --}}
                                        </td>
                                        <td>
                                            {{-- {!! Form::model($record, ['route' => ['governorate.destroy', $record->id], 'method' => 'DELETE']) !!}
                                            {!! Form::token() !!}
                                            <button type="submit" class="btn btn-danger "> <i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!} --}}
                                            {!! Form::open([
                                                'action' => ['App\Http\Controllers\ClientController@destroy', $record->id],
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
