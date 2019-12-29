
<!DOCTYPE html>
<html>

<!-- Mirrored from adminlte.io/themes/dev/AdminLTE/pages/examples/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2019 06:01:45 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $company['company']['name'] }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('plugins/ionicframework/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .content-wrapper, .main-footer, .main-header {
            transition: margin-left .3s ease-in-out;
            /* margin-left: 250px; */
            z-index: 3000;
        }
    </style>
</head>
<body>
<div class="wrapper" style="width: 100%">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px" id="printDiv">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> {{ $company['company']['name'] }}.
                                        <small class="float-right">Date: {{ date('Y-m-d') }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ $company['company']['name'] }}.</strong><br>
                                        {{ $company['company']['address'] }}<br>
                                        Phone: {{ $company['company']['phone'] }}<br>

                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ $data['sales']['customer_name'] }}</strong><br>

                                        Phone: {{$data['sales']['customer_phone']}}<br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #{{ $data['sales']['invoice_code'] }}</b><br>
                                    <br>
                                    <b>Payment Date:</b> {{ date('Y-m-d'),strtotime($data['sales']['updated_at']) }}<br>
                                    <b>Amount:</b> {{ $data['sales']['net_total'] }} Tk
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 60%">Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data['sales']['sales_details'] as $key=> $value)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $value['product']['name'] }}</td>
                                            <td>{{ $value['quantity'] }}</td>
                                            <td>{{ $value['price'] }} tk</td>
                                            <td>{{ $value['subtotal'] }} tk</td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <p class="lead">Remarks:</p>

                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        {!! $data['sales']['remarks'] !!}
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Gross Total:</th>
                                                <td>{{ $data['sales']['gross_total'] }} tk</td>
                                            </tr>
                                            <tr>
                                                <th>Discount:</th>
                                                <td>{{ $data['sales']['discount'] }} tk</td>
                                            </tr>
                                            <tr>
                                                <th>Net Total:</th>
                                                <td>{{ $data['sales']['net_total'] }} tk</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="" @click.prevent="printMe" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>

                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
    printMe:
        window.print();
</script>
</body>

<!-- Mirrored from adminlte.io/themes/dev/AdminLTE/pages/examples/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2019 06:01:46 GMT -->
</html>
