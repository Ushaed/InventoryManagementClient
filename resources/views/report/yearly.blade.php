@extends('partials.app')
@section('title','Yearly Reports')
@section('title-card-h1','Yearly Reports')
@section('title-card-small','Manage Yearly Reports')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Yearly Reports</li>
    </ol>
@stop
@section('content')
    @php
        $start_year = 2015;
        $current_year = date('Y');
    @endphp
    <div class="card">
        <div class="card-header">
            <h2>Yearly Report <span style="font-size: 12px;">({{ date("Y",strtotime($yearly_report['date'])) }})</span></h2>
            <div class="card-tools">
                <div class="input-group input-group-sm mt-2">
                    <form action="">
                        <div class="form-row">
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
            </div>        </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-hover">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Month</th>
                    <th style="width: 25%">Sell Count</th>
                    <th style="width: 25%">Total Amount</th>
                    <th style="width: 14%">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($yearly_report['monthly'] as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ date('F', mktime(null, null, null, $value['month'])) }}</td>
                        <td>{{ $value['count'] }}</td>
                        <td>{{ $value['total_month'] }} tk</td>
                        <td >
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
                                    <h6>Monthly Sell Count: {{ $value['count'] }}</h6>
                                    <h6>Total Amount of this Month: {{ $value['total_month'] }} tk</h6>
                                    <h5>Details Monthly Sales Information</h5>
                                    <table>
                                        <tr class="text-bold">
                                            <td>#</td>
                                            <td>Invoice Code</td>
                                            <td>Customer Name</td>
                                            <td>Gross Total</td>
                                            <td>Discount</td>
                                            <td>Subtotal</td>
                                        </tr>
                                        @forelse($value['details'] as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $value['invoice_code'] }}</td>
                                                <td>
                                                    @if($value['customer_name'] == '')
                                                        <span class="text-danger">Not Given</span>

                                                    @else
                                                        {{ $value['customer_name'] }}
                                                    @endif
                                                </td>
                                                <td>{{ $value['gross_total'] }}</td>
                                                <td>{{ $value['discount'] }}</td>
                                                <td>{{ $value['net_total'] }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-danger text-center">No Data Found</td>
                                            </tr>
                                        @endforelse
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
                {{--                <tr>--}}
                {{--                    <td colspan="4"></td>--}}
                {{--                    <td><strong>Total</strong></td>--}}
                {{--                    <td><strong>{{ $data['total_daily_sale'] }} tk</strong></td>--}}
                {{--                </tr>--}}
                </tbody>
            </table>
        </div>
    </div>


    <script>
        $(function() {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                // maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
                alert("You are " + years + " years old!");
            });
        });
    </script>
@stop
