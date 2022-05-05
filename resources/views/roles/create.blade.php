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
                    <strong class="pl-2">Create Role</strong> (role and manage permissions)
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

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>

                        <label for="permissions" class="form-label">Assign Permissions</label>

                        <table class="table table-sm table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 20px">#</th>
                                    <th scope="col" width="10%" class="text-center"><input type="checkbox" name="all_permission"></th>
                                    <th>Name</th>
                                    <th>Guard</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="text-center">
                                        <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='permission'>
                                    </td>
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
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save mr-2"></i>Save Role</button>
                <a href="{{ route('roles.index') }}" class="btn btn-default btn-sm">Back</a>
            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('[name="all_permission"]').on('click', function() {

            if ($(this).is(':checked')) {
                $.each($('.permission'), function() {
                    $(this).prop('checked', true);
                });
            } else {
                $.each($('.permission'), function() {
                    $(this).prop('checked', false);
                });
            }

        });
    });
</script>
@endsection

@endsection