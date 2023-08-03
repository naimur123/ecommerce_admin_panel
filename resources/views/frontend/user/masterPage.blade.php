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
 <div class="container-fluid">
    <nav class="navbar col-lg-12 col-12 fixed-top" style="background-color: #d4d4d4; width: 80%; margin-left: 10%">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
         <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a href="{{ route('home') }}" class="d-flex align-items-center px-4 pb-3 mb-md-0 me-md-auto text-decoration-none">
            <span class="fs-5 d-none d-sm-inline" style="color: #404956;">{{ $system->title_name }}</span>
          </a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
         </div>  
        </div>
       <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <a href="{{ route('user.logout') }}" class="mx-4" style="text-decoration: none; color: #404956;">Logout</a>
      </div>
      
    </nav>
    <div class="row flex-nowrap">
        <div class="col-12" style="margin-top: 80px">
            @yield('contentHome')
        </div>
        
    </div>
        
 </div>
    
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    @include('sweetalert::alert')
   
</body>

</html>