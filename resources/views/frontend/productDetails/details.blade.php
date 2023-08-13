@extends('frontend.masterPage')
@section('all')

    {{-- slider details part --}}
    <div class="col-4 my-3">
        {{-- <div class="swiper-wrapper">
            @foreach ($products as $product)
                @php
                    $product_id = $product->id;
                @endphp
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $product->image_one) }}" alt="..." style="height: 400px">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $product->image_two) }}" alt="..." style="height: 400px">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $product->image_three) }}" alt="..." style="height: 400px">
                </div>
            @endforeach
        </div> --}}
        <div class="gallery">
            @foreach ($products as $product)
            <div class="main-image">
              <img id="mainImg" src="{{ asset('storage/' . $product->image_one) }}" alt="Main Image">
            </div>
            <div class="thumbnails">
                <div class="thumbnail" onclick="changeImage('{{ asset('storage/' . $product->image_one) }}')"> 
                    <img src="{{ asset('storage/' . $product->image_one) }}" alt="Thumbnail 1">
                </div>
              
              @if ($product->image_two)
                <div class="thumbnail" onclick="changeImage('{{ asset('storage/' . $product->image_two) }}')"> 
                    <img src="{{ asset('storage/' . $product->image_two) }}" alt="Thumbnail 2">
                </div>
              @endif
              @if ($product->image_three)
                <div class="thumbnail" onclick="changeImage('{{ asset('storage/' . $product->image_three) }}')">
                    <img src="{{ asset('storage/' . $product->image_three) }}" alt="Thumbnail 3">
                </div>
              @endif
            </div>
            @endforeach
        </div>

        <!-- Add to cart button here -->
        {{-- <div style="margin-left: 55px;" id="detailsCart">
            <a href="{{ route('addtocart', $product_id) }}" class="btn btn-outline-primary" style="width: 250px" role="button">
                <i class="fas fa-shopping-cart"></i>Add to cart
            </a>
        </div> --}}
    </div>

    {{-- Details part --}}
    <div class="col-8 my-3" id="productDetailsCard">
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
                    @if(!empty($product->subcategory->name))
                    <h6 class="text-black">Subcategory: {{ $product->subcategory->name ?? '' }}</h6>
                    @else
                    @endif
                    <h6 class="text-black">Product Code: {{ $product->code }}</h6>
                    <h6 class="text-black"><b>Details:</b></h6>
                    <p><strong>{{ strip_tags($product->short_description) }}</strong></p>
                    <p>{!! $product->long_description !!}</p>

                </div>
            @endforeach
            
        </div>
    </div>
    
<script>
    function changeImage(imageSrc) {
        const mainImage = document.getElementById('mainImg');
        mainImage.src = imageSrc;
    }
</script>


@endsection