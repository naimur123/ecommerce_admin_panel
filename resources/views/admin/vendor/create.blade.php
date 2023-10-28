@extends('admin.masterPage')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-12 mt-2 mb-2">
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
    
                    <!-- Vendor Name -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Vendor Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("name") ?? ($data->name ?? "")}} " name="name">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
    
                    <!-- Email-->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ old("email") ?? ($data->email ?? "")}}" name="email" >
                            @error('email')
                              <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
    
                    <!-- Phone -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone"  value="{{ old("phone") ?? ($data->phone ?? "")}}" required >
                            @error('phone')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Password -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" minlength="3" name="password" value="{{ !isset($data->id) ? Str::random(6) : old("password") }}"  autocomplete="off" {{ isset($data->id) ? null : 'required'}}>
                            @if ($errors->has('password'))
                                <span class="text-danger" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
    
                
                    <!--Picture -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <label><b>Picture</b></label><br>
                        <input type="file" name="picture" value="{{ old("picture") ?? ($data->picture ?? "") }}">
                        <div class="my-2">
                        @error('picture')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="col-12 my-2">
                        <div class="form-group">
                            <label>Vendor Details</label>
                            <textarea class="summernote" id="summernote1" name="details" value="{{ old("details") ?? ($data->details ?? "")  }}"></textarea>
                            @error('details')
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