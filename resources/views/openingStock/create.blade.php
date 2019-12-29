@extends('partials.app')
@section('title','Create Opening Stock')
@section('title-card-h1','Opening Stock')
@section('title-card-small','Create')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('opening.stock.index') }}">Opening Stock</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@stop
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    <h3>Add Opening Stock</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('opening.stock.store') }}">
        @csrf
        <table class="table table-bordered table-striped table-sm table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data['openingStockDetails'] as $key => $value)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td><input type="hidden" class="form-control" name="opening_product_id[]" id="opening_product_id_{{$loop->iteration}}" value="{{$value['product']['id']}}">{{ $value['product']['name'] }}</td>
                    <td style="width: 20%">
                        <input type="number" name="opening_quantity[]" id="opening_quantity_{{ $loop->iteration }}" class="form-control" min="0" value="{{ $value['quantity'] }}" autocomplete="off" @if($data['openingStockDetails'][0]['status'] == 1 || $user_type == 'employee') disabled @endif></td>
                </tr>
                @empty
                <tr class="text-danger text-center">
                    <td colspan="3">No data found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if(empty($data['openingStockDetails']) || $data['openingStockDetails'][0]['status'] == 0 && $user_type == 'manager')
        <button class="btn btn-primary">Save Permanently</button>
        @endif
    </form>
@endsection
