@extends('frontend.user.masterPage')
@section('content')
 @if(session('error'))
    <div class="alert alert-danger">
    {{ session('error') }}
    </div> 
 @endif
<div class="row">
    <form method="POST" action="{{ route('pay.cash.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user" value="{{ $user }}">
    <div class="col-md-8 order-md-1">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
            @if(session('cart'))
             @foreach(session('cart') as $id => $details)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{ $details['name'] }}</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">{{ $details['price'] }}</span>
                </li>
             @endforeach
            @endif

            <li class="list-group-item d-flex justify-content-between">
                <span>Subtotal (BDT)</span>
                <input type="text" name="sub_total_price" style="border:none; margin-right:-10em" value="{{ $subtotal }}">
                {{-- <strong>{{ $subtotal }}</strong> --}}
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Shipping cost(BDT)</span>
                <input type="text" name="shipping_cost" style="border:none; margin-right:-10em" value="{{ $shipping_cost }}">
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (BDT)</span>
                <input type="text" name="total_price" style="border:none; margin-right:-10em" value="{{ $total}}">
            </li>
        </ul>
        <h4 class="mb-3">Billing address</h4>
        <?php 
         $user = App\Models\User::find($user);
        ?>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="firstName">Full name</label>
                    <input type="text" class="form-control"  placeholder=""
                           value="{{ $user->name }}" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label for="mobile">Mobile</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+88</span>
                    </div>
                    @if(empty($user->phone))
                     <input type="text"  class="form-control" name="phone" placeholder="Mobile" value="{{ !empty($user->phone) ? $user->phone : "" }}" required>
                    @else
                     <input type="text"  class="form-control" placeholder="Mobile" value="{{ $user->phone }}" readonly>
                    @endif

                </div>
            </div>

            <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control" placeholder="you@example.com" value="{{ $user->email }}" readonly>
            </div>

            <div class="mb-3">
                <label for="address">Shipping address</label>
                <input type="text" class="form-control" id="address" name="area_name" placeholder="1234 Main St" required>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"  name="for_later" value="1" id="save-info">
                <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div>
            <hr class="mb-4">
           
            <button type="submit" class="btn btn-primary btn-lg btn-block">Pay Cash</button>
             

            <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                    token="if you have any token validation"
                    postdata="your javascript arrays or objects which requires in backend"
                    order="If you already have the transaction generated for current order"
                    endpoint="{{ url('/pay') }}"> Pay Now
            </button>
        </form>
    </div>
</div>

<script type="text/javascript">
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>

@endsection