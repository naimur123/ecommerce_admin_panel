@extends('admin.masterPage')

@section('content')

<div class="row">
    
        @if(auth()->user()->can('Dashboard view'))
        <div class="col-md-4 col-12">
            <div class="card bg-c-green">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white mx-2 my-2">{{ $user }}</h4>
                            <h6 class="text-white mx-2">Total Customer</h6>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->can('Customer view'))
                <div class="card-footer text-center">
                    <a href="{{ route('admin.customer') }}" class="text-white text-decoration-none">Customers</a>
                </div>
                @endif
            </div>
        </div>
        @endif
        @if(auth()->user()->can('Dashboard view'))
        <div class="col-md-4 col-12">
            <div class="card bg-warning bg-gradient">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white mx-2 my-2">{{ $vendor }}</h4>
                            <h6 class="text-white mx-2">Total Vendor</h6>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->can('Customer view'))
                <div class="card-footer text-center">
                    <a href="{{ route('admin.vendor') }}" class="text-white text-decoration-none">Vendors</a>
                </div>
                @endif
            </div>
        </div>
        @endif
        @if(auth()->user()->can('Dashboard view'))
        <div class="col-md-4 col-12">
            <div class="card bg-success bg-gradient">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white mx-2 my-2">{{ $allOrders }}</h4>
                            <h6 class="text-white mx-2">Total Orders</h6>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->can('Order view'))
                <div class="card-footer text-center">
                    <a href="{{ route('admin.order.list') }}" class="text-white text-decoration-none">All Orders</a>
                </div>
                @endif
            </div>
        </div>
        @endif
        @if(auth()->user()->can('Dashboard view'))
        <div class="col-md-4 col-12 mt-2">
            <div class="card bg-info bg-gradient">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white mx-2 my-2">{{ $todayOrders }}</h4>
                            <h6 class="text-white mx-2">Today Orders</h6>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->can('Order view'))
                <div class="card-footer text-center">
                    <a href="{{ route('admin.order.list') }}" class="text-white text-decoration-none">Today Orders</a>
                </div>
                @endif
            </div>
        </div>
        @endif
</div>


@endsection
