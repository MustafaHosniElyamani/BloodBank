@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('url', []) }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
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
                <h3 class="card-title">Edit Category</h3>

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
                @include('partials.validation_errors')

                {!! Form::model($model, [
                    'action' => ['App\Http\Controllers\SettingController@update'],
                    'method' => 'put',
                ]) !!}

                <div class="form-group">
                    <label for="notification_setting_text">Notification Setting Text</label>
                    {!! Form::text('notification_setting_text', null, [
                        'class' => 'form-control ',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="about_app">About App</label>
                    {!! Form::text('about_app', null, [
                        'class' => 'form-control ',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    {!! Form::text('phone', null, [
                        'class' => 'form-control ',
                    ]) !!}
                </div>
                 <div class="form-group">
                    <label for="email">Email</label>
                    {!! Form::email('email', null, [
                        'class' => 'form-control ',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="insta_link">Insatagram</label>
                    {!! Form::text('insta_link', null, [
                        'class' => 'form-control ',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="fb_link">Facbook</label>
                    {!! Form::text('fb_link', null, [
                        'class' => 'form-control ',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="tw_link">Twitter</label>
                    {!! Form::text('tw_link', null, [
                        'class' => 'form-control ',
                    ]) !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
