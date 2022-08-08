@extends('admin.masterPage')
@section('content')
<div class="col-10 col-lg-10 mt-2 mb-2">
<div class="card">
 <div class="card-body">
    <form class="row form-horizontal" action="{{ $form_url }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 mt-10">
            <h3>Generic Status {{ $title ?? "" }}</h3>
            <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
            <hr/>
        </div>

        <!-- Status Name -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control " value="{{ old("name") ?? ($data->name ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="name" required >
                @error('name')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

         <!-- Status Short Name -->
         <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Short Name</label>
                <input type="text" class="form-control {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" value="{{ old("short_name") ?? ($data->short_name ?? "")}}" name="short_name" >
                @error('slug')
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