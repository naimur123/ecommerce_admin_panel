@extends('admin.masterPage')
@section('content')
<div class="col-10 col-lg-10 mt-2 mb-2">
<div class="card">
 <div class="card-body">
    <form class="row form-horizontal" action="{{ $form_url }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 mt-10">
            <h3>Coupon {{ $title ?? "" }}</h3>
            <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
            <hr/>
        </div>

        <!-- Coupon Name -->
        <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>Code<span class="text-danger">*</span></label>
                <input type="text" class="form-control " value="{{ old("name") ?? ($data->name ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="name" required >
                @error('name')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!-- Coupon Value -->
        <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>Value <span class="text-danger">*</span></label>
                <input type="number" step="any" min="0" class="form-control " value="{{ old("value") ?? ($data->value ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="value" placeholder="0" required >
                @error('number')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!-- Start date  -->
        <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>Start Date<span class="text-danger">*</span></label>                                
                <input type="date" name="start_date" class="form-control"  value="{{ isset($data->start_time) ? Carbon\Carbon::parse($data->start_time)->format('Y-m-d') : date('Y-m-d') }}" required >
            </div>                        
        </div>

        <!-- Start time  -->
        <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>Start Time<span class="text-danger">*</span></label>                                
                <input type="time" name="start_time" class="form-control"  value="{{ isset($data->start_time) ? Carbon\Carbon::parse($data->start_time)->format('h:i') : now()->format('H:i') }}"  required >
            </div>                        
        </div>   

        <!-- End date  -->
        <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>End Date<span class="text-danger">*</span></label>                                
                <input type="date" name="end_date" class="form-control"  value="{{ isset($data->start_time) ? Carbon\Carbon::parse($data->start_time)->format('Y-m-d') : date('Y-m-d') }}" required >
            </div>                        
        </div>

        <!-- End time  -->
        <div class="col-6 col-sm-3 my-2">
            <div class="form-group">
                <label>End Time<span class="text-danger">*</span></label>                                
                <input type="time" name="end_time" class="form-control"  value="{{ isset($data->start_time) ? Carbon\Carbon::parse($data->start_time)->format('h:i') : now()->format('H:i') }}"  required >
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