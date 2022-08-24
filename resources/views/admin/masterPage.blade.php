<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Ecommerce</title>
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
    {{-- <link rel="stylesheet" href="{{ asset('fonts/vendor/bootstrap-icons/bootstrap-icons.woff') }}">
    <link rel="stylesheet" href="{{ asset('fonts/vendor/bootstrap-icons/bootstrap-icons.woff2') }}"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    
</head>
<body>
 <div class="container-fluid">
    <nav class="navbar col-lg-12 col-12 fixed-top d-flex flex-row" style="background-color:#404E67">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
         <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a href="{{ route('admin.home') }}" class="d-flex align-items-center px-4 pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Laravel Ecommerce</span>
          </a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
         </div>  
        </div>
       <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <a href="{{ route('admin.logout') }}" class="text-white mx-4" style="text-decoration: none">Logout</a>
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
                        @if(auth()->user()->can('Dashboard view'))
                        <li>
                            <a href="{{ route('admin.home') }}" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-border-style"></i><span class="ms-1 d-none d-sm-inline text-white"> Dashboard </span>
                            </a>
                                
                        </li>
                        @endif

                         {{-- Activity Log --}}
                         @if(auth()->user()->can('Activitylog view'))
                         {{-- @hasanyrole('admin') --}}
                         <li>
                            <a href="{{ route('admin.actvitylog') }}" class="nav-link px-0 align-middle text-white" style="text-decoration: none">
                                <i class="bi bi-person-workspace "></i><span class="ms-2 d-none d-sm-inline text-white">Activity Log</span>
                            </a>
                           
                         </li>
                         {{-- @endhasanyrole --}}
                        @endif

                        {{-- Order List  --}}
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-cart4 fa-lg"></i></i><span class="ms-2 d-none d-sm-inline text-white">Orders</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2">Order List</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2">Pending Orders</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2">Deleted Orders</a>
                                </li>
                            </ul>
                        </li>
                        
                         {{-- Products --}}
                         {{-- @hasanyrole('superadmin|admin') --}}
                         <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-list-columns-reverse"></i><span class="ms-2 d-none d-sm-inline text-white mx-2">Products</span>
                            </a>
                            
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                @if(auth()->user()->can('Product view'))
                                <li class="w-100">
                                    <a href="{{ route('admin.products') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Product List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Product create'))
                                <li>
                                    
                                    <a href="{{ route('admin.products.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add New Product</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Product delete'))
                                <li>
                                    <a href="{{ route('admin.products.archive') }}" class="nav-link px-2 text-white"><i class="bi bi-archive"></i> Deleted Products</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        {{-- @endhasanyrole --}}

                        {{-- Categories --}}
                        <li>
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-collection-fill"></i><span class="ms-2 d-none d-sm-inline text-white">Categories</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                                @if(auth()->user()->can('Category view'))
                                <li class="w-100">
                                    <a href="{{ route('admin.category') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Category List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Category create'))
                                <li>
                                    <a href="{{ route('admin.category.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add Category</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Category</a>
                                </li> --}}
                            </ul>
                        </li>
                        {{--Sub Categories --}}
                        <li>
                            <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-subtract"></i><span class="ms-2 d-none d-sm-inline text-white">Subcategories</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                                @if(auth()->user()->can('Subcategory view'))
                                <li>
                                        <a href="{{ route('admin.subcategory') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Subcategory List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Subcategory create'))
                                <li>
                                    <a href="{{ route('admin.subcategory.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add Subcategory</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Sub-Category</a>
                                </li> --}}
                            </ul>
                        </li>

                        {{-- Brands --}}
                        <li>
                            <a href="#submenu6" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-playstation fa-lg"></i><span class="ms-1 d-none d-sm-inline text-white">Brands</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu6" data-bs-parent="#menu">
                                @if(auth()->user()->can('Brand view'))
                                <li class="w-100">
                                        <a href="{{ route('admin.brand') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Brand List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Brand create'))
                                <li>
                                    <a href="{{ route('admin.brand.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add Brand</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Brand</a>
                                </li> --}}
                            </ul>
                        </li>

                         {{-- Countries --}}
                         <li>
                            <a href="#submenu7" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-solid fa-globe text-white"></i><span class="ms-2 d-none d-sm-inline text-white">Countries</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu7" data-bs-parent="#menu">
                                @if(auth()->user()->can('Country view'))
                                <li class="w-100">
                                        <a href="{{ route('admin.country') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Country List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Country create'))
                                <li>
                                    <a href="{{ route('admin.country.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add Country</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Countries</a>
                                </li> --}}
                            </ul>
                        </li>
                         {{-- Countries --}}
                         <li>
                            <a href="#submenu12" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-currency-exchange fa-lg"></i><span class="ms-1 d-none d-sm-inline text-white">Currencies</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu12" data-bs-parent="#menu">
                                @if(auth()->user()->can('Currency view'))
                                <li class="w-100">
                                    <a href="{{ route('admin.currency') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Currency List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Currency create'))
                                <li>
                                    <a href="{{ route('admin.currency.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add Currency</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Currency</a>
                                </li> --}}
                            </ul>
                        </li>

                         {{-- Units --}}
                         <li>
                            <a href="#submenu8" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-unity fa-lg"></i><span class="ms-1 d-none d-sm-inline text-white">Units</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu8" data-bs-parent="#menu">
                                @if(auth()->user()->can('Unit view'))
                                <li class="w-100">
                                    <a href="{{ route('admin.unit') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Unit List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Unit create'))
                                <li>
                                    <a href="{{ route('admin.unit.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add Unit</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Units</a>
                                </li> --}}
                            </ul>
                        </li>
                        
                        {{-- Coupon Code --}}
                        <li>
                            <a href="#submenu9" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                <i class="bi bi-coin"></i><span class="ms-2 d-none d-sm-inline text-white">Coupons</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu9" data-bs-parent="#menu">
                                @if(auth()->user()->can('Coupon view'))
                                <li class="w-100">
                                    <a href="{{ route('admin.coupon') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Counpon Code List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Coupon create'))
                                <li>
                                    <a href="{{ route('admin.coupon.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add Counpon Code</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Coupon Codes</a>
                                </li> --}}
                            </ul>
                        </li>

                         {{-- Sliders --}}
                         @hasanyrole('superadmin|admin')
                         <li>
                            <a href="#submenu10" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white ">
                                <i class="bi bi-sliders fa-lg"></i><span class="ms-1 d-none d-sm-inline  text-white">Sliders</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu10" data-bs-parent="#menu">
                                @if(auth()->user()->can('Slider view'))
                                <li class="w-100">
                                    <a href="{{ route('admin.slider') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Slider List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Slider create'))
                                <li>
                                    <a href="{{ route('admin.slider.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add New Slider</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Sliders</a>
                                </li> --}}
                            </ul>
                         </li>
                         @endhasanyrole

                         {{-- Status --}}
                         <li>
                            <a href="#submenu11" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa fa-cloud text-white"></i> <span class="ms-1 d-none d-sm-inline  text-white">Generic Status</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu11" data-bs-parent="#menu">
                                @if(auth()->user()->can('Status view'))
                                <li class="w-100">
                                    <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Generic Status List</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Status create'))
                                <li>
                                    <a href="{{ route('admin.status.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add Generic Status</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Status</a>
                                </li> --}}
                            </ul>
                        </li>

                        {{-- Email --}}
                        @hasanyrole('superadmin|admin')
                        <li>
                            <a href="#submenu13" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="bi bi-envelope-exclamation-fill text-white"></i> <span class="ms-1 d-none d-sm-inline  text-white">Email setup</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu13" data-bs-parent="#menu">
                                {{-- <li class="w-100">
                                    <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Generic Status List</a>
                                </li> --}}
                                @if(auth()->user()->can('Emailsetup create'))
                                <li>
                                    <a href="{{ route('admin.emailtemplate.create') }}" class="nav-link px-2 text-white"><i class="bi bi-file-word"></i> Email tempalte</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Status</a>
                                </li> --}}
                            </ul>
                        </li>
                        @endhasanyrole

                         {{-- Customer --}}
                         @hasanyrole('superadmin|admin')
                         <li>
                            <a href="#submenu14" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="bi bi-people fa-lg text-white"></i> <span class="ms-1 d-none d-sm-inline  text-white">Customer</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu14" data-bs-parent="#menu">
                                {{-- <li class="w-100">
                                    <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Generic Status List</a>
                                </li> --}}
                                @if(auth()->user()->can('Customer view'))
                                <li>
                                    <a href="{{ route('admin.customer') }}" class="nav-link px-2 text-white"><i class="bi bi-person-lines-fill"></i> Customer list</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Customer delete'))
                                <li>
                                    <a href="{{ route('admin.customer.archive') }}" class="nav-link px-2 text-white"><i class="bi bi-archive"></i> Deleted customer</a>
                                </li>
                                @endif
                            </ul>
                         </li>
                         @endhasanyrole

                         {{-- Admin --}}
                         @hasanyrole('superadmin|admin')
                          <li>
                            <a href="#submenu15" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="bi bi-person-circle fa-lg text-white"></i><span class="ms-1 d-none d-sm-inline  text-white">Admin</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu15" data-bs-parent="#menu">
                                {{-- <li class="w-100">
                                    <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Generic Status List</a>
                                </li> --}}
                                @if(auth()->user()->can('Admin view'))
                                <li>
                                    <a href="{{ route('admin.admin') }}" class="nav-link px-2 text-white"><i class="bi bi-person-lines-fill"></i> Admin list</a>
                                </li>
                                @endif

                                @if(auth()->user()->can('Admin create'))
                                <li>
                                    <a href="{{ route('admin.admin.create') }}" class="nav-link px-2 text-white"><i class="bi bi-cloud-plus-fill"></i> Add new admin</a>
                                </li>
                                @endif
                                {{-- <li>
                                    <a href="{{ route('admin.customer.archive') }}" class="nav-link px-2 text-white"><i class="bi bi-archive"></i> Deleted customer</a>
                                </li> --}}
                            </ul>
                        </li>
                        @endhasanyrole
                        {{-- <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                                </li>
                            </ul>
                        </li> --}}
                      
                        {{-- <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-warning">Logout</button>
                            </form>
                                
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
               {{-- {{ auth()->user() }} --}}
            </div>
            
        </div>
        
 </div>
    
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    {{-- <script>
        $(".nav-link").click(function(){
            return true;
        })
    </script> --}}
    
   
</body>

</html>