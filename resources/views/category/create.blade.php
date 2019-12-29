@extends('partials.app')
@section('title','Create Category')
@section('title-card-h1','Category')
@section('title-card-small','Create')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@stop
@push('customCss')
    <style>
        .note-editor.note-frame .note-editing-area {
            overflow: hidden;
            min-height: 200px;
        }
    </style>

@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Add New Category</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('categories.store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                            </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Category Name" name="name" value="{{ old('name') }}">
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
                            <option value="">Select option</option>
                            <option value="1" @if (old('status') == 1) {{ 'selected' }} @endif>Active</option>
                            <option value="2" @if (old('status') == 2) {{ 'selected' }} @endif>Inactive</option>
                        </select>
                        </div>
                        @error('status')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea class=" form-control textarea" id="description" name="description" placeholder="Place some text here"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function () {
            $('.textarea').summernote()
        })
    </script>
@endsection
