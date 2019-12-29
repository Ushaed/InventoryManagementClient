@extends('partials.app')
@section('title','Daily Reports')
@section('title-card-h1','Daily Reports')
@section('title-card-small','Manage Daily Reports')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Daily reports</li>
    </ol>
@stop
@push('customCss')
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Daily Report <span style="font-size: 12px;">({{ $data['date'] }})</span></h2>
            <div class="card-tools">
                <div class="input-group input-group-sm mt-2">
                    <form action="">
                    <div class="form-row">
                        <div class="form-group">
                            <input class="form-control float-right" type="date" name="date" required style="width: 350px">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    </form>
{{--                    <input type="text" name="date" placeholder="select date" />--}}
                </div>
            </div>

        </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice No</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['daily_sales_reports'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['invoice_code'] }}</td>
                        <td>{{ $value['gross_total'] }} tk</td>
                        <td>{{ $value['discount'] }} tk</td>
                        <td>{{ $value['net_total'] }} tk</td>
                        <td>
                            <button class="btn btn-success" type="button" data-toggle="collapse"
                                    data-target="#collapseExample_{{$loop->iteration}}" aria-expanded="false"
                                    aria-controls="collapseExample">
                                <i class="fa fa-eye" aria-hidden="true"></i> Details
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="collapse" id="collapseExample_{{$loop->iteration}}">
                                <div class="card card-body">
                                    <h5>Details Sales Information</h5>
                                    <table>
                                        <tr class="text-bold">
                                            <td style="width: 70%">Product Name</td>
                                            <td>Price</td>
                                            <td>Quantity</td>
                                            <td>Total</td>
                                        </tr>
                                        @foreach($value['sales_details'] as $key => $value)
                                            <tr>
                                                <td>{{ $value['product']['name'] }}</td>
                                                <td>{{ $value['price'] }}</td>
                                                <td>{{ $value['quantity'] }}</td>
                                                <td>{{ $value['subtotal'] }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-danger text-center">
                        <td colspan="6">No data found</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="4"></td>
                    <td><strong>Total</strong></td>
                    <td><strong>{{ $data['total_daily_sale'] }} tk</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
{{--    <script>--}}
{{--        $(function() {--}}
{{--            $('input[name="date"]').daterangepicker({--}}
{{--                singleDatePicker: true,--}}
{{--                showDropdowns: true,--}}
{{--                minYear: 2015,--}}
{{--                maxYear: parseInt(moment().format('YYYY'),10)--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@stop
@push('customJs')
@endpush
