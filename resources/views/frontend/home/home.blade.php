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
<div class="row">
    {{-- slider --}}
    <div class="col-md-12 my-3 text-center" style="width: 80%; margin-left: 10%">
        <div id="header-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach($sliders as $key => $slider)
                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/'.$slider->image)}}" class="d-block w-100"  alt="..." style="height: 400px">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#header-carousel" role="button"  data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#header-carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" role="button" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2" aria-hidden="true"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" role="button" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2" aria-hidden="true"></span>
                </div>
            </a>
            
        </div>
    
    </div>
</div>

{{-- </div> --}}
<!-- Navbar End -->

<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">

            
            <div class="card product-item border-2 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image_one) }}" alt="" style="height: 200px">
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
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{ route('product.details',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i><strong>View Detail</strong></a>
                    <a href="{{ route('addtocart',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i><strong>Add To Cart</strong></a>
                </div>
                
            </div>
            
        </div>
        @endforeach
        
    </div>
    
</div>
<!-- Products End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Newly Arrived</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($latest_products as $latest)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">

            
            <div class="card product-item border-2 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ asset('storage/'.$latest->image_one) }}" alt="" style="height: 200px">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{ $latest->name }}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>৳{{ $latest->price }}</h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{ route('product.details',$latest->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i><strong>View Detail</strong></a>
                    <a href="{{ route('addtocart',$latest->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i><strong>Add To Cart</strong></a>
                </div>
                
            </div>
            
        </div>
        @endforeach
    </div>
</div>

<script>
//     $(document).ready(function () {
//     // Handle the mouse hover event
//     $(".category-item").hover(
//       function () {
//         $(this).find(".subcategory-card").fadeIn(200);
//       },
//       function () {
//         $(this).find(".subcategory-card").fadeOut(200);
//       }
//     );
//   });
</script>
<!-- Products End -->
@endsection