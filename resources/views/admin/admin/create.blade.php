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
        <div class="col-12 mt-10">
            <h3>Admin {{ $title ?? "" }}</h3>
            <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
            <hr/>
        </div>

        <!-- Admin Name -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control " value="{{ old("name") ?? ($data->name ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="name">
                @error('name')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!-- Admin Email -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control " value="{{ old("email") ?? ($data->email ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="email">
                @error('email')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!-- Admin Phone -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control " value="{{ old("phone") ?? ($data->phone ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="phone">
                @error('phone')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

         <!-- Admin Password -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="form-group">
                <label>Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" minlength="3" name="password" value="{{ !isset($data->id) ? Str::random(6) : old("password") }}"  autocomplete="off" {{ isset($data->id) ? null : 'required'}}>
                @error('password')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!--Image -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <label><b>Image</b></label><br>
            <input type="file" name="image" value="{{ old("image") ?? ($data->image ?? "") }}">
            <div class="my-2">
                @error('image')
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
@endsection