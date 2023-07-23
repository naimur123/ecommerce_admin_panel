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
                           <img src="{{ asset(Auth::user()->image) }}" class="rounded-circle" alt="Image" style="height: 30px; width:30px">
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
                                  <a href="{{ route('admin.home') }}" class="nav-link px-0 align-middle text-white">
                                      <i class="bi bi-border-style"></i><span class="ms-1 d-none d-sm-inline text-white"> Dashboard </span>
                                  </a>
                                      
                              </li>
                              @endif
      
                               {{-- Activity Log --}}
                               @if(auth()->user()->can('Activitylog view'))
                               <li>
                                  <a href="{{ route('admin.actvitylog') }}" class="nav-link px-0 align-middle text-white" style="text-decoration: none">
                                      <i class="bi bi-person-workspace "></i><span class="ms-2 d-none d-sm-inline text-white">Activity Log</span>
                                  </a>
                                 
                               </li>
                              @endif
      
                              {{-- Order List  --}}
                              {{-- @if(auth()->user()->can("Order")) --}}
                              @if(auth()->user()->hasAnyPermission('Order view','Order create','Order edit','Order delete'))
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
                              @endif
                              {{-- @endhasanyrole --}}
                              
                               {{-- Products --}}
                              {{-- @hasanyrole('superadmin|admin')  --}}
                              @if(auth()->user()->hasAnyPermission('Product view','Product create','Product edit','Product delete'))
                               <li class="{{ isset($nav) && $nav == 'product' ? 'active' : null }}">
                                  <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                      <i class="bi bi-list-columns-reverse"></i><span class="ms-2 d-none d-sm-inline text-white mx-2">Products</span>
                                  </a>
                                  
                                  <ul class="collapse nav flex-column ms-1" id="submenu3">
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
                              @endif
      
                              {{-- Categories --}}
                              {{-- @hasanyrole('superadmin|admin') --}}
                              <li>
                                  <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                                      <i class="bi bi-collection-fill"></i><span class="ms-2 d-none d-sm-inline text-white">Categories</span></a>
                                  <ul class="collapse nav flex-column ms-1" id="submenu4">
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
                              {{-- @endhasanyrole --}}
   
                              {{-- @hasanyrole('superadmin|admin') --}}
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
                              {{-- @endhasanyrole --}}
      
                              {{-- Brands --}}
                              {{-- @hasanyrole('superadmin|admin') --}}
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
                              {{-- @endhasanyrole --}}
      
                               {{-- Countries --}}
                               {{-- @hasanyrole('superadmin|admin') --}}
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
                              {{-- @endhasanyrole --}}
   
                               {{-- Countries --}}
                               {{-- @hasanyrole('superadmin|admin') --}}
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
                              {{-- @endhasanyrole --}}
      
                               {{-- Units --}}
                               {{-- @hasanyrole('superadmin|admin') --}}
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
                              {{-- @endhasanyrole --}}
                              
                              {{-- Coupon Code --}}
                              {{-- @hasanyrole('superadmin|admin') --}}
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
                              {{-- @endhasanyrole --}}
      
                               {{-- Sliders --}}
                               {{-- @hasanyrole('superadmin|admin') --}}
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
                               {{-- @endhasanyrole --}}
      
                               {{-- Status --}}
                               {{-- @hasanyrole('superadmin|admin') --}}
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
                              {{-- @endhasanyrole --}}
      
                              {{-- Email --}}
                              {{-- @hasanyrole('superadmin|admin') --}}
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
                              {{-- @endhasanyrole --}}
      
                               {{-- Customer --}}
                               {{-- @hasanyrole('superadmin|admin') --}}
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
                               {{-- @endhasanyrole --}}
      
                               {{-- Admin --}}
                               {{-- @hasanyrole('superadmin|admin') --}}
                                <li>
                                  <a href="#submenu15" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                      <i class="bi bi-person-circle fa-lg text-white"></i><span class="ms-1 d-none d-sm-inline  text-white">Admin</span>
                                  </a>
                                  <ul class="collapse nav flex-column ms-1" id="submenu15" data-bs-parent="#menu" onclick="active">
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
                              {{-- @endhasanyrole --}}
      
                              {{-- @hasanyrole('superadmin|admin') --}}
                                <li>
                                  <a href="#submenu16" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                      <i class="bi bi-globe fa-lg text-white"></i><span class="ms-1 d-none d-sm-inline  text-white">Website</span></a>
                                  <ul class="collapse nav flex-column ms-1" id="submenu16" data-bs-parent="#menu">
                                      {{-- <li class="w-100">
                                          <a href="{{ route('admin.status') }}" class="nav-link px-2 text-white"><i class="bi bi-diagram-2"></i> Generic Status List</a>
                                      </li> --}}
                                      @if(auth()->user()->can('Website view'))
                                      <li>
                                          <a href="{{ route('admin.website.create') }}" class="nav-link px-2 text-white"><i class="bi bi-gear-fill"></i> Settings</a>
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