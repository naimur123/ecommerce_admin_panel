@extends('admin.masterPage')
@section('content')
<div class="col-10 col-lg-10 mt-2 mb-2">
    <div class="card">
    <div class="card-body">
       @if(session('success'))
                   <div class="alert alert-success">
                     {{ session('success') }}
                   </div> 
       @endif
       @if(session('error'))
                   <div class="alert alert-danger">
                     {{ session('error') }}
                   </div> 
       @endif
       <form class="row form-horizontal" action="{{ $form_url }}" method="POST" enctype="multipart/form-data">
           @csrf
           <div class="col-7">
             <h3 class="text-danger">Permission Access for {{ $admin->name ?? ""}}</h3>
             <input type="hidden" name="admin" value="{{ $admin->id }}">
           </div>
           <hr>
           <div class="col-7">
            <h3 class="text-danger">Role</h3>
            <input type="hidden" name="admin" value="{{ $admin->id }}">
            <div class="col-12 mt-2 ml-3">
              @foreach ($roles as $role)
                  <input type="radio" class="form-check-input" name="name" value="{{ $role->name }}" @if($admin->hasAnyRole($role->name))
                  checked
                  @endif >
                      <label class="form-check-label" for="{{ $role->id }}">{{ ucfirst(trans($role->name)) }}</label>
                  <br>
              @endforeach
            </div>
          </div>
          <br>
          <hr>
          
          
           <!-- Permissions !-->
           <div class="row">
              <div class="col-8">
                <h3 class="text-danger">Permissions</h3>
              </div>
              <div class="col-4">
                {{-- <label class="btn" style="background-color: #01a9ac; border-color:#01a9ac" for="checkall"><input type="checkbox" id="checkall" checked autocomplete="off">Checkall</label> --}}
                <button type="button" class="btn btn-warning btn-sm all-check"> <i class="fas fa-check"></i> Check All</button>
                <button type="button" class="btn btn-danger btn-sm all-uncheck"> <i class="fas fa-times"></i> Uncheck All</button>
                <button type="submit" class="btn btn-success btn-sm">Save Permission</button>
              </div>
           </div>
         
         
           {{-- <div class="col-12 mt-2 ml-3">
               
                    <div class="form-check">
                      
                        @php
                             $index = 1;
                        @endphp
                        @foreach($permissions->groupBy('group_name') as $groupname => $accesses)
                            <h2>{{$groupname}}</h2>
                        <hr>
                        @foreach ($accesses as $permission)
                            <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->id }}" @if($admin->can($permission->name))
                            checked
                            @endif>
                            <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                            <hr>
                        @endforeach
                        @php
                            $index++;
                        @endphp
                        @endforeach
                    </div>
               
            
               <br>
          </div> --}}
                @php
                    $index = 1;
                @endphp
                @foreach($permissions->groupBy('group_name') as $groupname => $accesses)
                <div class="col-sm-3 my-2">
                  <div class="card">
                    <div class="card-body">
                       <h2 class="card-title">{{$groupname}}</h2>
                   @foreach ($accesses as $permission)
                      <input type="checkbox" class="form-check-input" name="permissions[]" id="{{ $permission->id }}" value="{{ $permission->id }}" @if($admin->can($permission->name)) checked @endif>
                      <label class="form-check-label" for="{{ $permission->id }}">{{ $permission->name }}</label>
                      <br>
                   @endforeach
                    </div>
                   </div>
                   <br>
                </div>
                @php
                $index++;
                @endphp
                @endforeach

                <!--submit -->
              <div class="col-12 text-left py-2">
                <div class="form-group text-left">
                    <button type="submit" class="btn btn-info">Submit </button>
              </div>
        </div>
                
              
   
       </form>
    </div>
   </div>
   <script type="text/javascript">
    $(document).on("click", '.all-check', function(){
            let all_checkbox = $("form input[type='checkbox']");
            all_checkbox.each(function(i, list){
                $(list).prop("checked", true);
            });
        });
        $(document).on("click", '.all-uncheck', function(){
            let all_checkbox = $("form input[type='checkbox']");
            all_checkbox.each(function(i, list){
                $(list).prop("checked", false);
            });
        });
  
   </script>
   
@endsection
