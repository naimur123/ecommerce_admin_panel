@extends('frontend.masterPage')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mt-2 mb-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="cart" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width:50%">Product</th>
                                <th style="width:10%">Price</th>
                                <th style="width:8%">Quantity</th>
                                <th style="width:22%" class="text-center">Subtotal</th>
                                <th style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                    <tr data-id="{{ $id }}">
                                        <td data-th="Product">
                                            <div class="row">
                                                <div class="col-sm-3 hidden-xs"><img src="{{ asset('storage/'.$details['image']) }}" width="100" height="100" class="img-responsive"/></div>
                                                <div class="col-sm-9">
                                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price">৳{{ $details['price'] }}</td>
                                        <td data-th="Quantity">
                                            {{-- <input type="hidden" id="id" value="{{ $id }}"> --}}
                                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                                        </td>
                                        <td data-th="Subtotal" class="text-center">৳{{ $details['price'] * $details['quantity'] }}</td>
                                        <td class="actions" data-th="">
                                            <a href="{{ route('cart.delete', $id) }}" class="btn btn-danger btn-sm remove-from-cart"><i class="fa-solid fa-box-archive"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" style="text-align:center"><h3>Cart Empty</h3></td>
                                </tr> 
                    
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-center"><h3><strong>Total ৳{{ $total }}</strong></h3></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">
                                    <a href="{{ route('home') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                                </td>
                                @if(!empty(session('cart')))
                                    
                                    <td colspan="2" class="text-left">
                                        
                                        <a href="{{ route('cart.checkout') }}" class="btn btn-success"  role="button">Checkout</a>
                                        
                                    </td>
                                @endif
                            </tr>
                        </tfoot>
                    </table>
                </div>
                {{-- <table id="cart" class="table table-hover table-condensed">
                   
                </table> --}}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('cart.update') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });
</script>


@endsection








