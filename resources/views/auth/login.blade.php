@extends('layouts.auth-master')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0);"><b>Backpanel</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        @include('layouts.partials.messages')
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="post" action="{{ route('login.perform') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="E-Mail or Username" required="required" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if ($errors->has('username'))
                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="row">
                    <!-- <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div> -->
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="javascript:void(0);">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register.perform') }}" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
        
    </div>
</div>
<!-- /.login-box -->

@include('auth.partials.copy')
@endsection