@extends('frontend.masterPage')
@section('content')
<div class="row">
    {{-- image part --}}
    <div class="col-4">
        <div id="header-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                <ol class="carousel-indicators">
                    @for($i = 0; $i < 3; $i++)
                        <li data-target="#header-carousel" data-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"></li>
                    @endfor
                </ol>
                @foreach ($products as $product)
                    @php
                        $product_id = $product->id;
                    @endphp
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/' . $product->image_one) }}" class="d-block" alt="..." style="height: 400px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $product->image_two) }}" class="d-block" alt="..." style="height: 400px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $product->image_three) }}" class="d-block" alt="..." style="height: 400px;">
                    </div>
                @endforeach
               
            </div>
            <a class="carousel-control-prev" href="#header-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#header-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href="{{ route('addtocart',$product_id) }}" class="btn btn-outline-primary" style="width:250px" role="button"><i class="fas fa-shopping-cart"></i>Add to cart</a>
        </div>

    </div>
    
    {{-- details part --}}
    <div class="col-8">
        <div class="card">
            @foreach ($products as $product)
               <div class="card-header">
                   <h4 class="text-black">{{ $product->name }}</h4>
                   <h6 class="text-black">Brand: <span class="text-primary">{{ $product->brands->name }}</span></h6>
                   <h3 class="text-black">Price: 
                    @if ($product->discount_price != 0)
                      <span class="text-primary">{{ $product->currency->currency_symbol }}{{ $product->price - $product->discount_price }}</span> 
                      &nbsp;<span class="text-decoration-line-through" style="font-size: 15px">{{ $product->currency->currency_symbol }}{{ $product->price }}</span>
                    @else
                      <span class="text-primary">{{ $product->currency->currency_symbol }}{{ $product->price }}</span> 
                    @endif
                  </h3>
                  @if ($product->quantity != 0)
                      <button class="btn btn-primary btn-sm">In Stock: {{ $product->quantity }}</button>
                  @else
                      <button class="btn btn-danger">Stock out</button>
                  @endif
               </div>
               <div class="card-body">
                   <h5 class="text-black">More Information</h5>
                   <h6 class="text-black">Brand: {{ $product->brands->name }}</h6>
                   <h6 class="text-black">Category: {{ $product->categories->name }}</h6>
                   <h6 class="text-black">Subcategory: {{ $product->subcategory->name ?? '' }}</h6>
                   <h6 class="text-black">Product Code: {{ $product->code }}</h6>
                   <h6 class="text-black"><b>Details:</b></h6>
                   <p><strong>{{ strip_tags($product->short_description) }}</strong></p>
                   <p>{!! $product->long_description !!}</p>

               </div>
            @endforeach
            
        </div>
    </div>

</div>
<script type="text/javascript">
   $(document).ready(function () {
        $(".carousel-control-prev").click(function () {
            $("#header-carousel").carousel("prev");
        });

        $(".carousel-control-next").click(function () {
            $("#header-carousel").carousel("next");
        });

        $("#header-carousel").on("slide.bs.carousel", function () {
            var activeIndex = $(this).find(".carousel-item.active").index();
            var totalItems = $(this).find(".carousel-item").length;

            if (activeIndex === 0) {
                $(".carousel-control-prev").hide();
            } else {
                $(".carousel-control-prev").show();
            }

            if (activeIndex === totalItems - 1) {
                $(".carousel-control-next").hide();
            } else {
                $(".carousel-control-next").show();
            }
        });
    });
</script>

@endsection