@extends('admin.masterPage')

@section('content')

@if(auth()->user()->can('Dashboard view'))
<div class="col-xl-3 col-md-3 col-sm-6">
    <div class="card bg-c-green update-card">
        <div class="card-block">
            <div class="row align-items-end">
                <div class="col-8">
                    <h4 class="text-white mx-2 my-2">{{ $user }}</h4>
                    <h6 class="text-white mx-2">Total Customers</h6>
                </div>
            </div>
        </div>
        @if(auth()->user()->can('Customer view'))
        <div class="card-footer text-center">
            <a href="{{ route('admin.customer') }}" class="text-white text-decoration-none">Customer</a>
        </div>
        @endif
    </div>
 </div>
 @endif
@endsection
