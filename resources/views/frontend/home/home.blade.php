@extends('frontend.masterPage')
@section('all')
<!-- Navbar Start -->
<div class="container-fluid mb-5">

    <div class="row border-top px-xl-5">
        <div class="col-lg-3 my-4 d-none d-lg-block">
            <a class="d-flex align-items-center justify-content-center text-decoration-none bg-danger text-white w-100 " {{-- data-toggle="collapse" href="#navbar-vertical" --}} style="height: 65px;">
                <h3 class="m-0 fw-bold">Categories</h3>
                {{-- <i class="fa fa-angle-down text-dark"></i> --}}
            </a>
            <nav class="show navbar navbar-vertical navbar-light align-items-start p-2  border border-danger border-top-0 border-bottom-2" {{-- id="navbar-vertical" --}}>
                <div class="navbar-nav w-100 overflow-hidden mx-2" style="height: 400px;">
                    <div class="nav-item dropdown">
                            @foreach ($subcategories as $subcategory)
                              
                                    <a href="#" class="nav-link text-dark fw-bold">{{ $subcategory->categories->name }}<i class="fa fa-angle-down float-right mt-1"></i></a>
                                        <div {{-- class="dropdown-menu bg-secondary border-2 rounded-0 w-100 m-0" --}} class="bg-secondary border-2">
                                            <a href="" class="dropdown-item">{{ $subcategory->name }}</a>
                                        </div>
                                        <hr>
                            @endforeach
                            @foreach ($categories as $category)
                                    <a href="#" class="nav-link text-dark fw-bold" {{-- data-toggle="dropdown" --}}>{{ $category->name }}</a>
                                    <hr>
                                        
                            @endforeach
                           
                    </div>
                       
                </div>
            </nav>
        </div>
        <div class="col-lg-9 my-4">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="{{ route('home') }}" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold text-danger">KenaKata</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="shop.html" class="nav-item nav-link">Shop</a>
                        <a href="detail.html" class="nav-item nav-link">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                   
                </div>
                {{-- <div class="row">
                    <div class="col-4">col</div>
                    <div class="col-4">col</div>
                    <div class="col-4">col</div>
                    
                </div> --}}
                    {{-- <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="d-flex align-items-center border mb-6" style="padding: 20px;">
                            <h1 class="fa fa-check text-primary m-0 mr-3"></h1> Quality Product
                            {{-- <h5 class="fw-bold m-0">Quality Product</h5> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="d-flex align-items-center border mb-6" style="padding: 10px;">
                            <h1 class="fas fa-exchange-alt text-primary m-0 mr-md-5 d-inline-block"></h1>14-Day Return
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="d-flex align-items-center border mb-6" style="padding: 10px;">
                            <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>24/7 Support
                            
                        </div>
                    </div> --}}
                   
                
            </nav>
            
            <div id="header-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    </ol>
                    <div class="carousel-inner">
                        @foreach($sliders as $key => $slider)
                        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                            <img src="{{ asset($slider->image)}}" class="d-block w-100"  alt="..." style="height: 400px">
                            {{-- <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">{{ $slider->title }}</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ $slider->description }}</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>  --}}
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
</div>
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
                    <img class="img-fluid w-100" src="{{ asset($product->image_one) }}" alt="" style="height: 200px">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>৳{{ $product->price }}</h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="{{ route('addtocart',$product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
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
        <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($latest_products as $latest)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">

            
            <div class="card product-item border-2 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ asset($latest->image_one) }}" alt="" style="height: 200px">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{ $latest->name }}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>৳{{ $latest->price }}</h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
                
            </div>
            
        </div>
        @endforeach
    </div>
</div>
<!-- Products End -->
@endsection