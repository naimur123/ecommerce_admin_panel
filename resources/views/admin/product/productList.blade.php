@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-8">
      <h4>Product {{ $title ?? "" }}</h4>
     </div>
     @if(auth()->user()->can('Product create'))
     <div class="col-4">
      <a class="btn btn-primary" href="{{ route('admin.products.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div>
     @endif
    </div>
    <div class="row mt-2">
      <div class="col-8">
        <form class="row dt-responsive table-responsive">
          <div class="col-sm-6 col-md-4">
              <div class="input-group mb-3">
                {{-- @csrf --}}
                  <input type="text" name="search" class="form-control" value="{{ request()->input('search') }}" placeholder="Search here" >
                  <div class="input-group-append mb-2">
                      <button type="submit" class="btn btn-info btn-sm">Search</button>
                  </div>
              </div>
          </div>
      </form>
      </div>
    </div>
</div>

<br>
<div class="table-responsive text-nowrap">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center" colspan="12">
        <th>#</th>
        {{-- <th>ID </th> --}}
        <th>Name </th>
        <th >Category Name</th>
        <th >Subcategory Name</th>
        <th >Brand Name</th>
        <th >Code </th>
        <th >Quantity</th>
        <th >Price</th>
        <th >Discount Price</th>
        <th >Discount Percentage</th>
        <th >Status</th>
        <th >Image</th>
        @if($title == "Deleted List")
        <th>Deleted Date</th>
        @endif
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @forelse($product as $products )
      <tr class="text-center">
        <th>{{ $i++ }}</th>
        <td>{{ $products->name }}</td>
        <td>{{ $products->categories->name ?? "N/A" }}</td>
        <td>{{ $products->subcategory->name ?? "N/A" }}</td>
        <td>{{ $products->brands->name ?? "N/A" }}</td>
        <td>{{ $products->code }}</td>
        <td>{{ $products->quantity }}</td>
        <td>{{ $products->price }}</td>
        <td>{{ $products->discount_price ?? "N/A" }}</td>
        <td>{{ $products->discount_percentage ?? "N/A" }}</td>
        @if ($products->status_id == 1)
        <td><button class="btn btn-success">Active</button></td>
        @else
        <td><button class="btn btn-warning">Inactive</button></td> 
        @endif
        
        <td><img src="{{ asset($products->image_one) }}" height="100px" width="100px"></td>
        @if($title == "Deleted List")
        <td>{{ $products->deleted_at }}</td>
        <td class="d-flex gap-2 mt-4">
          <a href="{{route('admin.products.restore', $products->id )}}" class="btn btn-sm btn-danger" title="Restore" > <span class="fas fa-redo fa-lg"></span>Restore</a> 
          <a href="{{route('admin.products.pdelete', $products->id )}}" class="btn btn-sm btn-danger" title="Permanent Delete" > <span class="fa fa-trash fa-lg"></span>Permanent Delete</a> 
        </td>
        @else
        <td class="d-flex gap-2 mt-4">
          @if(auth()->user()->can('Product edit'))
          <a href="{{route('admin.products.edit', $products->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span>Edit </a> 
          @endif
          @if(auth()->user()->can('Product delete'))
          <a href="{{route('admin.products.delete', $products->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> Delete</a> 
          @endif
        </td>
        @endif
      </tr>
      @empty
      <tr>
        <td colspan="12" style="text-align:center"><h3>No data found</h3></td>
      </tr> 
    @endforelse
    </tbody>
  </table>
   {{-- Pagination --}}
   @if($title == "List")
   <div class="d-flex justify-content-center">
    {!! $product->links() !!}
   </div>
   @else
   
   @endif
</div>

{{-- <script type="text/javascript">
      $('#search').on('keyup',function(){
          $value= $(this).val();
          console.log($value);
          $.ajax({
            url: '{{ URL::to('admin/products/search') }}',
            type: "get",
            data: {
                'search': $value
            },
          success:function(data){
              $('tbody').html(data);
          }
    });
  });

</script>

<script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script> --}}


@endsection