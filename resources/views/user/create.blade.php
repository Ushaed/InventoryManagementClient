@extends('partials.app')
@section('title','Create User')
@section('title-card-h1','User')
@section('title-card-small','Create')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Add New Users</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('users.store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">User Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Full Name" name="name" value="{{ old('name') }}">
                        </div>
                        @error('name')
                        <div class="text-danger"><strong>{{ $message }}</strong></div>
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
                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="First Name" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        @error('first_name')
                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="last_name">Last  <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                        </div>
                        @error('last_name')
                        <div class="text-danger"><strong>{{ $message }}</strong></div>
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
                        <div class="text-danger"><strong>{{ $message }}</strong></div>
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
                            <option value="1" @if (old('gender') == 1) {{ 'selected' }} @endif>Male</option>
                            <option value="2" @if (old('gender') == 2) {{ 'selected' }} @endif>Female</option>
                        </select>
                        </div>
                        @error('gender')
                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
                        </div>
                        @error('password')
                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Repeat Password" name="password_confirmation">
                        </div>
                        @error('password_confirmation')
                        <div class="text-danger"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>
                    <input type="hidden" name="user_type" id="user_type" value="employee">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('users.index') }}" class="btn btn-dark">Back to list</a>
            </form>
        </div>
        <div class="card-footer text-center text-danger">
            <p></p>
        </div>
    </div>
@endsection
