@extends('partials.app')
@section('title','Brand')
@section('title-card-h1','Brand')
@section('title-card-small','Edit')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brand</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Update existing Brand</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('brands.update',$data['brand']['id']) }}">
                <div class="row">
                    @method('PUT')
                    @csrf
                    <div class="form-group col-sm-6">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-industry"></i></span>
                            </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                               placeholder="Brand Name" name="name" value="{{ $data['brand']['name'] }}">
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
                            <option value="1" @if($data['brand']['status']===1) selected @endif>Active</option>
                            <option value="2" @if($data['brand']['status']===2) selected @endif>Inactive</option>
                        </select>
                        </div>
                        @error('status')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea class="form-control textarea" name="description" id="description"
                                  placeholder="Brand description goes here..."
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $data['brand']['description'] }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('brands.index') }}" class="btn btn-dark">Back to List</a>
            </form>
        </div>
    </div>

    <script>
        $(function () {
            $('.textarea').summernote();
            $("#manage_brands_sidebar").addClass('active');
        })
    </script>
@stop
