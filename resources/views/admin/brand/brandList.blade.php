@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>Brand List</h4>
     </div>
     @if(auth()->user()->can('Brand create'))
     <div class="col-2">
      <a class="btn btn-primary" href="{{ route('admin.brand.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div>
     @endif
    </div>
</div>
<br>
<div class="table-responsive text-nowrap">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center">
        <th scope="col">#</th>
        <th>Name </th>
        <th>Brand Country </th>
        <th >Remarks</th>
        <th >Status</th>
        <th >Created by</th>
        <th >Updated by</th>
        <th >Create Date</th>
        <th >Updated Date</th>
        <td> Image</td>
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @forelse ($brands as $brand)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $brand->name }}</td>
        <td>{{ $brand->country->name }}</td>
        <td>{{ $brand->remarks }}</td>
        @if ($brand->status_id == 1)
        <td><button class="btn btn-success">Active</button></td>
        @else
        <td><button class="btn btn-warning">Inactive</button></td> 
        @endif
        <td>{{ $brand->createdBy->name ?? "" }}</td>
        <td>{{ $brand->updatedBy->name ?? ""}}</td>
        <td>{{ $brand->created_at }}</td>
        <td>{{ $brand->updated_at }}</td>
        <td><img src="{{ asset($brand->image) }}" height="100px" width="100px"></td>
        <td class="d-flex gap-2 mt-4">
          @if(auth()->user()->can('Brand edit'))
          <a href="{{route('admin.brand.edit', $brand->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span> </a> 
          @endif

          @if(auth()->user()->can('Brand delete'))
          <a href="{{route('admin.brand.delete', $brand->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> </a> 
          @endif

        </td>
      </tr>
      @empty
      <tr>
        <td colspan="12" style="text-align:center"><h3>No data found</h3></td>
      </tr> 
    @endforelse
    </tbody>
  </table>
</div>


@endsection