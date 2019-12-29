@extends('partials.app')
@section('title','Purchase')
@section('title-card-h1','Purchase')
@section('title-card-small','Create Purchase')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Purchase</li>
    </ol>
@stop
@push('customCss')
    <style>
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 38px;
            user-select: none;
            -webkit-user-select: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 31px;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 74%;
            width: 0;
        }
    </style>
@endpush
@section('content')

    <!-- Modal -->
    <div class="modal fade" id="add_supplier_modal" tabindex="-1" role="dialog"
         aria-labelledby="addSupplierModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupplierModalCenterTitle">Add New Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addSupplier" name="supplier_modal_form">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Full name</label>
                                <input type="text" class="form-control" id="name" placeholder="Full name" name="name"
                                >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Email Address"
                                       name="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Address"
                                       name="address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Phone Number"
                                       name="phone">
                            </div>
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
    <div class="container fullbody">
        <div class="col-md-12">
            <div id="purchase_error">

            </div>
            <div class="card">
                <div class="card-header">
                    <p>Make a Purchase</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('purchases.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="supplier_id">Supplier Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                                        <option value="" selected>Select Supplier</option>
                                        @foreach($data['supplier'] as $supplier)
                                            <option value="{{ $supplier['id'] }}">{{ $supplier['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <br>
                                <button type="button" class="btn btn-outline-info mt-2" data-toggle="modal"
                                        data-target="#add_supplier_modal">
                                    <i class="fas fa-plus"></i> Supplier
                                </button>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="product_id">Product Name</label>
                                <input type="text" id="product_id" name="product_id" class="typeahead form-control" placeholder="Product Name" autocomplete="off">
                            </div>
                            {{--                            <div class="form-group col-sm-4">--}}
                            {{--                                <label for="category_id">Category Name</label>--}}
                            {{--                                <select name="category_id" id="category_id" class="form-control">--}}
                            {{--                                    <option value="">-- Select Category --</option>--}}
                            {{--                                    @foreach($data['category'] as $category)--}}
                            {{--                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group col-sm-4">--}}
                            {{--                                <label for="product_id">Product Name</label>--}}
                            {{--                                <select name="product_id" id="product_id" class="form-control">--}}
                            {{--                                    <option value="">-- Select Product --</option>--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                            <div class="form-group col-sm-4">
                                <br>
                                <button type="button" class="btn btn-primary mt-2" id="add_row_button"><i
                                        class="fas fa-plus"></i> Add Product
                                </button>
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered table-sm" id="product_info_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th style="width: 10%">Quantity</th>
                                <th style="width: 10%">Price</th>
                                <th>Sub total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="addRow">

                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#product_id').typeahead({
                source: function (query, result) {
                    $.ajax({
                        url: '{{ route('products.search','') }}' + '/' + query,
                        method: "GET",
                        data: {query:query},
                        dataType: "json",
                        success:function (data) {
                            console.log(data);
                            result($.map(data,function (item) {
                                return item;
                            }));
                        }
                    })
                }
            });
        });
        {{--var path = "{{ route('products.search') }}";--}}
        {{--$('#product_id').typeahead({--}}
        {{--    source: function (query, process) {--}}
        {{--        return $.get(path,{query:query}, function (data) {--}}
        {{--            return process(data);--}}
        {{--        })--}}
        {{--    }--}}
        {{--});--}}
    </script>
    <script>
        $(function () {
            $('#category_id').on('change', function () {
                var category_id = $(this).val();
                $.ajax({
                    url: '{{route('product.get','')}}' + '/' + category_id,
                    type: 'GET',
                    dataType: 'json',
                    data: {category_id: category_id},
                    success: function (resposne) {
                        // console.log(resposne);
                        var html = "<option value=''>-- Select Product --</option>";
                        $.each(resposne.data, function (index, value) {
                            html += "<option value='" + value.id + "'>" + value.name + "</option>";
                        });
                        $('#product_id').html(html);
                        console.log(html)
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#addSupplier').on('submit', function (e) {
                e.preventDefault();
                let name = document.forms["supplier_modal_form"]["name"].value;
                let email = document.forms["supplier_modal_form"]["email"].value;
                let address = document.forms["supplier_modal_form"]["address"].value;
                let phone = document.forms["supplier_modal_form"]["phone"].value;
                // return console.log(name,email,address,phone);
                if (name === '') {
                    alert("Name is Required");
                    return false;
                } else if (email === '') {
                    alert("Email Address is required");
                    return false;
                } else if (address === '') {
                    alert("Email Address is required");
                    return false;
                } else if (phone === '') {
                    alert("Email Address is required");
                    return false;
                } else {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('suppliers.storeAjax') }}',
                        data: $('#addSupplier').serialize() + "&_token=" + "{{csrf_token()}}",
                        cache: false,
                        success: function (response) {
                            console.log(response.data.data.id);
                            $('#add_supplier_modal').modal('hide');
                            var html = "<option value=''>-- Select Supplier --</option>";
                            $.each(response.alldata.data, function (index, value) {
                                html += "<option value='" + value.id + "'>" + value.name + "</option>";
                            });
                            $('#supplier_id').html(html);
                            $('#supplier_id').val(response.data.data.id).trigger('change');
                            console.log(html)
                        },
                        error: function (response) {
                            alert("Supplier not Added");
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on("click", "#add_row_button", function () {
                var table = document.getElementById("product_info_table");
                var rowCount = table.rows.length;
                var rows = "";
                var category_id = $("#category_id").val();
                var product_id = $('#product_id').val();
                var supplier_id = $('#supplier_id').val();

                if (supplier_id === '') {
                    rows += "<div class='alert alert-danger'><p>Supplier is Required</p></div>";
                    $(rows).appendTo("#purchase_error");
                    return false;
                }
                if (category_id === '') {
                    rows += "<div class='alert alert-danger'><p>Category is Required</p></div>";
                    $(rows).appendTo("#purchase_error");
                    return false;
                }
                if (product_id === '') {
                    rows += "<div class='alert alert-danger'><p>Product is Required</p></div>";
                    $(rows).appendTo("#purchase_error");
                    return false;
                }

                rows += "<tr>" +
                    "<td>" + rowCount + "</td>" +
                    "<td>" + product_id + "</td>" +
                    "<td style='width: 10%'><input type='text' class='form-control' name='quantity[]'min='1'></td>" +
                    "<td style='width: 10%'><input type='text' class='form-control' name = 'price[]'></td>" +
                    "<td>total</td>" +
                    "<td><a href='#' class='btn btn-danger' id='remove_product_info'><i class='fas fa-minus'></i></a></td>" +
                    "</tr>";
                $(rows).appendTo("#addRow");

                $(document).on("click", "#remove_product_info", function () {
                    $(this).closest("tr").remove();
                });

            });
        });
    </script>

    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
@stop
