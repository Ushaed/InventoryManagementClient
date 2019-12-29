@extends('partials.app')
@section('title','Brand')
@section('title-card-h1','Brand')
@section('title-card-small','Manage brand')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Brand</li>
    </ol>
@stop
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    @if($user_type == 'manager')
    <p><a href="{{ route('brands.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Brand</a></p>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manage Brand</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-sm" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['data'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['name'] }}</td>
                        @if($value['status'] === 1)
                            <td><span id="status-bg-success">Active</span></td>
                        @elseif($value['status'] == 2)
                            <td><span id="status-bg-danger">Inactive</span></td>
                        @endif
                        <td style="width: 17%"><a href="{{ route('brands.show', $value['id']) }} "
                                                  class="btn btn-default"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            @if($user_type == 'manager')
                            <a href="{{ route('brands.edit', $value['id']) }} " class="btn btn-info"><i
                                    class="fas fa-pen-nib" aria-hidden="true"></i></a>
                            <form action="{{ route('brands.delete', $value['id']) }}" method="post"
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

