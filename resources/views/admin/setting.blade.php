@extends('partials.app')

@section('title','Setting')
@section('title-card-h1','Setting')
@section('title-card-small','Update')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@stop
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @if($errors->count()===1)
                {{ $errors->first()}}
            @else
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Update Personal Information</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('setting.store') }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Full Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control" id="name" placeholder="Full Name" name="name"
                               value="{{ $data['user']['name'] }}">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                        <input type="text" class="form-control" id="email" placeholder="Email Address" name="email"
                               value="{{ $data['user']['email'] }}">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="first_name">First Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control" id="first_name" placeholder="First Name"
                               name="first_name"
                               value="{{ $data['user']['first_name'] }}">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="last_name">Last Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                        <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name"
                               value="{{ $data['user']['last_name'] }}">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="phone">Phone Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                        <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone"
                               value="{{ $data['user']['phone'] }}">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="gender">Gender</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-genderless"></i></span>
                            </div>
                        <select name="gender" id="gender" class="form-control">
                            <option value="" disabled>Select option</option>
                            <option value="1" @if($data['user']['gender']===1) selected @endif>Male</option>
                            <option value="2" @if($data['user']['gender']===2) selected @endif>Female</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            Leave the password field empty if you don't want to change.
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                        <input type="password" class="form-control" id="password" placeholder="Password"
                               name="password">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                        <input type="password" class="form-control" id="password_confirmation"
                               placeholder="Repeat Password"
                               name="password_confirmation">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </div>
    </div>
@stop
