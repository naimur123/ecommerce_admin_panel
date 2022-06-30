<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- BootStrap Path -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    {{-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/solid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/light.css') }}"> --}}
    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>Laravel Ecommerce</title>
    
</head>
<body>
    
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color:#404E67">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Laravel Ecommerce</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline text-white">Dashboard</span> </a>
                            {{-- <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                                </li>
                            </ul> --}}
                        </li>
                        {{-- Order List  --}}
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline text-white">Orders</span></a>
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
                         <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fa fa-bars text-white"></i><span class="ms-2 d-none d-sm-inline text-white mx-2">Products</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.products') }}" class="nav-link px-2 text-white">Product List</a>
                                </li>
                                
                                <li>
                                    
                                    <a href="{{ route('admin.products.create') }}" class="nav-link px-2 text-white">Add New Product</a>
                                </li>
                                {{-- <li>
                                    <a href="#" class="nav-link px-2">Deleted Products</a>
                                </li> --}}
                            </ul>
                        </li>

                        {{-- Categories --}}
                        <li>
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-solid fa-arrows-to-dot text-white"></i><span class="ms-1 d-none d-sm-inline text-white">Categories</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('admin.category') }}" class="nav-link px-2 text-white">Category List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.category.create') }}" class="nav-link px-2 text-white">Add Category</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Category</a>
                                </li>
                            </ul>
                        </li>
                        {{--Sub Categories --}}
                        <li>
                            <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-solid fa-arrows-to-eye text-white"></i><span class="ms-1 d-none d-sm-inline text-white">Sub Categories</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2 text-white">Sub-Category List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.subcategory.create') }}" class="nav-link px-2 text-white">Add SubCategory</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Sub-Category</a>
                                </li>
                            </ul>
                        </li>

                        {{-- Brands --}}
                        <li>
                            <a href="#submenu6" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-brands fa-42-group text-white"></i><span class="ms-1 d-none d-sm-inline text-white">Brands</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu6" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2 text-white">Brand List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.brand.create') }}" class="nav-link px-2 text-white">Add Brand</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Brand</a>
                                </li>
                            </ul>
                        </li>

                         {{-- Countries --}}
                         <li>
                            <a href="#submenu7" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-solid fa-globe text-white"></i><span class="ms-1 d-none d-sm-inline text-white">Countries</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu7" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2 text-white">Country List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.country.create') }}" class="nav-link px-2 text-white">Add Country</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Countries</a>
                                </li>
                            </ul>
                        </li>
                         {{-- Countries --}}
                         <li>
                            <a href="#submenu12" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-solid fa-coins text-white"></i><span class="ms-1 d-none d-sm-inline text-white">Currencies</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu12" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2 text-white">Currency List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.currency.create') }}" class="nav-link px-2 text-white">Add Currency</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Currency</a>
                                </li>
                            </ul>
                        </li>

                         {{-- Units --}}
                         <li>
                            <a href="#submenu8" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-duotone fa-ball-pile"></i><span class="ms-1 d-none d-sm-inline text-white">Units</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu8" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2 text-white">Unit List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.unit.create') }}" class="nav-link px-2 text-white">Add Unit</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Units</a>
                                </li>
                            </ul>
                        </li>
                        
                        {{-- Coupon Code --}}
                        <li>
                            <a href="#submenu9" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa-solid fa-block-brick-fire"></i><span class="ms-1 d-none d-sm-inline text-white">Coupons</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu9" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2">Counpon Code List</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2">Add Counpon Code</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2">Deleted Coupon Codes</a>
                                </li>
                            </ul>
                        </li>

                         {{-- Sliders --}}
                         <li>
                            <a href="#submenu10" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline  text-white">Sliders</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu10" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2">Slider List</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2">Add New Slider</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2">Deleted Sliders</a>
                                </li>
                            </ul>
                        </li>

                         {{-- Status --}}
                         <li>
                            <a href="#submenu11" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fa fa-cloud text-white"></i> <span class="ms-1 d-none d-sm-inline  text-white">Generic Status</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu11" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="#" class="nav-link px-2 text-white">Generic Status List</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.status.create') }}" class="nav-link px-2 text-white">Add Generic Status</a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link px-2 text-white">Deleted Sliders</a>
                                </li>
                            </ul>
                        </li>
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
                        
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline  text-white">Customers</span> </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-warning">Logout</button>
                            </form>
                                {{-- <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline  text-white">Logout</span> </a> --}}
                        </li>
                    </ul>
                    <hr>
                    
                </div>
            </div>
            {{-- <div class="navbar navbar-expand-lg navbar-light bg-light"> --}}
                <div class="col py-3">
                    @yield('content')
                </div>
            {{-- </div> --}}
            
        </div>
        
    </div>
    
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>