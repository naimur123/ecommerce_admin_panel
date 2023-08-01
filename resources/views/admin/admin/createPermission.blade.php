@extends('admin.masterPage')
@section('content')
<div class="row row justify-content-center">
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
             <div class="col-12 mt-10">
                 <h3>{{ $title ?? "" }}</h3>
                 <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
                 <hr/>
             </div>
     
             <!--Name -->
             <div class="col-12 col-sm-6 col-md-4 my-2">
                 <div class="form-group">
                     <label>Name <span class="text-danger">*</span></label>
                     <input type="text" class="form-control " value="{{ old("name") ?? ($data->name ?? "")}} " name="name">
                     @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                     @enderror
                 </div>
             </div>
     
             <!-- Group Name -->
             <div class="col-12 col-sm-6 col-md-4 my-2">
                 <div class="form-group">
                     <label>Group Name <span class="text-danger">*</span></label>
                     <input type="text" class="form-control " value="{{ old("group_name") ?? ($data->group_name ?? "")}} " name="group_name">
                     @error('phone')
                            <strong class="text-danger">{{ $message }}</strong>
                     @enderror
                 </div>
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
    </div>
</div>

@endsection