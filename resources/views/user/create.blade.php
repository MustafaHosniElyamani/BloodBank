@extends('layouts.app')
@inject('model', 'Spatie\Permission\Models\Role')
@inject('perms', 'Spatie\Permission\Models\Permission')
@inject('rls', 'Spatie\Permission\Models\Role')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('url', []) }}">Home</a></li>
                        <li class="breadcrumb-item active">Create User</li>
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
                <h3 class="card-title">create User</h3>

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



              @include('partials.validation_errors')
              {!! Form::model($model, [
                'action' => 'App\Http\Controllers\UserController@store'
            ]) !!}

                @include('user.form')

            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
