<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $system->application_name }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicon -->
    {{-- <link href="img/favicon.ico" rel="icon"> --}}

    <!-- BootStrap Path -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   
    {{-- swipperjs --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    {{-- customcss --}}
    <link rel="stylesheet" href="{{ asset('frontend/custom/customStyle.css') }}">
    
   
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row py-2" style="background-color: #d4d4d4;">
            <div class="col-lg-3 d-lg-block" id="titleBlock">
                <div class="d-inline-flex align-items-center">
                    <a href="{{ route('home') }}" class="text-decoration-none">
                        <h1 class="m-0 font-weight-semi-bold" style="color: #f16a4f">{{ $system->title_name }}</h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="d-flex justify-content-center">
                    <form action="">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control border-none shadow-none" placeholder="Search for products">
                            <button type="submit" class="input-group-text" style="background-color: #f16a4f; border: none;">
                                <i class="fa-brands fa-searchengin text-white" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="col-lg-3">
                <div class="login-cart">
                    <div class="login-signup">
                        <a href="{{ route('cart') }}" class="text-decoration-none" style="color: #404956">
                            <i class="fa-solid fa-cart-plus"></i>Cart({{ count((array) session('cart')) }})
                        </a>
                    </div>
                    <div>
                        @if (session()->has('user'))
                            <?php 
                                $user = session()->get('user');
                                $user = App\Models\User::where('id',$user)->first();
                            ?>
                            <a href="{{ route('user.dashboard',$user->id) }}">{{ $user->name }}</a>
                        @else
                            <a href="{{ route('user.showLoginform') }}" class="text-decoration-none" style="color: #404956"><i class="fa-solid fa-user"></i> Login/Signup</a>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="container">
            @yield('content')
        </div>
    </div>
    <!-- Topbar End -->

    <div class="container-fluid">
        @yield('all')
    </div>


    <!-- Footer Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white" id="footerCard" style="background-color: #404956">
                    <div class="card-body text-center">
                        <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                        <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                    </div>
                    <div class="card-footer text-end">
                        <a href="#" class="btn back-to-top shadow-none pull-right" style="color: #f16a4f;"><i class="fa fa-angle-double-up"></i></a>
                    </div>
                </div>
                   
            </div>
        
        
    </div>
    <!-- Footer End -->


    


    <!-- JavaScript Libraries -->
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('frontend/custom/customJs.js') }}"></script>
    
    @include('sweetalert::alert')
    <script>
        //input search text
        $(document).ready(function(){
            $("#searchInput").on("input", function(){
                var text = $("#searchInput").val();
                console.log(text);
                $.ajax({
                    url: '{{ route('search.product')}}?text='+text,
                    type: 'get',
                    success: function (res) {
                        console.log(res)
                    }
                });
            })
            
        })

       // end
    </script>
   
</body>

</html>