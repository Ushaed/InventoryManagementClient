@extends('partials.app')
@section('title','User')
@section('title-card-h1','User')
@section('title-card-small','Manage users')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
@stop
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    @if($user_type == 'manager')
        <p><a href="{{ route('users.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> User</a></p>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Manage Users</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-sm" id="dataTable">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['data'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['name'] }}</td>
                        <td>{{ $value['email'] }}</td>
                        <td>{{ $value['phone'] }}</td>
                        @if($value['user_type'] === 'employee')
                            <td><span id="status-bg-success">Employee</span></td>
                        @elseif($value['user_type'] == 'manager')
                            <td><span id="status-bg-danger">Manager</span></td>
                        @endif
                        <td><a href="{{ route('users.show', $value['id']) }} " class="btn btn-default"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            @if($user_type == 'manager')
                                <a href="{{ route('users.edit', $value['id']) }} " class="btn btn-info"><i
                                        class="fas fa-pen-nib" aria-hidden="true"></i></a>
                                <form action="{{ route('users.delete', $value['id']) }}" method="post"
                                      id="form-in-index-page-for-delete"
                                      onsubmit=" return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i
                                            class="fa fa-trash-alt" aria-hidden="true"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

