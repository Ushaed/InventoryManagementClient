@extends('partials.app')
@section('title','Products')
@section('title-card-h1','Product')
@section('title-card-small','Show')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
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
                <h5><strong>Product Details Information</strong></h5>
            </div>
        </div>
        <div class="card-body">
            <h6>Name: {{ $data['data']['name'] }}</h6>
            <h6>Category: {{ $data['data']['category']['name'] }}</h6>
            <h6>Brand: {{ $data['data']['brand']['name'] }}</h6>
            <h6>Buying Price: {{ $data['data']['buy_price'] }} tk</h6>
            <h6>Selling Price: {{ $data['data']['sell_price'] }} tk</h6>
            <h6>Status: <span id="status-bg-success">{{ $data['data']['status'] === '1' ? 'Active' : 'Inactive' }}</span>
            </h6>
            <h6>Description</h6>
            {!! $data['data']['description'] !!} <br>
            @if($user_type == 'manager')
            <a href="{{ route('products.edit', $data['data']['id']) }}" class="btn btn-primary ">Edit</a>
            <form action="{{ route('products.delete', $data['data']['id']) }}" method="post"
                  id="form-in-index-page-for-delete"
                  onsubmit=" return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger ">Delete</button>
            </form>
            @endif
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back to list</a>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#manage_products_sidebar").addClass('active');
        });
    </script>
@stop
