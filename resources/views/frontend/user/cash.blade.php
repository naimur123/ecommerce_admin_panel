@extends('frontend.user.masterPage')
@section('content')

<div class="col-10 col-lg-10 mt-2 mb-2">
    <form method="POST" action="{{ route('pay.cash.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user" value="{{ $user }}">
        <div class="form-group">
            <label>Shipping Address<span class="text-danger">*</span></label>
            <select class="form-control select2" name="shipping_id" required >
                <option value="">Select address</option>
                @foreach($shipping as $address)
                   <option value="{{ $address->id }}">{{ $address->area_name }}</option>
                @endforeach                           
            </select>
        </div>
        <div class="form-group">
            <label>Subtotal Amount<span class="text-danger">*</span></label>
            <input type="text" class="form-control " name="sub_total_price" value="{{ $subtotal }}" readonly >
        </div>
        <div class="form-group">
            <label>Shipping Cost<span class="text-danger">*</span></label>
            <input type="text" class="form-control " name="shipping_cost" value="{{ $shipping_cost }}" readonly >
        </div>
        <div class="form-group">
            <label>Total Amount<span class="text-danger">*</span></label>
            <input type="text" class="form-control " name="total_price" value="{{ $total}}" readonly >
        </div>
       

        
        <!--submit -->
        <div class="col-12 text-right py-2">
            <div class="form-group text-right">
                <button type="submit" class="btn btn-info">Save </button>
            </div>
        </div>

    </form>
     {{-- <h3>{{ $user }}</h3> --}}
   </div>

@endsection