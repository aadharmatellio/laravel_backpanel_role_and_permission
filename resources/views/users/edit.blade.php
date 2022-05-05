@extends('layouts.app-master')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-arrow-left"></i> &nbsp;Back
                    </a>
                    <strong class="pl-2">Update User</strong>
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

            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                @csrf
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12">
                        <!-- form start -->

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ $user->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
                                @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input value="{{ $user->email }}" type="email" class="form-control" name="email" placeholder="Email address" required>
                                @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input value="{{ $user->username }}" type="text" class="form-control" name="username" placeholder="Username" required>
                                @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" name="role" required>
                                    <option value="">Select role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ in_array($role->name, $userRole) 
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                                @endif
                            </div>

                        </div>
                        <!-- /.card-body -->


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save mr-2"></i>Update user</button>
                    <a href="{{ route('users.index') }}" class="btn btn-default btn-sm">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection