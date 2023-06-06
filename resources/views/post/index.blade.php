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
                        <li class="breadcrumb-item active">Posts</li>
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
                <h3 class="card-title">List of Posts</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>@include('flash::message')
            <div class="card-body"><a href="{{ url(route('post.create')) }}" class="btn btn-primary "> <i
                        class="fa fa-plus"></i> new Post</a>





                <div class="card">

                </div>
                <!-- /.card-body -->


                @if (count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered text-center ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>title</th>
                                    <th>image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody  >

                                @foreach ($records as $record)
                                    <tr class="align-middle table-centered">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->title }}</td>
                                        <td><img src="{{ asset($record->image) }}" class="img-fluid" style="height: 100px" alt="post Image"></td>
                                        <td><a href="{{ url(route('post.edit', $record->id)) }}"
                                                class="btn btn-warning " > <i class="fa fa-edit"></i></a></td>
                                        <td>
                                            {{-- {!! Form::model($record, ['route' => ['governorate.destroy', $record->id], 'method' => 'DELETE']) !!}
                                            {!! Form::token() !!}
                                            <button type="submit" class="btn btn-danger "> <i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!} --}}
                                            {!! Form::open([
                                                'action' => ['App\Http\Controllers\PostController@destroy',$record->id],
                                                  'method' => 'delete'
                                            ]) !!}
                                            {!! Form::token() !!}
                                            <button type="submit" class="btn btn-danger "> <i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}




                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        No Posts
                    </div>
                @endif
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
