@extends('partials.app')
@section('title', 'Users Details')
@section('title-card-h1','Users')
@section('title-card-small','Show')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Show</li>
    </ol>
@stop
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    <h6><strong>Users Details Information</strong></h6>
    <h6>Name: {{ $data['data']['name'] }}</h6>
    <h6>Email: {{ $data['data']['email'] }} </h6>
    <h6>First Name: {{ $data['data']['first_name'] }} </h6>
    <h6>Last Name: {{ $data['data']['last_name'] }} </h6>
    <h6>Phone Number: {{ $data['data']['phone'] }} </h6>
    <h6>Gender: {{ $data['data']['gender'] === 1 ? 'Male' : 'Female' }} </h6>
    @if($user_type == 'manager')
    <a href="{{ route('users.edit', $data['data']['id']) }}" class="btn btn-info">Edit</a>
    <form action="{{ route('users.delete', $data['data']['id']) }}" method="post" id="form-in-index-page-for-delete"
          onsubmit=" return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endif
    <a href="{{ route('users.index') }}" class="btn btn-dark">Back to list</a>
    <script>
        $(document).ready(function () {
           $("#manage_users_sidebar").addClass('active');
        });
    </script>
@stop
