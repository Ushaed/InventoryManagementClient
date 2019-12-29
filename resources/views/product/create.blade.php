@extends('partials.app')
@section('title','Create Product')
@section('title-card-h1','Product')
@section('title-card-small','Create')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
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
    <!-- Modal -->
    <div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog"
         aria-labelledby="addCategoryModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalCenterTitle">Add New Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addCategory" name="category_modal_form">
                    <div class="modal-body">
                        <div class="form-row">
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

                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-12">
                                <label for="description">Description</label>
                                <textarea class=" form-control textarea" id="description" name="description" placeholder="Place some text here"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                    </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Add New Product</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('products.store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Product Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-procedures"></i></span>
                            </div>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   placeholder="Product Name" name="name" value="{{ old('name') }}">
                        </div>
                        @error('name')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="category_id">Category <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                            </div>
                            <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Choose Category</option>
                                @foreach($data['data']['category'] as $category)
                                    <option
                                        value="{{ $category['id'] }}" @if (old('category_id') == $category['id']) {{ 'selected' }} @endif>{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                                    data-target="#add_category_modal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        @error('category_id')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-thermometer-empty"></i></span>
                            </div>
                            <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                <option value="">Choose status</option>
                                <option value="1" @if (old('status') == 1) {{ 'selected' }} @endif>Active</option>
                                <option value="2" @if (old('status') == 2) {{ 'selected' }} @endif>Inactive</option>
                            </select>
                        </div>
                        @error('status')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="brand_id">Brand <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-industry"></i></span>
                            </div>
                            <select name="brand_id" id="brand_id"
                                    class="form-control @error('brand_id') is-invalid @enderror">
                                <option value="">Choose Brand</option>
                                @foreach($data['data']['brand'] as $brand)
                                    <option
                                        value="{{ $brand['id'] }}" @if (old('brand_id') == $brand['id']) {{ 'selected' }} @endif>{{ $brand['name'] }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('products.create') }}" class="btn btn-primary ml-1"><i class="fas fa-plus"></i></a>
                        </div>
                        @error('brand_id')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="buy_price">Buying Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" class="form-control @error('buy_price') is-invalid @enderror"
                                   id="buy_price" placeholder="Buying Price" name="buy_price"
                                   value="{{ old('buy_price') }}">
                        </div>
                        @error('buy_price')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="sell_price">Selling Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" class="form-control @error('sell_price') is-invalid @enderror"
                                   id="sell_price" placeholder="Selling Price" name="sell_price"
                                   value="{{ old('sell_price') }}">
                        </div>
                        @error('sell_price')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea class="form-control textarea" name="description" id="description"
                                  placeholder="product description goes here..."
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back to list</a>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.textarea').summernote();
            $("#buy_price").on('keyup', function () {
                var buy_price = $(this).val();
                var total = Number(buy_price) + (Number(buy_price) * (0.4));
                total = total.toFixed(0);
                $("#sell_price").val(total);
            });
        })
    </script>
@stop
