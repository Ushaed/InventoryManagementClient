@extends('partials.app')
@section('title','Products')
@section('title-card-h1','Products')
@section('title-card-small','Manage product')
@section('timelineBar')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                    class="nav-icon fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
        <li class="breadcrumb-item active">Product</li>
    </ol>
@stop
@push('customCss')
@endpush
@section('content')
    @php
        $user_type = request()->cookie('userType');
    @endphp
    @if($user_type == 'manager')
    <p><a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Product</a></p>
    @endif
    <div class="card">
        <div class="card-header">
            <h2>Available Products</h2>
            <div class="card-tools">
                <div class="input-group input-group-sm mt-2" style="width: 350px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search"
                           id="product_search" onkeyup="myFunction()">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-sm table-hover" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 30%">Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Status</th>
                    <th style="width: 18%">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['products'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['name'] }}</td>
                        <td>{{ $value['category']['name'] }}</td>
                        <td>{{ $value['brand']['name'] }}</td>
                        <td>{{ $value['buy_price'] }} tk</td>
                        <td>{{ $value['sell_price'] }} tk</td>
                        @if($value['status'] === '1')
                            <td><span id="status-bg-success">Active</span></td>
                        @elseif($value['status'] === '2')
                            <td><span id="status-bg-danger">Inactive</span></td>
                        @endif
                        <td><a href="{{ route('products.show', $value['id']) }} " class="btn btn-default"><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                            @if($user_type == 'manager')
                            <a href="{{ route('products.edit', $value['id']) }} " class="btn btn-info"><i
                                    class="fas fa-pen-nib" aria-hidden="true"></i></a>

                            <form action="{{ route('products.delete', $value['id']) }}" method="post"
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
                        <td colspan="8">No data found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($user_type == 'manager')
    <div class="card">
        <div class="card-header">
            <h2>Deleted Products</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped table-sm" id="dataTable1">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 30%">Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['deleted_products'] as $key => $value)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $value['name'] }}</td>
                        <td>{{ $value['category']['name'] }}</td>
                        <td>{{ $value['brand']['name'] }}</td>
                        <td>{{ $value['buy_price'] }} tk</td>
                        <td>{{ $value['sell_price'] }} tk</td>
                        @if($value['status'] === 1)
                            <td><span id="status-bg-success">Active</span></td>
                        @elseif($value['status'] == 2)
                            <td><span id="status-bg-danger">Inactive</span></td>
                        @endif
                        <td>
                            <a href="{{ route('products.restore', $value['id']) }} " class="btn btn-success">
                                <i class="fa fa-trash-restore-alt" aria-hidden="true"></i> Restore
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-danger text-center">
                        <td colspan="8">No data found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif
@stop
@push('customJs')
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("product_search");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

@endpush
