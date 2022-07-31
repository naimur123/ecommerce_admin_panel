@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-8">
      <h4>Product {{ $title ?? "" }}</h4>
     </div>
     <div class="col-4">
      <a class="btn btn-primary" href="{{ route('admin.products.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div>
    </div>
</div>
<br>
<div class="table-responsive text-nowrap" style="overflow: scoll">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center">
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
    @foreach ($product as $products )
      <tr class="text-center">
        <th>{{ $i++ }}</th>
        <td>{{ $products->name }}</td>
        <td>{{ $products->categories->name ?? "N/A" }}</td>
        <td>{{ $products->subcategory->name ?? "N/A" }}</td>
        <td>{{ $products->brands->name ?? "N/A" }}</td>
        <td>{{ $products->code }}</td>
        <td>{{ $products->quantity }}</td>
        <td>{{ $products->price }}</td>
        <td>{{ $products->discount_price }}</td>
        <td>{{ $products->discount_percentage }}</td>
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
          <a href="{{route('admin.products.edit', $products->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span>Edit </a> 
          <a href="{{route('admin.products.delete', $products->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> Delete</a> 
          
        </td>
        @endif
      </tr>
    @endforeach
    </tbody>
  </table>
</div>


@endsection