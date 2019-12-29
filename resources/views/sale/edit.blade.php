@extends('partials.app')
@section('title','Sales')
@section('title-card-h1','Sales')
@section('title-card-small','Update Sales')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@stop
@push('customCss')
    <script src="{{ asset('plugins/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>

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

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 41.5rem;
            padding: .5rem 0;
            margin: .125rem 0 0;
            margin-top: 0.125rem;
            margin-right: 0px;
            margin-bottom: 0px;
            margin-left: 0px;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: .25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .175);
        }

        .error {
            color: red;
        }

        .note-editor.note-frame .note-editing-area {
            overflow: hidden;
            min-height: 119px;
        }
    </style>
@endpush
@section('content')
    <div class="container fullbody">
        <div class="col-md-12">
            <div id="purchase_error">

            </div>
            <div class="card">
                <div class="card-header">
                    <p>Make a Sales</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('sales.update', $data['sales']['id']) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="customer_name">Customer Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                           autocomplete="off" value="{{ $data['sales']['customer_name'] }}">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="customer_phone">Customer Phone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="customer_phone" name="customer_phone"
                                           autocomplete="off" value="{{ $data['sales']['customer_phone'] }}">
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="product_name">Product Name <span class="text-danger">*</span></label>
                                <input type="hidden" id="product_id" name="product_id" value="">
                                <input type="hidden" id="product_price" name="product_price" value="">
                                <input type="text" id="product_name" name="product_name" class="typeahead form-control"
                                       placeholder="Product Name" autocomplete="off">
                            </div>
                            <div class="form-group col-sm-4">
                                <br>
                                @if($data['sales']['status'] == 1)
                                <button type="button" class="btn btn-primary mt-2" id="add_row_button"><i
                                        class="fas fa-plus"></i> Add Product
                                </button>
                                    @endif
                            </div>
                        </div>
                        <br>
                        <table class="table table-striped table-bordered table-sm table-hover" id="product_info_table">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th style="width: 5%">Stock</th>
                                <th style='width: 13%'>Quantity</th>
                                <th style="width: 13%">Price</th>
                                <th style='width: 20%'>Sub Total</th>
                                <th style='width: 7%'>Action</th>

                            </tr>
                            </thead>
                            <tbody id="addRow">
                            @foreach($data['sales_products'] as $key => $value)
                                <tr id="row_{{$loop->iteration}}">
                                    <td>
                                        <input type="hidden" class="form-control" name="sales_product_id[]" id="sales_product_id_{{$loop->iteration}}" value="{{$value['product_id']}}">{{ $value['product']['name'] }}</td>
                                    <td style="width: 5%" class="text-center"><span id="status-bg-success"> {{$value['product']['stock']['quantity']}}</span></td>
                                    <td style='width: 13%'><input type='number' class='form-control' name='sales_quantity[]' id="sales_quantity_{{$loop->iteration}}" value="{{$value['quantity']}}" min='1' max="{{$value['product']['stock']['quantity']}}" onkeyup='getSubTotal("{{$loop->iteration}}")' onload='getSubTotal("{{$loop->iteration}}")' autocomplete='off'></td>
                                    <td style='width: 13%'><input type='number' class='form-control' name = 'sales_price[]' id='sales_price_{{$loop->iteration}}' value="{{$value['price']}}" min='1' onkeyup='getSubTotal({{$loop->iteration}})' autocomplete='off'></td>
                                    <td style='width: 20%'><input type='number' class='form-control' name = 'subtotal[]' id='subtotal_{{$loop->iteration}}' value="{{$value['subtotal']}}" disabled><input type='hidden' name='subtotal_value[]' id='subtotal_value_{{$loop->iteration}}' value="{{ $value['subtotal'] }}" class='form-control'></td>
                                    <td style='width: 7%'><button class='btn btn-danger' id='remove_product_info' onclick='removeRow({{$loop->iteration}})'><i class='fas fa-minus'></i></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="remarks" class="control-label">Remarks</label>
                                    <textarea class="form-control textarea" id="remarks"
                                              name="remarks" autocomplete="off"
                                              style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $data['sales']['remarks'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                <div class="card card-clock mb-3">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="gross_amount" class="col-sm-5 control-label">Gross
                                                Amount</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="gross_amount"
                                                       name="gross_amount" disabled="1"
                                                       value="{{ $data['sales']['gross_total'] }}" autocomplete="off">
                                                <input type="hidden" class="form-control" id="gross_amount_value"
                                                       name="gross_amount_value"
                                                       value="{{ $data['sales']['gross_total'] }}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="discount" class="col-sm-5 control-label">Discount</label>
                                            <div class="col-sm-7">
                                                <input type="number" class="form-control" id="discount" name="discount"
                                                       placeholder="Discount" onkeyup="subAmount()"
                                                       value="{{ $data['sales']['discount'] }}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="net_amount"
                                                       name="net_amount" disabled="1"
                                                       value="{{ $data['sales']['net_total'] }}" autocomplete="off">
                                                <input type="hidden" class="form-control" id="net_amount_value"
                                                       name="net_amount_value" value="{{ $data['sales']['net_total'] }}"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="net_amount" class="col-sm-5 control-label">Status</label>
                                            <div class="col-sm-7">
                                                <select name="status" id="status" class="form-control" @if($data['sales']['status'] == 2) disabled @endif>
                                                    <option value="1" @if($data['sales']['status'] == 1) selected @endif>Unapproved</option>
                                                    <option value="2" @if($data['sales']['status'] == 2) selected @endif>Approved</option>
                                                </select>
                                            </div>
                                        </div>
                                        @if($data['sales']['status'] == 1)
                                            <button type="submit" class="btn btn-success">Update</button>
                                        @endif
                                        <a href="{{ route('sales.index') }}" class="btn btn-dark">Back to list</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var available_quantity;
        $(function () {
            $('#product_name').typeahead({
                source: function (query, process) {
                    $.ajax({
                        url: '{{ route('products.search','') }}' + '/' + query,
                        method: "GET",
                        data: {query: query},
                        dataType: "json",
                        success: function (data) {
                            return process(data);
                        }
                    });
                },
                afterSelect: function (data) {
                    $('#product_id').val(data.id);
                    $('#product_price').val(data.sell_price);
                    available_quantity = data.stock.quantity;
                }
            });
        });
        $(document).ready(function () {
            $(document).on("click", "#add_row_button", function () {
                var table = document.getElementById("product_info_table");
                var row_id = table.rows.length;
                var rows = "";
                var product_id = $('#product_id').val();
                var product_name = $('#product_name').val();
                var product_price = $('#product_price').val();
                if (product_name === '') {
                    alert('Select Product first.')
                    return false;
                }
                rows += "<tr id='row_" + row_id + "'>" +
                    "<td><input type='hidden' class='form-control' name='sales_product_id[]' id='sales_product_id_" + row_id + "' value='" + product_id + "'>" + product_name + "</td>" +
                    "<td style='width: 5%' class='text-center'><span id='status-bg-success'>" + available_quantity + "</span></td>" +
                    "<td style='width: 13%'><input type='number' class='form-control' name='sales_quantity[]' id='sales_quantity_" + row_id + "' value=1 min='1' max='" + available_quantity + "' onkeyup='getSubTotal(" + row_id + ")' autocomplete='off'></td>" +
                    "<td style='width: 13%'><input type='number' class='form-control' name = 'sales_price[]' id='sales_price_" + row_id + "' value='" + product_price + "' min='1' onkeyup='getSubTotal(" + row_id + ")' autocomplete='off'></td>" +
                    "<td style='width: 20%'><input type='number' class='form-control' name = 'subtotal[]' id='subtotal_" + row_id + "' value='" + product_price + "' disabled><input type='hidden' name='subtotal_value[]' id='subtotal_value_" + row_id + "' value='" + product_price + "' class='form-control'></td>" +
                    "<td style='width: 7%'><button class='btn btn-danger' id='remove_product_info' onclick='removeRow(" + row_id + ")'><i class='fas fa-minus'></i></button></td>" +
                    "</tr>";

                $(rows).appendTo("#addRow");
                subAmount();
                document.getElementById('product_name').value = "";
            });
        });

        function getSubTotal(row = null) {
            if (row) {
                var product_id = $("input#sales_product_id_" + row).attr("value");// ajax for checking stock
                var given_quantity = Number($("#sales_quantity_" + row).val());
                $.ajax({
                    url: '{{route('stock.check','')}}' + '/' + product_id,
                    type: 'GET',
                    dataType: 'json',
                    data: {product_id: product_id},
                    success: function (resposne) {
                        // return console.log(resposne);
                        if(resposne.quantity < given_quantity){
                            alert("Out of Stock");
                            return false;
                        }
                    }
                });
                // console.log($("#quantity_"+row).val());
                // console.log($("#purchase_price_"+row).val());
                var total = Number($("#sales_quantity_" + row).val()) * Number($("#sales_price_" + row).val());
                total = total.toFixed(2);
                $("#subtotal_" + row).val(total);
                $("#subtotal_value_" + row).val(total);
                subAmount();
            } else {
                alert('no row !! please refresh the page');
            }
        }

        function subAmount() {
            var tableProductLength = $("#product_info_table tbody tr").length;
            var totalSubAmount = 0;
            for (x = 0; x < tableProductLength; x++) {
                var tr = $("#product_info_table tbody tr")[x];
                var count = $(tr).attr('id');
                count = count.substring(4);
                // console.log(count);
                totalSubAmount = Number(totalSubAmount) + Number($("#subtotal_" + count).val());
            }

            totalSubAmount = totalSubAmount.toFixed(2);

            // sub total
            $("#gross_amount").val(totalSubAmount);
            $("#gross_amount_value").val(totalSubAmount);
            var totalAmount = Number(totalSubAmount);
            totalAmount = totalAmount.toFixed(2);


            var discount = $("#discount").val();
            if (discount) {
                var grandTotal = Number(totalAmount) - Number(discount);
                grandTotal = grandTotal.toFixed(2);
                $("#net_amount").val(grandTotal);
                $("#net_amount_value").val(grandTotal);
            } else {
                $("#net_amount").val(totalAmount);
                $("#net_amount_value").val(totalAmount);

            }// /else discount

        } // /sub total amount
        function removeRow(tr_id) {
            $("#product_info_table tbody tr#row_" + tr_id).remove();
            subAmount();
        }
        $(function () {
            $('.select2').select2();
            $('.textarea').summernote()
        });

    </script>

@stop
