@extends('layouts.app-master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-arrow-left"></i> &nbsp;Back
                    </a>
                    <strong class="pl-2">Users Details</strong>
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
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 20px">#</th>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit mr-1"></i>Edit</a>
                <a href="{{ route('users.index') }}" class="btn btn-default btn-sm">Back</a>
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection