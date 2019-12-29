@extends('partials.app')
@section('title','Show Supplier')
@section('title-card-h1','Supplier')
@section('title-card-small','Show')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Supplier</a></li>
        <li class="breadcrumb-item active">Show</li>
    </ol>
@stop
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h6><strong>Supplier Details Information</strong></h6>
            </div>
        </div>
        <div class="card-body">
            <h6>Name: {{ $data['data']['name'] }}</h6>
            <h6>Email: {{ $data['data']['email'] }}</h6>
            <h6>Phone Number: {{ $data['data']['phone'] }}</h6>
            <h6>Address: {{ $data['data']['address'] }}</h6>
            @if($user_type == 'manager')
            <a href="{{ route('suppliers.edit', $data['data']['id']) }}" class="btn btn-primary">Edit</a>
            @endif
            <a href="{{ route('suppliers.index') }}" class="btn btn-dark">Back to list</a>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#manage_suppliers_sidebar").addClass('active');
        });
    </script>
@stop
