@extends('partials.app')
@section('title','Supplier')
@section('title-card-h1','Supplier')
@section('title-card-small','Edit')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Supplier</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Update existing supplier</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('suppliers.update',$data['data']['id']) }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                               placeholder="Enter Name" name="name" value="{{ $data['data']['name'] }}">
                        </div>
                        @error('name')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                            </div>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                               placeholder="Enter Address" name="address" value="{{ $data['data']['address'] }}">
                        </div>
                        @error('address')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="phone">Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                               placeholder="Enter Phone Number" name="phone" value="{{ $data['data']['phone'] }}">
                        </div>
                        @error('phone')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                               placeholder="Enter Email" name="email" value="{{ $data['data']['email'] }}">
                        </div>
                        @error('email')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-dark">Back to list</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#manage_suppliers_sidebar").addClass('active');
        });
    </script>
@stop
