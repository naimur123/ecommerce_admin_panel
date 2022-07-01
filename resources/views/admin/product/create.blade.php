@extends('admin.masterPage')
@section('content')
<div class="col-12 col-lg-12 mt-2 mb-2">
<div class="card">
 <div class="card-body">
    <form class="row form-horizontal" action="{{ $form_url }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 mt-10">
            <h3>Product {{ $title ?? "" }}</h3>
            <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
            <hr/>
        </div>
         <!-- Category -->
         <div class="col-12 col-sm-6 col-md-4">
            <div class="form-group">
                <label>Category<span class="text-danger">*</span></label>
                <select class="form-control select2" name="category_id" required >
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                       {{-- <optionvalue="$category->id"name="$category->id"ory-"old('profession_id')&&old('profession_id')==$item->id?'selected':(isset($data->profession_id)&&$data->profession_id==$item->id?"selected":Null)> {{ $category->name }} </option>  --}}   
                       <option value="{{ $category->id }}" {{ old('category_id') && old('category_id')== $category->id?'selected':(isset($data->category_id) && $data->category_id == $category->id?"selected":Null) }}>{{ $category->name }}</option>
                    @endforeach                           
                </select>
            </div>
        </div>

        <!-- Sub Category -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="form-group">
                <label>Sub Category<span class="text-danger">*</span></label>
                <select class="form-control select2" name="subcategory_id" required >
                    <option value="">Select Sub Category</option>
                    @foreach($subs as $sub)
                        <option value="{{ $sub->id }}" {{ old('subcategory_id') && old('subcategory_id') == $sub->id?'selected':(isset($data->subcategory_id) && $data->subcategory_id == $sub->id?"selected":Null) }}> {{ $sub->name }} </option>     
                    @endforeach                           
                </select>
            </div>
        </div>

        <!-- Brand -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="form-group">
                <label>Brand<span class="text-danger">*</span></label>
                <select class="form-control select2" name="brand_id" required >
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') && old('brand_id') == $brand->id?'selected':(isset($data->brand_id) && $data->brand_id == $brand->id?"selected":Null) }}> {{ $brand->name }} </option>     
                    @endforeach                           
                </select>
            </div>
        </div>
        <!-- Product Name -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control " value="{{ old("name") ?? ($data->name ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="name" required >
                @error('name')
                       <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

         <!-- Product Slug -->
         <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Product Slug</label>
                <input type="text" class="form-control {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" value="{{ old("slug") ?? ($data->slug ?? "")}}" name="slug" >
                @error('slug')
                <strong class="text-danger">{{ $message }}</strong>
         @enderror
            </div>
        </div>

         <!-- Product Code -->
         @if($title == "Edit")
         <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Product Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="code"  value="{{ old("code") ?? ($data->code ?? "")}}" required readonly >
                @error('code')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>
        @endif
        <!-- Product Quantity -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Product Quantity</label>
                <input type="number" step="any" min="0" name="quantity" class="form-control" value="{{  old("quantity") ?? ($data->quantity ?? "")  }}" >
                @error('quantity')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!-- Units -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Units<span class="text-danger">*</span></label>
                <select class="form-control select2" name="unit_id" required >
                    <option value="">Select Units</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id') && old('unit_id') == $unit->id?'selected':(isset($data->unit_id) && $data->unit_id == $unit->id?"selected":Null) }}> {{ $unit->name }} </option>     
                    @endforeach                           
                </select>
            </div>
        </div>

         <!--Currency -->
         <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Currency<span class="text-danger">*</span></label>
                <select class="form-control select2" name="currency_id" required >
                    <option value="">Select Currency</option>
                    @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}" {{ old('currency_id') && old('currency_id') == $currency->id?'selected':(isset($data->currency_id) && $data->currency_id == $currency->id?"selected":Null) }}> {{ $currency->name }} </option>     
                    @endforeach                           
                </select>
            </div>
        </div>

        <!-- Product Price -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Product Price<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="price" value="{{ old("price") ?? ($data->price ?? "") }}" required >
            </div>
        </div>

        <!-- Discount Price -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Discount Price</label>
                <input type="number" class="form-control" name="discount_price" value="{{ old("discount_price") ?? ($data->discount_price ?? "") }}">
            </div>
        </div>

        <!-- Discount Percentage -->
        <div class="col-12 col-sm-6 col-md-4 my-2">
            <div class="form-group">
                <label>Discount Percentage</label>
                <input type="number" class="form-control" name="discount_percentage" value="{{ old("discount_percentage") ?? ($data->discount_percentage ?? "") }}">
            </div>
        </div>

         <!--Image 1 -->
         @if ($title == "Create")
             &nbsp; &nbsp;
         @endif
         <div class="col-12 col-sm-6 col-md-4 my-2">
            <label><b>Image One</b></label><br>
            <input type="file" name="image_one" value="{{ old("image_one") ?? ($data->image_one ?? "") }}">
            <div class="my-2">
            @error('image_one')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            </div>
         </div>

         <!--Image 2 -->
         <div class="col-12 col-sm-6 col-md-4 my-2">
            <label><b>Image Two</b></label><br>
            <input type="file" name="image_two">
            <div class="my-2">
            @error('image_two')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            </div>
         </div>

         <!--Image 3 -->
         <div class="col-12 col-sm-6 col-md-4 my-2">
            <label><b>Image Three</b></label><br>
            <input type="file" name="image_three">
            <div class="my-2">
            @error('image_three')
            <strong class="text-danger">{{ $message }}</strong>
            @enderror
            </div>
         </div>

        <!-- Short Description -->
        <div class="col-12 my-2">
            <div class="form-group">
                <label>Short Description </label>
                <textarea class="form-control editor" name="short_description" value="{{ old("short_description") ?? ($data->short_description ?? "")  }}"></textarea>
                @error('short_description')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

        <!-- Long Description -->
        <div class="col-12 my-2">
            <div class="form-group">
                <label>Long Description </label>
                <textarea class="form-control editor" name="long_description" value="{{ old("long_description") ?? ($data->long_description ?? "")  }}"></textarea>
                @error('long_description')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
        </div>

         <!--Set Status -->
         <div class="col-12 col-sm-6 col-md-4 my-2">
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