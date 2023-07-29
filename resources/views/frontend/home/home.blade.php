@extends('frontend.masterPage')
@section('all')
<style>
    .category-item {
      position: relative;
    }

    .category-name {
      color: white;
      text-decoration: none;
    }

    .category-name:hover {
      color: #f16a4f;
    }

    .subcategory-card {
        position: absolute;
        top: 100%;
        left: 0;
        display: none;
        background-color: rgb(200, 197, 197);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 2px;
        width: 200px;
        z-index: 100;
    }

    .category-item:hover .subcategory-card {
      display: block;
    }

    .subcategory-details {
      list-style-type: none;
      padding: 0;
    }

    .subcategory-details li {
      color: black;
      margin-bottom: 5px;
    }

    .subcategory-details li:hover {
      color: #f16a4f;
    }

    /* swipper */
    .swiper-slide {
        text-align: center;
        font-size: 18px;
    }

    
   
</style>

<div class="row">
    <!-- Navbar Start Category+Sub-->
    <div class="col-lg-12" style="background-color: #404956;">
            <ul class="nav justify-content-center">
                @foreach ($categories as $category)
                <li class="nav-item category-item">
                  <a href="#" class="nav-link category-name" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                  @if (count($category->subcategories) > 0)
                  <div class="subcategory-card">
                    <ul class="subcategory-details">
                      @foreach ($category->subcategories as $subcategory)
                      <li>{{ $subcategory->name }}</li>
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
        <div class="swiper-wrapper col-md-12 my-3 text-center">
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
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
            <div class="swiper-slide col-lg-3 col-md-6 col-sm-6">             
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
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Newly Arrived</span></h2>
    </div>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($latest_products as $product)
            <div class="swiper-slide col-lg-3 col-md-6 col-sm-6">             
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


{{-- swipperjs --}}
<script type="text/javascript">
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
        breakpoints: {
            991: {
                slidesPerView: 4,
            },
            767: {
                slidesPerView: 2,
            },
        },
    });

    var swiperSlider = new Swiper(".mySwiperSlider", {
        slidesPerView: 1,
        spaceBetween: 30,
        autoplay: {
            delay: 3000,
        },
        speed: 800,
    });
</script>


<!-- Products End -->
@endsection