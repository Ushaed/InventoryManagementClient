@extends('partials.app')
@section('title','Opening Stock')
@section('title-card-h1','Opening Stock')
@section('title-card-small','Manage')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Opening Stock</li>
    </ol>
@stop
@section('content')
    @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Manage Users</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['openingStock'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['product']['name'] }}</td>
                        <td>{{ $value['quantity'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

