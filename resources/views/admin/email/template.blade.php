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
                      <h3>Email {{ $title ?? "" }}</h3>
                      {{-- <input type="hidden" name="id" value="{{ $data->id ?? 0 }}"> --}}
                      <hr/>
                 </div>
              <!-- Subject -->
              <div class="col-12 col-md-6">
                  <div class="form-group">
                      <label>Email Subject<span class="text-danger">*</span> </label>                            
                      <input type="text"  name="subject" value="{{ $data->subject ?? Null }}" class="form-control" required >
                  </div>
              </div>
              <!-- Email Type / Category -->
              <div class="col-12 col-md-6">
                  <div class="form-group">
                      <label>Email Type <span class="text-danger">*</span></label>
                      <select name="type" class="form-control select2" required >
                          <option value="">Select Email Type</option>
                          <option value="smptp">SMTP</option>
                          <option value="mail">Mail</option>
                      </select>
                  </div>
              </div> 
      
              <!-- send_email -->
              <div class="col-12 col-md-6">
                  <div class="form-group">
                      <label>Send Email<span class="text-danger">*</span></label>
                      <select name="send_email" class="form-control" required >
                          <option value="">Select Email Sending Option</option>
                          <option value="1" {{ isset($data->id) && $data->send_email ? 'selected' : Null }}>ON</option>
                          <option value="0" {{ isset($data->id) && !$data->send_email ? 'selected' : Null }} >OFF</option>                           
                      </select>
                  </div>
              </div>
      
      
              <!-- Body -->
              <div class="col-12">
                  <div class="form-group">
                      <label>Email Body </label> 
                      <textarea name="body" class="form-control editor" style="min-height: 100px" >{{ $data->body ?? Null }}</textarea>
                  </div>
              </div>
      
              <!-- Subject -->
              <div class="col-12">
                  <div class="form-group">
                      <label>Email Footer </label>                        
                      <input type="text"  name="footer" value="{{ $data->footer ?? Null }}" class="form-control" >
                  </div>
              </div>
      
              <div class="col-12 text-right py-2">
                  <div class="form-group text-right">
                      <button type="submit" class="btn btn-info">Submit </button>
                  </div>
              </div>
      
             </form>
      
                             
          </div>            
          <!--submit -->
         
        </div>
      </div>
</div>
@endsection