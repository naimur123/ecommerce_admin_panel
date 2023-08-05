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
                           <img src="{{ asset('storage/'.Auth::user()->picture) }}" class="rounded-circle" alt="Image" style="height: 30px; width:30px">
                       </li>
                       <li class="dropdown is-dropdown-submenu-parent collapsed">
                           <a class="colapse nav-link text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           {{ Auth::user()->name }}
                           </a>
                           <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('vendor.logout') }}">Logout</a>
                           
                           </div>
                       </li>
                       
                   </ul>
                   </div>
               </nav>
            
           </div>
   
           <div class="row flex-nowrap">
               <div class="col-2" style="background-color:#404E67; margin-top: 52px;" id="navbarGeneral">
                   {{-- <button class="navbar-toggler" > --}}
                   {{-- </button> --}}
                   <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                       <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                              <li>
                                  <a href="{{ route('vendor.home') }}" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-chart-line"></i><span id="menuSpan">Dashboard </span>
                                  </a>
                                      
                              </li>

      
                              {{-- Order List  --}}
                              {{-- @if(auth()->user()->can("Order")) --}}
                              @if(auth()->user()->hasAnyPermission('Order view','Order create','Order edit','Order delete'))
                              <li>
                                  <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 text-white">
                                    <i class="fa-solid fa-check"></i></i><span id="menuSpan">Orders</span></a>
                                  <ul class="collapse nav flex-column " id="submenu2" data-bs-parent="#menu">
                                      @if(auth()->user()->can('Order view'))
                                      <li class="w-100">
                                          <a href="{{ route('vendor.order.list') }}" class="nav-link px-2 text-white"><i class="fa-solid fa-list"></i> Order List</a>
                                      </li>
                                      @endif
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
                              {{-- @if(auth()->user()->hasAnyPermission('Product view','Product create','Product edit','Product delete'))
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
                              @endif --}}
                       </ul>
                       <hr>
                   </div>
               </div>
               <div class="col-10" style="margin-top: 62px !important;">
                  <div class="contents">