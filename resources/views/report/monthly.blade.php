@extends('partials.app')
@section('title','Monthly Reports')
@section('title-card-h1','Monthly Reports')
@section('title-card-small','Manage Monthly Reports')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Monthly reports</li>
    </ol>
@stop
@section('content')
    @php
    $start_year = 2015;
    $current_year = date('Y');
    $current_month = date('m');
@endphp
    <div class="card">
        <div class="card-header">
            <h2>Monthly <span style="font-size: 12px;">({{ date("F",strtotime($monthly_report['date'])) }})</span></h2>
            <div class="card-tools">
                <div class="input-group input-group-sm mt-2">
                    <form action="">
                        <div class="form-row">
                            <div class="form-group mr-1">
                                <select class="form-control float-right" name="month" required>
                                    @for ($i = 1 ; $i <= $current_month; $i++)
                                        <option value="{{ $i }}" @if($i == $current_month) selected @endif>{{ date('F', mktime(null, null, null, $i)) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group mr-1">
                                <select class="form-control float-right" name="year" required>
                                    @for ($i = $start_year ; $i <= $current_year; $i++)
                                        <option value="{{ $i }}" @if($i == $current_year) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-sm" id="">
                <thead>
                <tr>
                    <th style="width: 5%" class="text-center">#</th>
                    <th style="width: 50%">Date</th>
                    <th>Counted Sales</th>
                    <th>Total Sell</th>
                    <th style="width: 15%">Details</th>

                </tr>
                </thead>
                <tbody>
                @forelse($monthly_report['daily'] as $key => $value)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ date('d F Y, l', strtotime($value['date'])) }}</td>
                        <td>{{ $value['count'] }} times</td>
                        <td>{{ $value['daily_total'] }} tk</td>
                        <td>
                            <button class="btn btn-success" type="button" data-toggle="collapse"
                                    data-target="#collapseExample_{{$loop->iteration}}" aria-expanded="false"
                                    aria-controls="collapseExample">
                                <i class="fa fa-eye" aria-hidden="true"></i> Details
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="collapse" id="collapseExample_{{$loop->iteration}}">
                                <div class="card card-body">
                                    <h6>Date: {{ $value['date'] }}</h6>
                                    <h6>Daily Sell Count: {{ $value['count'] }}</h6>
                                    <h6>Total Amount of this Day: {{ $value['daily_total'] }} tk</h6>
                                    <table>
                                        <tr class="text-bold">
                                            <td>Invoice code</td>
                                            <td>Customer Name</td>
                                            <td>Gross Total</td>
                                            <td>Discount</td>
                                            <td>Net Total</td>
                                            <td>Action</td>
                                        </tr>
                                        @forelse($monthly_report['daily'][$key]['details'] as $key => $value)
                                            <tr>
                                                <td>{{ $value['invoice_code'] }}</td>
                                                <td>{{ $value['customer_name'] == '' ? 'Not Given': $value['customer_name'] }}</td>
                                                <td>{{ $value['gross_total'] }}</td>
                                                <td>{{ $value['discount'] }}</td>
                                                <td>{{ $value['net_total'] }}</td>
                                                <td>
                                                    <button class="btn btn-success" type="button"
                                                            data-toggle="collapse"
                                                            data-target="#products_{{ $loop->parent->iteration }}_{{$loop->iteration}}"
                                                            aria-expanded="false"
                                                            aria-controls="collapseInner">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="collapse"
                                                         id="products_{{ $loop->parent->iteration }}_{{$loop->iteration}}">
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
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-danger text-center">
                        <td colspan="5">No data found</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="2"></td>
                    <td><strong>Total</strong></td>
                    <td><strong> {{$monthly_report['monthly_total']}} tk</strong></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
