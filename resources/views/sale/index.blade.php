@extends('partials.app')
@section('title','Sales')
@section('title-card-h1','Sales')
@section('title-card-small','Manage sales')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Sales</li>
    </ol>
@stop
@section('content')
    <p><a href="{{ route('sales.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Sales</a></p>
    <div class="card">
        <div class="card-header">
            <h2>Sales</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice Code</th>
                    <th>Customer Name</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th style="width: 15%">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['sales'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{$value['invoice_code'] }}</td>
                        <td>{{ $value['customer_name'] == '' ? 'Not Given': $value['customer_name'] }}</td>
                        <td>{{ $value['gross_total'] }} tk</td>
                        <td>{{ $value['discount'] }} tk</td>
                        <td>{{ $value['net_total'] }} tk</td>
                        <td><a href="{{ route('sales.show', $value['id']) }} " class="btn btn-default"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('sales.edit', $value['id']) }} " class="btn btn-info"><i
                                    class="fa fa-pen-nib" aria-hidden="true"></i></a>
                            <form action="{{ route('sales.delete', $value['id']) }}" method="post"
                                  id="form-in-index-page-for-delete"
                                  onsubmit=" return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i
                                        class="fa fa-trash-alt" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="text-danger text-center">
                        <td colspan="7">No data found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2>Approved Sales</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped table-sm" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice Code</th>
                    <th>Customer Name</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['approved_sales'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['invoice_code'] }}</td>
                        <td>{{ $value['customer_name'] == '' ? 'Not Given': $value['customer_name'] }}</td>
                        <td>{{ $value['gross_total'] }} tk</td>
                        <td>{{ $value['discount'] }} tk</td>
                        <td>{{ $value['net_total'] }} tk</td>
                        <td><a href="{{ route('sales.show', $value['id']) }} " class="btn btn-default"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('sales.print', $value['id']) }} " class="btn btn-success" target="_blank"><i
                                    class="fa fa-print" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-danger text-center">
                        <td colspan="7">No data found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@stop
