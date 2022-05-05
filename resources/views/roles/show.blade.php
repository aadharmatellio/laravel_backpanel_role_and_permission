@extends('layouts.app-master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-arrow-left"></i> &nbsp;Back
                    </a>
                    <strong class="pl-2">{{ ucfirst($role->name) }} Role</strong> and Assigned Permissions
                </h2>
                <div class="card-tools">
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
                    <table class="table table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 20px">#</th>
                                <th>Name</th>
                                <th>Guard</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $i=1;
                            @endphp
                            @foreach($rolePermissions as $permission)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
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
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit mr-1"></i>Edit</a>
                <a href="{{ route('roles.index') }}" class="btn btn-default btn-sm">Back</a>
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection