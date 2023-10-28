{{-- @extends('frontend.user.masterPage') --}}
@extends('frontend.masterPage')
{{-- @section('contentHome') --}}
@section('all')
 {{-- @if(session('error'))
    <div class="alert alert-danger">
    {{ session('error') }}
    </div> 
 @endif --}}
<div class="row mt-2">
    <div class="col-12 col-lg-12">
        <div class="card">
           <div class="card-body">
            <form class="row form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="user" id="user_id" value="{{ $user }}">
                @csrf
                <div class="col-md-6 mt-2">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-3">Billing address</h4>
                            </div>
                            <div class="card-body">
                                <?php 
                                  $user = App\Models\User::find($user);
                                ?>
                                <div class="col-md-12 mb-3">
                                    <label for="firstName">Full name</label>
                                    <input type="text" class="form-control" name="name" placeholder="" value="{{ $user->name }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+880</span>
                                        </div>
                                        @if(empty($user->phone))
                                            <input type="text"  class="form-control" id="phone" name="phone" placeholder="Mobile" value="" required>
                                        @else
                                            <input type="text"  class="form-control" id="phone" name="phone" placeholder="Mobile" value="{{ $user->phone }}" readonly>
                                        @endif
                            
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ !empty($user->email) ? $user->email : "" }}">
                                </div>
                                <div class="col-md-12">
                                    <label>Division<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="shipping_id" id="shipping_id" required >
                                        <option value="">Select Division</option>
                                        @foreach($shippings as $shipping)
                                            <option value="{{ $shipping->id }}" > {{ $shipping->division }} </option>     
                                        @endforeach                           
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="address_details">Shipping address</label>
                                    <input type="text" class="form-control" id="address_details" name="address_details">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- &nbsp; --}}
                <div class="col-md-6 mt-2">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h5>Your cart</h5>
                            </div>
                            <div class="card-body">
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
                                        <p id="sub_total_price">{{ $subtotal }}</p>
                                        {{-- <strong>{{ $subtotal }}</strong> --}}
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Shipping cost(BDT)</span>
                                        <p id="shipping_cost">{{ $shipping_cost }}</p>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total (BDT)</span>
                                        <p id="total_amount">{{ $total}}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
               
            </form>
           </div>
        <div class="card-footer text-end border-none">
            <button id="cashPayBtn" class="btn btn-primary" style="height: 40px; width:20%">Cash</button>
            <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                        token="if you have any token validation"
                        postdata=""
                        order="xyz"
                        endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
            </button>
        </div>
        </div>
    </div>
</div>

<!-- ssl commrez integration-->
<script type="text/javascript">
    var shipping_id = '';
    var obj = {};
    obj.user_id = $('#user_id').val();
    obj.phone = $('#phone').val();
    $('#shipping_id').on('change', function (){
        shipping_id = this.value;
        obj.shipping_id = shipping_id;
    });
    $('#address_details').on('input', function () {
        obj.address_details = $(this).val();
    });
    obj.payment_type_id = 1;
    obj.sub_total_price = $('#sub_total_price').text();
    obj.shipping_cost = $('#shipping_cost').text();
    obj.total_amount = $('#total_amount').text();

    $('#sslczPayBtn').prop('postdata', obj);

    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
{{-- Cash Integration --}}
<script type="text/javascript">
    $(document).ready(function() {
        $("#cashPayBtn").click(function() {
            var formData = $("form").serialize();
            var subtotal = $("#sub_total_price").text();
            var shippingCost = $("#shipping_cost").text();
            var totalAmount = $("#total_amount").text();
            formData += "&subtotal=" + subtotal + "&shipping_cost=" + shippingCost + "&total_amount=" + totalAmount;
            console.log(formData);
            $.ajax({
                url: '{{ route('pay.cash.store') }}',
                type: 'POST',
                data: formData,
                success: function(res) {
                    console.log(res);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your order is been placed!',
                        icon: 'success',
                        onClose: function () {
                            window.location.replace(res.url);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>

@endsection