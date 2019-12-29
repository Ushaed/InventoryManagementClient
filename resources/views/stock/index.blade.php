@extends('partials.app')
@section('title','Stock')
@section('title-card-h1','Stock')
@section('title-card-small','Manage stock')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Stock</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Check Stock</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['stock_products'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['product']['name'] }}</td>
                        <td>{{ $value['quantity'] }}</td>
                    </tr>
                @empty
                    <tr class="text-danger text-center">
                        <td colspan="3">No data found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

