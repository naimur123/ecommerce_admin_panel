@extends('admin.masterPage')
@section('content')
<div class="col-10 col-lg-10 mt-2 mb-2">
    <div class="card" style="margin-top:2%; margin-bottom: 2%;">
        <div class="card-header bg-info">
            Website Settings
        </div>
        <div class="card-body">
            <form action="{{ $form_url }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="application_name" class="col-md-4 col-form-label text-md-right">Application Name <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control{{ $errors->has('application_name') ? ' is-invalid' : '' }}" name="application_name" value="{{ isset($system) ? $system->application_name : Null }}" required autofocus>
                        @if ($errors->has('application_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('application_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title_name" class="col-md-4 col-form-label text-md-right">Application Title Name <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control{{ $errors->has('title_name') ? ' is-invalid' : '' }}" name="title_name" value="{{ isset($system) ? $system->title_name : null }}" required >
                        @if ($errors->has('title_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ isset($system) ? $system->phone : Null }}" required >
                        @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right" >Email<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value=" {{ isset($system) ? $system->email : Null }}" required >
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="city" value="{{ isset($system) ? $system->city : Null }}"  >                                
                    </div>
                </div>
                <div class="form-group row">
                    <label for="postal_code" class="col-md-4 col-form-label text-md-right">Postcode</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="postal_code" value="{{ isset($system) ? $system->postal_code : Null }}"  >                                
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address"  value="{{ isset($system) ? $system->address : Null }}" >                                                                                     
                    </div>
                </div>
                <div class="form-group row">
                    <label for="State" class="col-md-4 col-form-label text-md-right">State</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="state"  value="{{ isset($system) ? $system->state : Null }}" >                                                                                     
                    </div>
                </div>
                <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label text-md-right">County <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ isset($system) ? $system->country : Null }}" required >
                        @if ($errors->has('country'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="currency" class="col-md-4 col-form-label text-md-right">Currency <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <select name="currency" class="form-control" required>
                                    <option value="" selected > Select Currency</option>
                                    <option value="BDT" {{ isset($system) && $system->currency == 'TK' ? 'selected' : ''}} >BDT </option>
                                    <option value="USD" {{ isset($system) && $system->currency == 'USD' ? 'selected' : '' }} >USD </option>
                        </select>
                        @if ($errors->has('currency'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('currency') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- Time Zone -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Time Zone <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <select name="time_zone" class="form-control" required>
                            <option value=""  > Select Time Zone</option>
                            <option value="Europe/London" {{isset($system) && $system->time_zone == 'Europe/London' ? 'selected' : ''}} > BST </option>
                            <option value="UTC" {{ isset($system) && $system->time_zone == 'UTC' ? 'selected' : ''}} > UTC </option>
                        </select>
                        @if ($errors->has('time_zone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('time_zone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_format" class="col-md-4 col-form-label text-md-right">Date Format <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <select name="date_format" required class="form-control">
                            <option value="d/m/Y" {{ isset($system) && $system->date_format == 'd/m/Y' ? 'selected' : ''}} > 16/03/2019 (DD/MM/Year) </option>
                            <option value="d-m-Y" {{ isset($system) && $system->date_format == 'd-m-Y' ? 'selected' : ''}} > 16-03-2019 (DD-MM-Year) </option>
                            <option value="Y/m/d" {{ isset($system) && $system->date_format == 'Y/m/d' ? 'selected' : ''}} > 2019/03/16 (Year/MM/DD) </option>
                            <option value="Y-m-d" {{ isset($system) && $system->date_format == 'Y-m-d' ? 'selected' : ''}} > 2019-03-16 (Year-MM-DD) </option>
                            <option value="m/d/Y" {{ isset($system) && $system->date_format == 'm/d/Y' ? 'selected' : ''}} > 03/16/2019 (MM/DD/Year) </option>
                            <option value="m-d-Y" {{ isset($system) && $system->date_format == 'm-d-Y' ? 'selected' : ''}} > 03-16-2019 (MM-DD-Year) </option>
                            <option value="d-M,y" {{ isset($system) && $system->date_format == 'd-M,y' ? 'selected' : ''}} > 16-March,2019 (DD-MM,Year) </option>                                    
                            <option value="d-M,y" {{ isset($system) && $system->date_format == 'd M y' ? 'selected' : ''}} > 16 March 2019 (DD MM Year) </option>                                    
                            <option value="d/m/y" {{ isset($system) && $system->date_format == 'd/m/y' ? 'selected' : ''}} > 16/03/19 (D/M/Y) </option>                                    
                        </select>
                    </div>
                </div>                
                <div class="form-group row">
                    <label for="dateFormat" class="col-md-4 col-form-label text-md-right">Logo</label>
                    <div class="col-md-6">
                        <input type="file" name="logo" accept="image/png,image/jpeg">
                        @if ($errors->has('logo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>Only .jpeg .png, .jpg are allow</strong>
                        </span>
                        @endif
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="dateFormat" class="col-md-4 col-form-label text-md-right">Favicon Logo</label>
                    <div class="col-md-6">
                        <input type="file" name="favicon" accept="image/png,image/jpeg">
                        @if ($errors->has('favicon'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$errors->get('favicon')}}</strong>
                        </span>
                        @endif
                    </div>
                </div> 
                <div class="form-group row">                    
                    <div class="col-md-6 offset-md-4">
                        <button class="btn btn-primary form-control" type="submit">Update</button>
                    </div>                        
                </div>
            </form>
        </div>
    </div>
</div>
@endsection