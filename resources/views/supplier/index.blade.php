@extends('partials.app')
@section('title','Supplier')
@section('title-card-h1','Supplier')
@section('title-card-small','Manage Supplier')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Supplier</li>
    </ol>
@stop
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    @if($user_type == 'manager')
    <p><a href="{{ route('suppliers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Supplier</a></p>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Manage Suppliers</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-sm" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['suppliers'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['name'] }}</td>
                        <td>{{ $value['phone'] }}</td>
                        <td>{{ $value['email'] }}</td>
                        <td><a href="{{ route('suppliers.show', $value['id']) }} " class="btn btn-default"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            @if($user_type == 'manager')
                            <a href="{{ route('suppliers.edit', $value['id']) }} " class="btn btn-info"><i
                                    class="fas fa-pen-nib" aria-hidden="true"></i></a>
                                @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

