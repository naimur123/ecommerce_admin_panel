@extends('frontend.masterPage')
@section('all')
<div class="container-fluid">
    <div class="text-center mb-4 mt-2" id="headText">
        <h2 class="section-title px-5"><span class="px-2">{{ $title }} List</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-1 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image_one) }}" alt="" style="height: 200px">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h5 class="text-truncate mb-3">{{ $product->name }}</h5>
                    @if ($product->discount_price != 0)
                        <h6 class="text-primary">{{ $product->currency->currency_symbol }}{{ $product->price - $product->discount_price }}
                            <span class="text-decoration-line-through ms-1" style="font-size: 10px">{{ $product->currency->currency_symbol }}{{ $product->price }}</span>
                        
                        </h6>
                    @else
                        <h6 class="text-primary">{{ $product->currency->currency_symbol }}{{ $product->price }}</h6> 
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border-none">
                    <a href="{{ route('product.details',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i><strong>View Detail</strong></a>
                    <a href="{{ route('addtocart',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i><strong>Add To Cart</strong></a>
                </div>
                
            </div>
            
        </div>
        @endforeach
        
    </div>

</div>

@endsection