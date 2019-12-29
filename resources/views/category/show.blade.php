@extends('partials.app')
@section('title','Show Category')
@section('title-card-h1','Category')
@section('title-card-small','Show')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>
        <li class="breadcrumb-item active">Show</li>
    </ol>
@stop
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h6><strong>Category Details Information</strong></h6>
            </div>
        </div>
        <div class="card-body">
            <h6>Name: {{ $data['data']['name'] }}</h6>
            {{--    <h6>Status: {{ $data['category']['status'] === 1 ? 'Active' : 'Inactive' }}</h6>--}}
            <h6>Status: {{ $data['data']['status']}}</h6>
            <h6>Description</h6>
            {!! $data['data']['description'] !!} <br><br>
            @if($user_type == 'manager')
            <a href="{{ route('categories.edit', $data['data']['id']) }}" class="btn btn-info">Edit</a>
            <form action="{{ route('categories.delete', $data['data']['id']) }}" method="post"
                  id="form-in-index-page-for-delete"
                  onsubmit=" return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endif
            <a href="{{ route('categories.index') }}" class="btn btn-dark">Back to list</a>
        </div>
    </div>
{{--    <div class="card mt-2">--}}
{{--        <div class="card-header">--}}
{{--            <h3>Products under this category</h3>--}}

{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <table class="table table-bordered table-striped table-sm">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th>Name</th>--}}
{{--                    <th>Status</th>--}}
{{--                    <th>Action</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @forelse($data['category']['products'] as $key => $value)--}}
{{--                    <tr>--}}
{{--                        <td>{{ ++$key }}</td>--}}
{{--                        <td>{{ $value['name'] }}</td>--}}
{{--                        @if($value['status'] === 1)--}}
{{--                            <td><span id="status-bg-success">Active</span></td>--}}
{{--                        @elseif($value['status'] == 0)--}}
{{--                            <td><span id="status-bg-danger">Inactive</span></td>--}}
{{--                        @endif--}}
{{--                        <td style="width: 17%"><a href="{{ route('products.show', $value['id']) }} " class="btn btn-default"><i--}}
{{--                                    class="fa fa-eye" aria-hidden="true"></i></a>--}}
{{--                            <a href="{{ route('products.edit', $value['id']) }} " class="btn btn-info"><i--}}
{{--                                    class="fas fa-pen-nib" aria-hidden="true"></i></a>--}}
{{--                            <form action="{{ route('products.delete', $value['id']) }}" method="post"--}}
{{--                                  id="form-in-index-page-for-delete"--}}
{{--                                  onsubmit=" return confirm('Are you sure?')">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button type="submit" class="btn btn-danger"><i--}}
{{--                                        class="fa fa-trash-alt" aria-hidden="true"></i></button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @empty--}}
{{--                    <tr class="text-danger text-center">--}}
{{--                        <td colspan="4">No Product Found</td>--}}
{{--                    </tr>--}}
{{--                @endforelse--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}
    <script>
        $(document).ready(function () {
            $("#manage_categories_sidebar").addClass('active');
        });
    </script>

@stop
