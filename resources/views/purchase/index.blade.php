@extends('partials.app')
@section('title','Purchases')
@section('title-card-h1','Purchases')
@section('title-card-small','Manage purchases')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Purchase</li>
    </ol>
@stop
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    @if($user_type == 'manager')
    <p><a href="{{ route('purchases.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Purchase</a></p>
    @endif
    <div class="card">
        <div class="card-header">
            <h2>Unapproved Purchases</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice</th>
                    <th>Suplier Name</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th style="width: 15%">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['purchases'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['invoice_code'] }}</td>
                        <td>{{ $value['supplier']['name'] }}</td>
                        <td>{{ $value['gross_total'] }} tk</td>
                        <td>{{ $value['discount'] }} tk</td>
                        <td>{{ $value['net_total'] }} tk</td>
                        <td><a href="{{ route('purchases.show', $value['id']) }} " class="btn btn-default"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            @if($user_type == 'manager')
                            <a href="{{ route('purchases.edit', $value['id']) }} " class="btn btn-info"><i
                                    class="fa fa-pen-nib" aria-hidden="true"></i></a>
                            <form action="{{ route('purchases.delete', $value['id']) }}" method="post"
                                  id="form-in-index-page-for-delete"
                                  onsubmit=" return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i
                                        class="fa fa-trash-alt" aria-hidden="true"></i></button>
                            </form>
                            @endif
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
            <h2>Approved Purchases</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped table-sm table-hover" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice</th>
                    <th>Suplier Name</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['approved_purchases'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['invoice_code'] }}</td>
                        <td>{{ $value['supplier']['name'] }}</td>
                        <td>{{ $value['gross_total'] }} tk</td>
                        <td>{{ $value['discount'] }} tk</td>
                        <td>{{ $value['net_total'] }} tk</td>
                        <td><a href="{{ route('purchases.show', $value['id']) }} " class="btn btn-default"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('purchases.print',$value['id']) }}" class="btn btn-success" target="_blank"><i class="fas fa-print"></i></a>
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
