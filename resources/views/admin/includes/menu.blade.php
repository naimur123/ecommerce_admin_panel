<body>
    <div class="container-fluid" id="app">
           <div class="row flex-nowrap">
               <nav class="navbar navbar-expand-lg fixed-top" style="background-color:#404E67">
                   <a class="navbar-brand text-white px-2" href="#">{{ $system->title_name }}</a>
                   <i class="bi bi-toggles2 text-white" data-bs-toggle="collapse" data-bs-target="#navbarGeneral" aria-controls="navbarGeneral" aria-expanded="false" aria-label="Toggle navigation"></i>
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                       <span class="navbar-toggler-icon"></span>
                   </button>
                   <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                   <ul class="navbar-nav">
                       <li class="nav-item">
                           <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded-circle" alt="Image" style="height: 30px; width:30px">
                       </li>
                       <li class="dropdown is-dropdown-submenu-parent collapsed">
                           <a class="colapse nav-link text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           {{ Auth::user()->name }}
                           </a>
                           <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                           
                           </div>
                       </li>
                       
                   </ul>
                   </div>
               </nav>
            
           </div>
   
           <div class="row flex-nowrap">
               <div class="col-2" style="background-color:#404E67; margin-top: 55px;" id="navbarGeneral">
                   {{-- <button class="navbar-toggler" > --}}
                   {{-- </button> --}}
                   <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                       <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                           @if(auth()->user()->can('Dashboard view'))
                              <li>
                                  <a href="{{ route('admin.home') }}" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-chart-line"></i><span id="menuSpan">Dashboard </span>
                                  </a>
                                      
                              </li>
                              @endif
      
                               {{-- Activity Log --}}
                               @if(auth()->user()->can('Activitylog view'))
                               <li>
                                  <a href="{{ route('admin.actvitylog') }}" class="nav-link px-0 text-white" style="text-decoration: none">
                                    <i class="fa-solid fa-hurricane"></i><span id="menuSpan">Activity Log</span>
                                  </a>
                                 
                               </li>
                              @endif
      
                              {{-- Order List  --}}
                              {{-- @if(auth()->user()->can("Order")) --}}
                              @if(auth()->user()->hasAnyPermission('Order view','Order create','Order edit','Order delete'))
                              <li>
                                  <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-check"></i></i><span id="menuSpan">Orders</span></a>
                                  <ul class="collapse nav flex-column " id="submenu2" data-bs-parent="#menu">
                                      <li class="w-100">
                                          <a href="#" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Order List</a>
                                      </li>
                                      <li>
                                          <a href="#" class="nav-link px-2 text-white"><i class="fa-solid fa-bell"></i> Pending Orders</a>
                                      </li>
                                      <li>
                                          <a href="#" class="nav-link px-2 text-white"><i class="fa-solid fa-box-archive"></i> Deleted Orders</a>
                                      </li>
                                  </ul>
                              </li>
                              @endif
                              
                              
                               {{-- Products --}}
                              {{-- @hasanyrole('superadmin|admin')  --}}
                              @if(auth()->user()->hasAnyPermission('Product view','Product create','Product edit','Product delete'))
                               <li>
                                  <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-bag-shopping"></i><span id="menuSpan">Products</span>
                                  </a>
                                  
                                  <ul class="collapse nav flex-column " id="submenu3">
                                      @if(auth()->user()->can('Product view'))
                                      <li >
                                          <a href="{{ route('admin.products') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Product List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Product create'))
                                      <li>
                                          
                                          <a href="{{ route('admin.products.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add New Product</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Product delete'))
                                      <li>
                                          <a href="{{ route('admin.products.archive') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-box-archive"></i> Deleted Products</a>
                                      </li>
                                      @endif
                                  </ul>
                              </li>
                              @endif
      
                              {{-- Categories --}}
                              <li>
                                  <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-person-half-dress"></i><span id="menuSpan"> Categories</span></a>
                                  <ul class="collapse nav flex-column " id="submenu4">
                                      @if(auth()->user()->can('Category view'))
                                      <li class="w-100">
                                          <a href="{{ route('admin.category') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Category List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Category create'))
                                      <li>
                                          <a href="{{ route('admin.category.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add Category</a>
                                      </li>
                                      @endif
                                      
                                  </ul>
                              </li>
                         

                              {{--Sub Categories --}}
                              <li>
                                  <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-child-dress"></i><span id="menuSpan"> Subcategories</span></a>
                                  <ul class="collapse nav flex-column " id="submenu5" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Subcategory view'))
                                      <li>
                                              <a href="{{ route('admin.subcategory') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Subcategory List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Subcategory create'))
                                      <li>
                                          <a href="{{ route('admin.subcategory.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add Subcategory</a>
                                      </li>
                                      @endif
                                      
                                  </ul>
                              </li>
                             
      
                              {{-- Brands --}}
                              <li>
                                  <a href="#submenu6" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-mobile"></i><span id="menuSpan">Brands</span></a>
                                  <ul class="collapse nav flex-column " id="submenu6" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Brand view'))
                                      <li class="w-100">
                                              <a href="{{ route('admin.brand') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Brand List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Brand create'))
                                      <li>
                                          <a href="{{ route('admin.brand.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add Brand</a>
                                      </li>
                                      @endif
                                  </ul>
                              </li>
                            
                               {{-- Countries --}}

                               <li>
                                  <a href="#submenu7" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                      <i class="fa-solid fa-globe"></i><span id="menuSpan">Countries</span></a>
                                  <ul class="collapse nav flex-column " id="submenu7" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Country view'))
                                      <li class="w-100">
                                              <a href="{{ route('admin.country') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Country List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Country create'))
                                      <li>
                                          <a href="{{ route('admin.country.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add Country</a>
                                      </li>
                                      @endif
                                  </ul>
                              </li>
                            
                               {{-- Currencies --}}
                               <li>
                                  <a href="#submenu12" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-dollar-sign"></i><span id="menuSpan">Currencies</span></a>
                                  <ul class="collapse nav flex-column " id="submenu12" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Currency view'))
                                      <li class="w-100">
                                          <a href="{{ route('admin.currency') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Currency List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Currency create'))
                                      <li>
                                          <a href="{{ route('admin.currency.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add Currency</a>
                                      </li>
                                      @endif
                                  </ul>
                              </li>
                              
      
                               {{-- Units --}}
                               
                               <li>
                                  <a href="#submenu8" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-weight-hanging"></i><span id="menuSpan">Units</span></a>
                                  <ul class="collapse nav flex-column " id="submenu8" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Unit view'))
                                      <li class="w-100">
                                          <a href="{{ route('admin.unit') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Unit List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Unit create'))
                                      <li>
                                          <a href="{{ route('admin.unit.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add Unit</a>
                                      </li>
                                      @endif
                                      {{-- <li>
                                          <a href="#" class="nav-link px-2 text-white">Deleted Units</a>
                                      </li> --}}
                                  </ul>
                              </li>
                              
                              
                              {{-- Coupon Code --}}
                              
                              <li>
                                  <a href="#submenu9" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-coins"></i><span id="menuSpan">Coupons</span></a>
                                  <ul class="collapse nav flex-column " id="submenu9" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Coupon view'))
                                      <li class="w-100">
                                          <a href="{{ route('admin.coupon') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Counpon Code List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Coupon create'))
                                      <li>
                                          <a href="{{ route('admin.coupon.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add Counpon Code</a>
                                      </li>
                                      @endif
                                      {{-- <li>
                                          <a href="#" class="nav-link px-2 text-white">Deleted Coupon Codes</a>
                                      </li> --}}
                                  </ul>
                              </li>
                              
      
                               {{-- Sliders --}}
                               
                               <li>
                                  <a href="#submenu10" data-bs-toggle="collapse" class="nav-link px-0 text-white ">
                                    <i class="fa-solid fa-images"></i><span id="menuSpan">Sliders</span></a>
                                  <ul class="collapse nav flex-column " id="submenu10" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Slider view'))
                                      <li class="w-100">
                                          <a href="{{ route('admin.slider') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Slider List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Slider create'))
                                      <li>
                                          <a href="{{ route('admin.slider.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add New Slider</a>
                                      </li>
                                      @endif
                                      {{-- <li>
                                          <a href="#" class="nav-link px-2 text-white">Deleted Sliders</a>
                                      </li> --}}
                                  </ul>
                               </li>
                               
      
                               {{-- Status --}}
                               <li>
                                  <a href="#submenu11" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-brands fa-creative-commons-sa"></i><span id="menuSpan">Generic Status</span></a>
                                  <ul class="collapse nav flex-column " id="submenu11" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Status view'))
                                      <li class="w-100">
                                          <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Generic Status List</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Status create'))
                                      <li>
                                          <a href="{{ route('admin.status.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-circle-plus"></i> Add Generic Status</a>
                                      </li>
                                      @endif
                                      {{-- <li>
                                          <a href="#" class="nav-link px-2 text-white">Deleted Status</a>
                                      </li> --}}
                                  </ul>
                              </li>
                              
      
                              {{-- Email --}}
                              
                              <li>
                                  <a href="#submenu13" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-envelope-circle-check"></i><span id="menuSpan">Email setup</span></a>
                                  <ul class="collapse nav flex-column " id="submenu13" data-bs-parent="#menu">
                                      {{-- <li class="w-100">
                                          <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Generic Status List</a>
                                      </li> --}}
                                      @if(auth()->user()->can('Emailsetup create'))
                                      <li>
                                          <a href="{{ route('admin.emailtemplate.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-file-word"></i> Email tempalte</a>
                                      </li>
                                      @endif
                                      {{-- <li>
                                          <a href="#" class="nav-link px-2 text-white">Deleted Status</a>
                                      </li> --}}
                                  </ul>
                              </li>
                              
      
                               {{-- Customer --}}
                               
                               <li>
                                  <a href="#submenu14" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-user"></i><span id="menuSpan">Customer</span></a>
                                  <ul class="collapse nav flex-column " id="submenu14" data-bs-parent="#menu">
                                      {{-- <li class="w-100">
                                          <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Generic Status List</a>
                                      </li> --}}
                                      @if(auth()->user()->can('Customer view'))
                                      <li>
                                          <a href="{{ route('admin.customer') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-users"></i> Customer list</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Customer delete'))
                                      <li>
                                          <a href="{{ route('admin.customer.archive') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-user-minus"></i> Deleted customer</a>
                                      </li>
                                      @endif
                                  </ul>
                               </li>
                               
      
                               {{-- Admin --}}
                               
                                <li>
                                  <a href="#submenu15" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-user-tie"></i><span id="menuSpan">Admin</span>
                                  </a>
                                  <ul class="collapse nav flex-column " id="submenu15" data-bs-parent="#menu" onclick="active">
                                     
                                      @if(auth()->user()->can('Admin view'))
                                      <li>
                                          <a href="{{ route('admin.admin') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-user-secret"></i> Admin list</a>
                                      </li>
                                      @endif
      
                                      @if(auth()->user()->can('Admin create'))
                                      <li>
                                          <a href="{{ route('admin.admin.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-user-plus"></i> Add new admin</a>
                                      </li>
                                      @endif
                                      {{-- <li>
                                          <a href="{{ route('admin.customer.archive') }}" class="nav-link px-2 text-white"><i class="bi bi-archive"></i> Deleted customer</a>
                                      </li> --}}
                                  </ul>
                              </li>
                              
      
                              
                                <li>
                                  <a href="#submenu16" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-globe"></i><span id="menuSpan">Website</span></a>
                                  <ul class="collapse nav flex-column " id="submenu16" data-bs-parent="#menu">
                                      {{-- <li class="w-100">
                                          <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Generic Status List</a>
                                      </li> --}}
                                      @if(auth()->user()->can('Website view'))
                                      <li>
                                          <a href="{{ route('admin.website.create') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-gear"></i> Settings</a>
                                      </li>
                                      @endif
      
                                      {{-- <li>
                                          <a href="{{ route('admin.customer.archive') }}" class="nav-link px-2 text-white"><i class="bi bi-archive"></i> Deleted customer</a>
                                      </li> --}}
                                  </ul>
                              </li>
                              
                       </ul>
                       <hr>
                   </div>
               </div>
               <div class="col-10" style="margin-top: 62px !important;">
                  <div class="contents">