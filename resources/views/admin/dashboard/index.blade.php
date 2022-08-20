@extends('admin.masterPage')
@section('header')

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


@endsection