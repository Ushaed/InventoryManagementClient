@extends('partials.app')
@section('title','Show Sales')
@section('title-card-h1','Sales')
@section('title-card-small','Show')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
        <li class="breadcrumb-item active">Show</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h6><strong>Sales Details Information</strong></h6>
            </div>
        </div>
        <div class="card-body">
            <h6>Customer Name: {{ $data['sales']['customer_name'] }}</h6>
            <h6>Customer Phone: {{ $data['sales']['customer_phone'] }}</h6>
            <h6>Gross Total: {{ $data['sales']['gross_total'] }} tk</h6>
            <h6>Discount: {{ $data['sales']['discount'] }} tk</h6>
            <h6>Net Total: {{ $data['sales']['net_total'] }} tk</h6>
            <h6>Remarks: </h6>
            <p>{!! $data['sales']['remarks'] !!}</p>

            <table id="example1" class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['sales']['sales_details'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['product']['name'] }}</td>
                        <td>{{ $value['price'] }} tk</td>
                        <td>{{ $value['quantity'] }}</td>
                        <td>{{ $value['subtotal'] }} tk</td>
                    </tr>
                @empty
                    <tr class="text-danger text-center">
                        <td colspan="6">No data found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <br>
            @if($data['sales']['status'] == 1)
                <a href="{{ route('sales.edit',$data['sales']['id']) }}" class="btn btn-primary">Edit</a>
            @endif
            <a href="{{ route('sales.index') }}" class="btn btn-dark">Back to list</a>
            <a href="{{ route('sales.print',$data['sales']['id']) }}" class="btn btn-success" target="_blank">Print</a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#manage_purchases_sidebar").addClass('active');
        });
    </script>
@stop
