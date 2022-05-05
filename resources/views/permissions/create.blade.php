@extends('layouts.app-master')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <form method="POST" action="{{ route('permissions.store') }}">
                @csrf
                <div class="card-header">
                    <h2 class="card-title">
                        <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-arrow-left"></i> &nbsp;Back
                        </a>
                        <strong class="pl-2">Add new permission.</strong>
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


                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" required>

                            @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save mr-2"></i>Save permission</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-default btn-sm">Back</a>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection