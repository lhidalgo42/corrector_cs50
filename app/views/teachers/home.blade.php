@extends('layouts.master')
@section('content')
@include('teachers.navs.top')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            @include('teachers.navs.sidebar')
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>

            @yield('contentDashboard')
        </div>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/dashboard.css">
@endsection