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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">


    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    {{-- <link href="asset('frontend/css/style.css')" rel="stylesheet">
    <link href="asset('frontend/css/style.min.css')" rel="stylesheet"> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
          alert(msg);
        }
    </script>
   
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-light py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                    |
                    <a class="text-dark px-4 fw-bold" href="" style="text-decoration: none">
                        <i class="bi bi-heart fa-sm py-2"></i> Wish List
                    </a>
                    
                    @if (session()->has('user'))
                    <?php 
                      $user = session()->get('user');
                      $user = App\Models\User::find($user);
                    ?>
                    <a href="{{ route('user.dashboard',$user) }}"></i>{{ $user->name }}</a>
                    @else
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link text-dark fw-bolder" data-toggle="dropdown"><i class="bi bi-person-circle"></i> Account</a>
                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <a href="{{ route('user.showLoginform') }}" class="dropdown-item"><i class="bi bi-key-fill"></i> Login</a>
                            <a href="{{ route('user.registerForm') }}" class="dropdown-item"><i class="bi bi-person-plus"></i> Register</a>
                             
                        </div>
                    </div>
                    @endif
                   
                </div>
                
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold text-danger">{{ $system->title_name }}</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border border-2 border-danger" placeholder="Search for products">
                        {{-- <div class="input-group-append"> --}}
                            <span class="input-group-text bg-danger">
                                <i class="bi bi-search text-white"></i>
                            </span>
                        {{-- </div> --}}
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-6 ml-4">
                {{-- <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a> --}}
                <a href="{{ route('cart') }}" class="text-decoration-none">
                    <i class="bi bi-cart-plus fa-2x text-dark"><span class="mt-2" style="font-size: 20px">{{ count((array) session('cart')) }}</span></i>   
                </a>
               
            </div>
        </div>
        <div class="container">
  
            @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div> 
            @endif
          
            @yield('content')
           
        </div>
    </div>
    <!-- Topbar End -->

    <div class="container-fluid">
        @yield('all')
   </div>


    <!-- Footer Start -->
    <div class="container-fluid text-dark d-flex align-items-center justify-content-center" style="background-color: #EDF1FF !important;">
        <div class="row pt-5">
            <div class="text-center">
                <a href="" class="text-decoration-none ">
                    <h1 class="mb-4 display-5 fw-bold text-dark">KenaKata</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
           
        </div>
        
    </div>
    <!-- Footer End -->

    


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top pull-right"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="lib/easing/easing.min.js"></script> --}}
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/easing/easing.js') }}"></script>
    {{-- <script src="lib/owlcarousel/owl.carousel.min.js"></script> --}}
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

    <!-- Contact Javascript File -->
    {{-- <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script> --}}

    <!-- Template Javascript -->
    {{-- <script src="js/main.js"></script> --}}
    
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
   
   
</body>

</html>