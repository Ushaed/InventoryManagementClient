@extends('partials.app')

@section('title','Profile')
@section('title-card-h1','Profile')
@section('title-card-small','Details')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Profile <small style="font-size: 11px;opacity: .5">{{ $data['user']['name'] }}</small></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-condensed table-hovered table-sm">
                <tr>
                    <th>Username</th>
                    <td>{{ $data['user']['name'] }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data['user']['email'] }}</td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>{{ $data['user']['first_name'] }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ $data['user']['last_name'] }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ $data['user']['gender'] == 1 ? 'Male' : 'Female'}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $data['user']['phone'] }}</td>
                </tr>
                <tr>
                    <th>Designation</th>
                    <td><span id="status-bg-success">{{ $data['user']['user_type'] == 'employee' ? 'Employee' : 'Manager' }}</span></td>
                </tr>
                <tr>
                    <th>Created_at</th>
                    <td>{{ \Carbon\Carbon::parse($data['user']['created_at'])->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th>Updated_at</th>
                    <td>{{ \Carbon\Carbon::parse($data['user']['updated_at'])->diffForHumans() }}</td>
                </tr>
                <tr>
                    <th>Email_verified_at</th>
                    <td>{{ \Carbon\Carbon::parse($data['user']['email_verified_at'])->diffForHumans() }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
