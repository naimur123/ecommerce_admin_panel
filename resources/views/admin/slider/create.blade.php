@extends('admin.masterPage')
@section('content')
<div class="col-10 col-lg-10 mt-2 mb-2">
<div class="card">
 <div class="card-body">
    <form class="row form-horizontal" action="{{ $form_url }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 mt-10">
            <h3>Slider {{ $title ?? "" }}</h3>
            <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
            <hr/>
        </div>

        <!-- Slider Title -->
        <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>Title<span class="text-danger">*</span></label>
                <input type="text" class="form-control " value="{{ old("title") ?? ($data->title ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="title" required >
                @error('title')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

         <!--Slider Description -->
         <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" value="{{ old("description") ?? ($data->description ?? "")}}" name="description" >
                @error('description')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

       
         <!--Image-->
         <div class="col-6 col-sm-3 my-2">
            <label><b>Image One</b></label><br>
            <input type="file" name="image" value="{{ old("image") ?? ($data->image ?? "") }}">
            <div class="my-2">
            @error('image')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            </div>
         </div>
          
         &nbsp; &nbsp;
          <!-- Remarks -->
          <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>Remarks</label>
                <input type="text" class="form-control {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" value="{{ old("remarks") ?? ($data->remarks ?? "")}}" name="remarks" >
                @error('remarks')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
          </div>

         <!--Set Status -->
         <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>Status<span class="text-danger">*</span></label>
                <select class="form-control select2" name="status_id" required >
                    <option value="">Select Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}"  {{ old('status_id') && old('status_id') == $status->id ? 'selected' : (isset($data->status_id) && $data->status_id == $status->id ? "selected" : Null) }}> {{ $status->name }} </option>     
                    @endforeach                           
                </select>
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