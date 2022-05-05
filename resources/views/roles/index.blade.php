@extends('layouts.app-master')

@section('content')


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">
                    <strong class="pl-2">Role</strong> (Manage your roles here.)
                </h2>

                <div class="card-tools">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm mr-2">Add role</a>
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
                                <th width="10%">Role I.D.</th>
                                <th>Name</th>
                                <th width="3%" colspan="3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Show</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
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
                {!! $roles->links() !!}
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection