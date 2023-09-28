@extends('frontend.masterPage')
@section('all')

    <div class="col-12 my-2">
        <div class="row">
            {{-- image part --}}
            <div class="col-4 my-3">
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
            </div>
        
            {{-- Details part --}}
            <div class="col-8 my-3" id="productDetailsCard">
                <div class="card">
                    @foreach ($products as $product)
                        <div class="card-header">
                            <h4 class="text-black">{{ $product->name }}</h4>
                            <h6 class="text-black">Brand: <span class="text-primary">{{ $product->brands->name }}</span></h6>
                        </div>
                        <div class="card-body">
                            <h5 class="text-black">More Information</h5>
                            <h6 class="text-black">Brand: <span class="text-primary">{{ $product->brands->name }}</span> </h6>
                            <h6 class="text-black">Category: <span class="text-primary">{{ $product->categories->name }}</span> </h6>
                            @if(!empty($product->subcategory->name))
                            <h6 class="text-black">Subcategory: <span class="text-primary">{{ $product->subcategory->name ?? '' }}</span> </h6>
                            @else
                            @endif
                            {{-- <h6 class="text-black">Product Code: {{ $product->code }}</h6> --}}
                          
        
                        </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        
       
    </div>
    {{-- Buyer details --}}
    <div class="col-12 mt-2" id="buyerDetails">
        <div class="row">
            <h4 >By From</h4>
            @foreach ($vendors as $vendor)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            {{ $vendor->vendor->name }}
                            <h3 class="text-black">Price: 
                            @if ($vendor->discount_price != 0)
                                <span class="text-primary">{{ $vendor->currency->currency_symbol }}{{ $vendor->price - $vendor->discount_price }}</span> 
                                &nbsp;<span class="text-decoration-line-through" style="font-size: 15px">{{ $vendor->currency->currency_symbol }}{{ $vendor->price }}</span>
                            @else
                                <span class="text-primary">{{ $vendor->currency->currency_symbol }}{{ $vendor->price }}</span> 
                            @endif
                            </h3>
                            @if ($vendor->quantity != 0)
                                <button class="btn btn-primary btn-sm">In Stock: {{ $vendor->quantity }}</button>
                            @else
                                <button class="btn btn-danger">Stock out</button>
                            @endif
                            <br>
                            <a href="{{ route('addtocart',$vendor->id) }}" class="btn mt-2" role="button" style="background-color: rgba(96, 153, 244, 0.5)"><strong class="text-primary">Add to cart</strong></a>
                        </h5>
                    </div>
                </div>
            </div>  
            @endforeach  
        </div>
        
    </div>

    {{-- Product full details --}}
    <div class="col-12 mt-2" id="prodcutDescription">
        <div class="row">
            @foreach ($products as $product)
                <div class="card">
                    <div class="card-body">
                          <h4 class="text-black"><b>Description:</b></h4>
                          <p><strong>{{ strip_tags($product->short_description) }}</strong></p>
                          <p>{!! $product->long_description !!}</p>
                    </div>
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