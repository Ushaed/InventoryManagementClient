@extends('partials.app')
@section('title','Products')
@section('title-card-h1','Product')
@section('title-card-small','Edit')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3>Update Existing Product</h3>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('products.update',$data['data']['product']['id']) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Product Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-procedures"></i></span>
                            </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Product Name" name="name"
                               value="{{ $data['data']['product']['name'] }}">
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
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">Choose Category</option>
                            @foreach($data['data']['categories'] as $key => $value)
                                <option value="{{ $value['id'] }}"
                                        @if( $data['data']['product']['category']['id'] == $value['id'] ) selected @endif>{{ $value['name'] }}</option>
                            @endforeach
                        </select>
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
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="" disabled>Select option</option>
                                <option value="1" @if($data['data']['product']['status']===1) selected @endif>Active</option>
                                <option value="2" @if($data['data']['product']['status']===2) selected @endif>Inactive</option>
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
                        <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                            <option value="">Choose Brand</option>
                            @foreach($data['data']['brands'] as $key => $value)
                                <option value="{{ $value['id'] }}"
                                        @if( $data['data']['product']['brand']['id'] == $value['id'] ) selected @endif>{{ $value['name'] }}</option>
                            @endforeach
                        </select>
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
                                   value="{{ $data['data']['product']['buy_price'] }}">
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
                                   value="{{ $data['data']['product']['sell_price'] }}">
                        </div>
                        @error('sell_price')
                        <div class="text-danger text-bold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea class="form-control textarea" name="description" id="description"
                                  placeholder="product description goes here..."  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $data['data']['product']['description'] }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back to list</a>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.textarea').summernote();
            $("#manage_products_sidebar").addClass('active');

            $("#buy_price").on('keyup', function () {
                var buy_price = $(this).val();
                var total = Number(buy_price) + (Number(buy_price) * (0.4));
                total = total.toFixed(0);
                $("#sell_price").val(total);
            });
        })
    </script>
@stop
