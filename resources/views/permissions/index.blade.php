@extends('layouts.app-master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">
                    <strong class="pl-2">Permissions</strong> (Manage your permissions here..)
                </h2>

                <div class="card-tools">
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm mr-2">Add permissions</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-md-12">
                    <!-- <div class="mt-2">
                        @include('layouts.partials.messages')
                    </div> -->
                    <table class="table table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th scope="col" width="15%">Name</th>
                                <th scope="col">Guard</th>
                                <th scope="col" colspan="3" width="1%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection