<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $data['sales'] }}</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-alt"></i>
            </div>
            <a href="{{ route('sales.create') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $data['purchases'] }}</h3>

                <p>New Purchases</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-alt"></i>
            </div>
            <a href="{{route('purchases.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $data['users'] }}</h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-alt"></i>
            </div>
            <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$data['products']}}</h3>

                <p>Unique Products</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-alt"></i>
            </div>
            <a href="{{route('products.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
