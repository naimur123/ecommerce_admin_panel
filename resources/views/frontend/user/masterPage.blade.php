<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="refresh" content="30"> --}}

    <!-- BootStrap Path -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.min.css">
    {{-- <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    {{-- Bootstrap icons --}}
    <link rel="stylesheet" href="{{ asset('fonts/vendor/bootstrap-icons/bootstrap-icons.woff') }}">
    <link rel="stylesheet" href="{{ asset('fonts/vendor/bootstrap-icons/bootstrap-icons.woff2') }}">
    <title>Laravel Ecommerce</title>
    
</head>
<body>
 <div class="container-fluid">
    <nav class="navbar col-lg-12 col-12 fixed-top d-flex flex-row" style="background-color:#404E67">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
         <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a href="" class="d-flex align-items-center px-4 pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">KenaKata</span>
          </a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
         </div>  
        </div>
       <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <a href="" class="text-white mx-4" style="text-decoration: none">Logout</a>
        {{-- <ul class="navbar-nav navbar-nav-right">
    
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul> --}}
        {{-- <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button> --}}
      </div>
      
    </nav>
        <div class="row flex-nowrap">
            <div class="col-m-4 col-md-3 col-xl-2 px-sm-2 px-0 py-4" style="background-color:#404E67;">
                <div class="d-flex flex-column align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    {{-- <a href="{{ route('admin.home') }}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Laravel Ecommerce</span>
                    </a> --}}
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 py-4 align-items-sm-start" id="menu">
                        <li>
                            <a href="" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-border-style"></i><span class="ms-1 d-none d-sm-inline text-white"> Dashboard </span>
                            </a>
                           
                        </li>

                        


                       
                        
                         {{-- Products --}}
                         {{-- <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-list-columns-reverse"></i><span class="ms-2 d-none d-sm-inline text-white mx-2">Products</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.products') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Product List</a>
                                </li>
                                
                                <li>
                                    
                                    <a href="{{ route('admin.products.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add New Product</a>
                                </li>
                                
                                <li>
                                    <a href="{{ route('admin.products.archive') }}" class="nav-link px-2 text-white"><i class="bi bi-archive"></i> Deleted Products</a>
                                </li>
                            </ul>
                        </li> --}}

                    </ul>
                    <hr>
                    
                </div>
            </div>
            {{-- <div class="navbar navbar-expand-lg navbar-light bg-light"> --}}
                {{-- <div class="col py-8">
                    @yield('content')
                </div> --}}
            {{-- </div> --}}
            <div class="col-m-8 py-4" style="padding-top: 4.5rem !important;">
                @yield('content')
            </div>
            
        </div>
        
 </div>
    
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
   
</body>

</html>