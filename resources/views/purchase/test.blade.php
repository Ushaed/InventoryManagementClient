@extends('partials.app')
@section('content')
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">পণ্যের সংযোজন ব্যবস্থাপনা</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">হোম</li>
                <li class="breadcrumb-item active">পণ্যের সংযোজন</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container fullbody">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        @if(@$editData)
                            পণ্যের সংযোজন আপডেট
                        @else
                            পণ্যের সংযোজন
                        @endif
                        <a class="btn btn-sm btn-success float-right" href=""><i
                                class="fa fa-list"></i> পণ্য সংযোজনের তালিকা</a>
                    </h5>
                </div>
                <!-- Form Start-->
                @if(@$editData)
                    <div class="card-body">
                        <form method="post" action="" id="myForm">
                            {{csrf_field()}}
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label class="control-label">সংযোজনের তারিখ <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="date" id="date"
                                           class="form-control form-control-sm singledatepicker"
                                           value="{{@$editData->date}}" placeholder="DD-MM-YYYY" autocomplete="off">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">পণ্যের ধরণের নাম <span
                                            style="color: red;">*</span></label>
                                    <select name="resource_item_category_id" id="resource_item_category_id"
                                            class="form-control form-control-sm select2">
                                        <option value="">পণ্যের ধরণ নির্বাচন করুন</option>
{{--                                        @foreach($categories as $cat)--}}
{{--                                            <option--}}
{{--                                                value="{{$cat->id}}" {{(@$editData->resource_item_category_id==$cat->id)?("selected"):""}}>{{$cat->name}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">পণ্যের নাম <span style="color: red;">*</span></label>
                                    <select name="resource_item_name_id" id="resource_item_name_id"
                                            class="form-control form-control-sm select2">
                                        <option value="">পণ্যের নাম নির্বাচন করুন</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <label class="control-label" for="quantity">পরিমাণ <span style="color: red;">*</span></label>
                                    <input type="text" name="quantity" id="quantity"
                                           class="form-control form-control-sm" value="{{@$editData->quantity}}"
                                           placeholder="পরিমাণ">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">রেফারেন্স <span style="color: red;">*</span></label>
                                    <input type="text" name="reference" id="reference" value="{{@$editData->reference}}"
                                           class="form-control form-control-sm" placeholder="রেফারেন্স">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm" id="storeButton">সংযোজন আপডেট করুন</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label class="control-label">সংযোজনের তারিখ <span style="color: red;">*</span></label>
                                <input type="text" name="date" id="date"
                                       class="form-control form-control-sm singledatepicker" placeholder="DD-MM-YYYY"
                                       autocomplete="off">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">পণ্যের ধরণের নাম <span style="color: red;">*</span></label>
                                <select name="resource_item_category_id" id="resource_item_category_id"
                                        class="form-control form-control-sm select2">
                                    <option value="">পণ্যের ধরণ নির্বাচন করুন</option>
{{--                                    @foreach($categories as $cat)--}}
{{--                                        <option--}}
{{--                                            value="{{$cat->id}}" {{(@$editData->resource_item_category_id==$cat->id)?("selected"):""}}>{{$cat->name}}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">পণ্যের নাম <span style="color: red;">*</span></label>
                                <select name="resource_item_name_id" id="resource_item_name_id"
                                        class="form-control form-control-sm select2">
                                    <option value="">পণ্যের নাম নির্বাচন করুন</option>

                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label class="control-label">পরিমাণ <span style="color: red;">*</span></label>
                                <input type="text" name="quantity" id="quantity" class="form-control form-control-sm"
                                       placeholder="পরিমাণ">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">রেফারেন্স <span style="color: red;">*</span></label>
                                <input type="text" name="reference" id="reference" class="form-control form-control-sm"
                                       placeholder="রেফারেন্স">
                            </div>
                            <div class="form-group col-md-1" style="padding-top: 29px;">
                                <i class="btn btn-primary fa fa-plus-circle addeventmore"> Add</i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="" id="myForm">
                            {{csrf_field()}}
                            <table class="table-sm table-bordered" width="100%">
                                <thead>
                                <tr>
                                    <th width="10%">সংযোজনের তারিখ</th>
                                    <th width="20%">পণ্যের ধরণের নাম</th>
                                    <th width="25%">পণ্যের নাম</th>
                                    <th width="5%">পরিমাণ</th>
                                    <th width="40%">রেফারেন্স</th>
                                    <th>কার্যনির্বাহ</th>
                                </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">

                                </tbody>
                            </table>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm" id="storeButton">সংযোজন করুন</button>
                            </div>
                        </form>
                    </div>
            @endif
            <!--Form End-->
            </div>
        </div>
    </div>

    <!-- Extra HTML for If exist Event -->
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <td>
                <input type="hidden" name="date[]" value="@{{date}}">
                @{{date}}
            </td>
            <td>
                <input type="hidden" name="resource_item_category_id[]" value="@{{resource_item_category_id}}">
                @{{resource_item_category}}
            </td>
            <td>
                <input type="hidden" name="resource_item_name_id[]" value="@{{resource_item_name_id}}">
                @{{resource_item_name}}
            </td>
            <td>
                <input type="hidden" name="quantity[]" value="@{{quantity}}">
                @{{quantity}}
            </td>
            <td>
                <input type="hidden" name="reference[]" value="@{{reference}}">
                @{{reference}}
            </td>
            <td><i class="btn btn-danger fa fa-close removeeventmore"> </i></td>

        </tr>
    </script>

    <!-- extra_add_exist_item -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on("click", ".addeventmore", function () {
                var resource_item_category_id = $('#resource_item_category_id').val();
                var resource_item_category = $('#resource_item_category_id').find('option:selected').text();
                var resource_item_name_id = $('#resource_item_name_id').val();
                var resource_item_name = $('#resource_item_name_id').find('option:selected').text();
                var quantity = $('#quantity').val();
                var date = $('#date').val();
                var reference = $('#reference').val();

                if (date == '') {
                    $.notify("তারিখ নির্বাচন করুন", {globalPosition: 'top right', className: 'error'});
                    return false;
                }
                if (resource_item_category_id == '') {
                    $.notify("পণ্যের ধরণ নির্বাচন করুন", {globalPosition: 'top right', className: 'error'});
                    return false;
                }
                if (resource_item_name_id == '') {
                    $.notify("পণ্যের নাম নির্বাচন করুন", {globalPosition: 'top right', className: 'error'});
                    return false;
                }
                if (quantity == '') {
                    $.notify("পরিমাণ লিখুন", {globalPosition: 'top right', className: 'error'});
                    return false;
                }
                if (reference == '') {
                    $.notify("রেফারেন্স লিখুন", {globalPosition: 'top right', className: 'error'});
                    return false;
                }

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    resource_item_category_id: resource_item_category_id,
                    resource_item_category: resource_item_category,
                    resource_item_name_id: resource_item_name_id,
                    resource_item_name: resource_item_name,
                    quantity: quantity,
                    date: date,
                    reference: reference
                };
                var html = template(data);
                $("#addRow").append(html);
            });

            $(document).on("click", ".removeeventmore", function (event) {
                $(this).closest(".delete_add_more_item").remove();
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
            $(document).on('change', '#resource_item_category_id', function () {
                var resource_item_category_id = $(this).val();
                $.ajax({
                    url: "",
                    type: "GET",
                    data: {resource_item_category_id: resource_item_category_id},
                    success: function (data) {
                        var html = '<option value="">পণ্যের নাম নির্বাচন করুন</option>';
                        $.each(data, function (key, v) {
                            html += '<option value="' + v.id + '">' + v.name + '</option>';
                        });
                        $('#resource_item_name_id').html(html);
                        var resource_item_name_id = "{{@$editData->resource_item_name_id}}";
                        if (resource_item_name_id != '') {
                            $('#resource_item_name_id').val(resource_item_name_id);
                        }
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
            var resource_item_category_id = "{{@$editData->resource_item_category_id}}";
            if (resource_item_category_id) {
                $('#resource_item_category_id').val(resource_item_category_id).trigger('change');
            }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                ignore: [],
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "resource_item_category_id") {
                        error.insertAfter(element.next());
                    } else if (element.attr("name") == "resource_item_name_id") {
                        error.insertAfter(element.next());
                    } else {
                        error.insertAfter(element);
                    }
                },
                errorClass: 'text-danger',
                validClass: 'text-success',
                rules: {
                    resource_item_category_id: {
                        required: true,
                    },
                    resource_item_name_id: {
                        required: true,
                    },
                    quantity: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    reference: {
                        required: true,
                    },
                },
                messages: {
                    'resource_item_category_id': 'পণ্যের ধরণ নির্বাচন করুন',
                    'resource_item_name_id': 'পণ্যের নাম নির্বাচন করুন',
                    'quantity': 'পরিমাণ লিখুন',
                    'date': 'তারিখ নির্বাচন করুন',
                    'reference': 'রেফারেন্স লিখুন',
                }
            });
        });
    </script>

@endsection
