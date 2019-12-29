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
                <div id="error_message"></div>
                <form id="addSupplier" name="supplier_modal_form">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Full name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Full name" name="name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" placeholder="Email Address"
                                       name="email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-7 mb-3">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" placeholder="Address"
                                       name="address">
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
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
                                    <select name="supplier_id" id="supplier_id" class="form-control select2" required>
                                        <option value="" selected>Select Supplier</option>
                                        @foreach($data['suppliers'] as $supplier)
                                            <option
                                                value="{{ $supplier['id'] }}" @if (old('supplier_id') == $supplier['id']) {{ 'selected' }} @endif>{{ $supplier['name'] }}</option>
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
                                <label for="product_name">Product Name <span class="text-danger">*</span></label>
                                <input type="hidden" id="product_id" name="product_id" value="">
                                <input type="hidden" id="product_price" name="product_price" value="">
                                <input type="text" id="product_name" name="product_name" class="typeahead form-control"
                                       placeholder="Product Name" autocomplete="off">

                            </div>
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
                                <th>Product Name</th>
                                <th style='width: 13%'>Quantity</th>
                                <th style="width: 13%">Price</th>
                                <th style='width: 20%'>Sub Total</th>
                                <th style='width: 7%'>Action</th>
                            </tr>
                            </thead>
                            <tbody id="addRow">

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="remarks" class="control-label">Remarks</label>
                                    <textarea class="form-control textarea" id="remarks"
                                              name="remarks" autocomplete="off"
                                              style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
                                                       name="gross_amount" disabled="" autocomplete="off">
                                                <input type="hidden" class="form-control" id="gross_amount_value"
                                                       name="gross_amount_value" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="discount" class="col-sm-5 control-label">Discount</label>
                                            <div class="col-sm-7">
                                                <input type="number" class="form-control" id="discount" name="discount"
                                                       placeholder="Discount" onkeyup="subAmount()" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="net_amount"
                                                       name="net_amount" disabled="" autocomplete="off">
                                                <input type="hidden" class="form-control" id="net_amount_value"
                                                       name="net_amount_value" autocomplete="off">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary col-sm-12">Save</button>

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
        $(document).ready(function () {
            $("#addSupplier").validate({
                // Specified validation rules
                rules: {
                    name: {
                        required: true,
                        minlength: 4
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "{{route('suppliers.emailexist') }}",
                            type: 'GET',
                            data: {
                                email: function () {
                                    return $('#email').val();
                                }
                            }

                        }
                    },
                    address: {
                        required: true
                    },
                    phone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        remote: {
                            url: "{{route('suppliers.phoneexist') }}",
                            type: 'GET',
                            data: {
                                phone: function () {
                                    return $('#phone').val();
                                }
                            }

                        }
                    }
                },
                messages: {
                    name: {
                        required: "Name field is required",
                        minlength: "Name should be at least 4 characters"
                    },
                    address: {
                        required: "Address field is required"
                    },
                    email: {
                        required: "Email field is required",
                        email: "Enter a valid email address",
                        remote: "Email address has already taken."
                    },
                    phone: {
                        required: "Phone number is required",
                        number: "Enter a valid phone number",
                        minlength: 'Phone must be at least 10 characters long',
                        remote: "Phone number has already taken."
                    }
                },

            });
        });
        $(document).ready(function () {
            $('#addSupplier').on('submit', function (e) {
                e.preventDefault();
                let name = document.forms["supplier_modal_form"]["name"].value;
                let email = document.forms["supplier_modal_form"]["email"].value;
                let address = document.forms["supplier_modal_form"]["address"].value;
                let phone = document.forms["supplier_modal_form"]["phone"].value;
                $.ajax({
                    type: "POST",
                    url: '{{ route('suppliers.storeAjax') }}',
                    data: $('#addSupplier').serialize() + "&_token=" + "{{csrf_token()}}",
                    success: function (response) {
                        if (response.error === true) {
                            return false;
                        }
                        $('#add_supplier_modal').modal('hide');
                        var html = "<option value=''>-- Select Supplier --</option>";
                        $.each(response.alldata.suppliers, function (index, value) {
                            html += "<option value='" + value.id + "'>" + value.name + "</option>";
                        });
                        $('#supplier_id').html(html);
                        $('#supplier_id').val(response.data.data.id).trigger('change');
                    },
                    error: function (response) {
                        alert("Supplier not Added");
                    }
                });
            });
        });
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
                    $('#product_price').val(data.buy_price);
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
                var supplier_id = $('#supplier_id').val();
                console.log(product_id)
                if (product_name === '') {
                    alert('Select Product first.')
                    return false;
                }
                rows += "<tr id='row_" + row_id + "'>" +
                    "<td><input type='hidden' class='form-control' name='purchase_product_id[]' id='puchase_product_id_" + row_id + "' value='" + product_id + "'>" + product_name + "</td>" +
                    "<td style='width: 13%'><input type='number' class='form-control' name='purchase_quantity[]' id='purchase_quantity_" + row_id + "' value=1 min='1' onkeyup='getSubTotal(" + row_id + ")' autocomplete='off'></td>" +
                    "<td style='width: 13%'><input type='number' class='form-control' name = 'purchase_price[]' id='purchase_price_" + row_id + "' value='" + product_price + "' min='1' onkeyup='getSubTotal(" + row_id + ")' autocomplete='off'></td>" +
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
                // console.log($("#quantity_"+row).val());
                // console.log($("#purchase_price_"+row).val());
                var total = Number($("#purchase_quantity_" + row).val()) * Number($("#purchase_price_" + row).val());
                total = total.toFixed(2);
                console.log(total);
                $("#subtotal_" + row).val(total);
                $("#subtotal_value_" + row).val(total);
                subAmount();
            } else {
                alert('no row !! please refresh the page');
            }
        };

        function subAmount() {
            var tableProductLength = $("#product_info_table tbody tr").length;
            var totalSubAmount = 0;
            for (x = 0; x < tableProductLength; x++) {
                var tr = $("#product_info_table tbody tr")[x];
                var count = $(tr).attr('id');
                // console.log(count);
                count = count.substring(4);
                // console.log(count);

                totalSubAmount = Number(totalSubAmount) + Number($("#subtotal_" + count).val());
            } // /for

            totalSubAmount = totalSubAmount.toFixed(2);

            // sub total
            $("#gross_amount").val(totalSubAmount);
            $("#gross_amount_value").val(totalSubAmount);
            // total amount
            var totalAmount = Number(totalSubAmount);
            totalAmount = totalAmount.toFixed(2);
            // $("#net_amount").val(totalAmount);
            // $("#totalAmountValue").val(totalAmount);

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
