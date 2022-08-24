@extends('admin.masterPage')
@section('content')
<div class="col-10 col-lg-10 mt-2 mb-2">
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
           <div class="col-12 mt-2 ml-3">
            @foreach ($roles as $role)
                <input type="checkbox" class="form-check-input" name="name" value="{{ $role->name }}" >
                    <label class="form-check-label" for="{{ $role->id }}">{{ $role->name }}</label>
                <hr>
            @endforeach
           </div>
          
           <div class="col-12 mt-2 ml-3">
               
                    <div class="form-check">
                      
                        @php
                             $index = 1;
                        @endphp
                        @foreach($permissions->groupBy('group_name') as $groupname => $accesses)
                            <h2>{{$groupname}}</h2>
                        <hr>
                        @foreach ($accesses as $permission)
                          {{-- @foreach ($hasPermissions as $hasPermission) --}}
                            <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->id }}" @if(old($permission->id)== $permission->id) checked @endif>
                            <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                            <hr>
                          {{-- @endforeach --}}
                        @endforeach
                        @php
                            $index++;
                        @endphp
                        @endforeach
                    </div>
               
            
            <br>
            </div>

            <div>
              {{-- @foreach ($hasPermissions as $hasPermission) --}}
                {{-- {{ $hasPermissions }} --}}
              {{-- @endforeach --}}
            </div>
         
           <!--submit -->
           <div class="col-12 text-right py-2">
               <div class="form-group text-right">
                   <button type="submit" class="btn btn-info">Submit </button>
               </div>
           </div>
   
       </form>
    </div>
   </div>
   
@endsection
