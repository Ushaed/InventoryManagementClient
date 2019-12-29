@extends('partials.app')
@section('title','Create Supplier')
@section('title-card-h1','Supplier')
@section('title-card-small','Create')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Supplier</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Add Supplier</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('suppliers.store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Full Name" name="name" value="{{ old('name') }}">
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
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Permanent Address" name="address" value="{{ old('address') }}">
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
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone Number" name="phone" value="{{ old('phone') }}">
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
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" name="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('suppliers.index') }} " class="btn btn-dark">Back to list</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
