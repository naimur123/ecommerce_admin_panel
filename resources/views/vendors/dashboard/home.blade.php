@extends('vendors.masterPage')

@section('content')

<div class="row">
    
        @if(auth()->user()->can('Order view'))
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
                
                <div class="card-footer text-center">
                    <a href="{{ route('vendor.order.list') }}" class="text-white text-decoration-none">All Orders</a>
                </div>
                
            </div>
        </div>
        @endif
        @if(auth()->user()->can('Order view'))
        <div class="col-md-4 col-12">
            <div class="card bg-info bg-gradient">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white mx-2 my-2">{{ $todayOrders }}</h4>
                            <h6 class="text-white mx-2">Today Orders</h6>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer text-center">
                    <a href="{{ route('admin.order.list') }}" class="text-white text-decoration-none">Today Orders</a>
                </div>
            </div>
        </div>
        @endif
</div>


@endsection
