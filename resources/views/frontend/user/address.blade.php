@extends('frontend.user.masterPage')
@section('content')
   <div class="col-10 col-lg-10 mt-2 mb-2">
    <form method="POST" action="{{ $form_url }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user" value="{{ $user }}">
        <div class="form-group">
            <label>Shipping Address<span class="text-danger">*</span></label>
            <input type="text" class="form-control " name="area_name" required >
        </div>

        <input type="checkbox" name="for_later" value="1">
        <label class="my-2">Save this address for future shipping address<span class="text-danger">*</span></label>
        

        <div class="form-group my-2">
            <label>Select Payment Method<span class="text-danger">*</span></label>
            <select class="form-control select2" name="payment_type" required >
                <option value="">Select method</option>
                <option value="Cash">Cash</option>
                <option value="Online">Online</option>
                                        
            </select>
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