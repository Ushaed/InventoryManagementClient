@extends('partials.app')
@section('title','Category')
@section('title-card-h1','Category')
@section('title-card-small','Edit')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@stop
@section('content')
    <h3>Update existing category</h3>
    <form method="post" action="{{ route('categories.update',$data['data']['id']) }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name">Category Name <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                    </div>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                           placeholder="Enter Category Name" name="name" value="{{ $data['data']['name'] }}">
                </div>
                    @error('name')
                    <div class="text-danger text-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-thermometer-empty"></i></span>
                        </div>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="" disabled>Select option</option>
                            <option value="1" @if($data['data']['status']===1) selected @endif>Active</option>
                            <option value="2" @if($data['data']['status']===2) selected @endif>Inactive</option>
                        </select>
                    </div>
                        @error('status')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea class="form-control textarea" name="description" id="description"
                                  placeholder="Category description goes here..."
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $data['data']['description'] }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-dark ml-2">Back to list</a>
                </div>
    </form>
    <script>
        $(function () {
            $('.textarea').summernote()
            $("#manage_categories_sidebar").addClass('active');
        })
    </script>
@stop
