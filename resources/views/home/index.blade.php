@extends('layouts.app-master')

@section('content')
<div class="bg-light rounded">
    @auth
        @role('admin')
            @include('admin-dashboard')
        @else
            @include('subadmin-dashboard')
        @endrole
    @endauth

    @guest
    <h1>You are not an authenticated user.</h1>
    @endguest
</div>
@endsection