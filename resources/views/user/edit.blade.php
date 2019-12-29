@extends('partials.app')
@section('title','Users')
@section('title-card-h1','Users')
@section('title-card-small','Edit')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Category</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Update user information</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('users.update',$data['data']['id']) }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">User Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Full Name" name="name"
                               value="{{ $data['data']['name'] }}">
                        </div>
                        @error('name')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" name="email"
                               value="{{ $data['data']['email'] }}">
                        </div>
                        @error('email')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="First Name" name="first_name"
                               value="{{ $data['data']['first_name'] }}">
                        </div>
                        @error('first_name')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Last Name" name="last_name"
                               value="{{ $data['data']['last_name'] }}">
                        </div>
                        @error('last_name')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="phone">Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone Number" name="phone"
                               value="{{ $data['data']['phone'] }}">
                        </div>
                        @error('phone')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="gender">Gender <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                            </div>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="">Select option</option>
                            <option value="1" @if($data['data']['gender']===1) selected @endif>Male</option>
                            <option value="2" @if($data['data']['gender']===2) selected @endif>Female</option>
                        </select>
                        </div>
                        @error('gender')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="user_type">User Type</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-star"></i></span>
                            </div>
                            <select name="user_type" id="user_type" class="form-control @error('user_type') is-invalid @enderror">
                                <option value="" disabled>Select option</option>
                                <option value="employee" @if($data['data']['user_type'] =='employee') selected @endif>Employee</option>
                                <option value="manager" @if($data['data']['user_type'] =='manager') selected @endif>Manager</option>
                            </select>
                        </div>
                        @error('user_type')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-dark">Back to list</a>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#manage_users_sidebar").addClass('active');
        });
    </script>
@stop
