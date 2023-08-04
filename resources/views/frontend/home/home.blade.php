@extends('frontend.masterPage')
@section('all')
<div class="row">
    <!-- Navbar Start Category+Sub-->
    <div class="col-lg-12" style="background-color: #404956;">
            <ul class="nav justify-content-center">
                @foreach ($categories as $category)
                <li class="nav-item category-item">
                  @if (count($category->subcategories) < 0)
                    <a href="{{ route('nameWise.product.show',["name" =>"category","id"=> $category->id]) }}" class="nav-link category-name" data-category-id="{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                  @else
                    <a href="#" class="nav-link category-name" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                    <div class="subcategory-card">
                        <ul class="subcategory-details">
                        @foreach ($category->subcategories as $subcategory)
                        <a href="{{ route('nameWise.product.show',["name" =>"subcategory","id"=> $subcategory->id]) }}" class="text-decoration-none">
                            <li>{{ $subcategory->name }}</li>
                        </a>
                        @endforeach
                        </ul>
                    </div>
                  @endif
                </li>
                @endforeach
            </ul>
    </div>
</div>
{{-- slider --}}
<div class="row">
    <div class="swiper mySwiperSlider">
        <div class="swiper-wrapper col-md-12 text-center">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <img src="{{ asset('storage/'.$slider->image)}}" class="d-block w-100" alt="..." style="height: 400px">
            </div>
            @endforeach
        </div>
    </div>
 
</div>
{{-- end --}}


<!-- Trandy product Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5" id="headText">
            <span class="px-2">Trandy Products</span>
        </h2>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
            <div class="swiper-slide col-lg-3 col-md-6 col-sm-6" id="productSwipper">             
                <div class="card border-2 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image_one) }}" alt="" style="height: 200px;">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h5 class="text-truncate mb-3">{{ $product->name }}</h5>
                        <div class="d-flex justify-content-center">
                            @if ($product->discount_price != 0)
                                <h6 class="text-primary">{{ $product->currency->currency_symbol }}{{ $product->price - $product->discount_price }}
                                    <span class="text-decoration-line-through ms-1" style="font-size: 10px">{{ $product->currency->currency_symbol }}{{ $product->price }}</span>
                                
                                </h6>
                            @else
                                <h6 class="text-primary">{{ $product->currency->currency_symbol }}{{ $product->price }}</h6> 
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-light border">
                        <a href="{{ route('product.details',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i><strong>View Detail</strong></a>
                        <a href="{{ route('addtocart',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i><strong>Add To Cart</strong></a>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination" style="display: none"></div>
    </div>
    
</div>
<!--End -->


<!--Latest Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4" id="headText">
        <h2 class="section-title px-5"><span class="px-2">Newly Arrived</span></h2>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($latest_products as $product)
            <div class="swiper-slide col-lg-3 col-md-6 col-sm-6" id="productSwipper">             
                <div class="card border-2 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image_one) }}" alt="" style="height: 200px;">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h5 class="text-truncate mb-3">{{ $product->name }}</h5>
                        <div class="d-flex justify-content-center">
                            @if ($product->discount_price != 0)
                                <h6 class="text-primary">{{ $product->currency->currency_symbol }}{{ $product->price - $product->discount_price }}
                                    <span class="text-decoration-line-through ms-1" style="font-size: 10px">{{ $product->currency->currency_symbol }}{{ $product->price }}</span>
                                
                                </h6>
                            @else
                                <h6 class="text-primary">{{ $product->currency->currency_symbol }}{{ $product->price }}</h6> 
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-light border">
                        <a href="{{ route('product.details',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i><strong>View Detail</strong></a>
                        <a href="{{ route('addtocart',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i><strong>Add To Cart</strong></a>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination" style="display: none"></div>
    </div>
</div>
{{-- end --}}

<!-- Brands start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4" id="headText">
        <h2 class="section-title px-5"><span class="px-2">Popular Brands</span></h2>
    </div>
    <div class="swiper mySwiperBrand">
        <div class="swiper-wrapper">
            @foreach ($brands as $brand)
            <div class="swiper-slide col-lg-3 col-md-6 col-sm-6" id="productSwipper">             
                <div class="card border-2 mb-4">
                    <div class="card-header bg-transparent border-none p-0">
                       <a href="{{ route('nameWise.product.show',["name" =>"brand","id"=> $brand->id]) }}"><img class="img-fluid w-100" src="{{ asset('storage/'.$brand->image) }}" alt="" style="height: 50px;"></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination" style="display: none"></div>
    </div>
</div>

<!-- END -->


<!-- Products End -->
@endsection