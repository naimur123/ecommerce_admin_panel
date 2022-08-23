@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>Subcategory List</h4>
     </div>
     <div class="col-2">
      <a class="btn btn-primary" href="{{ route('admin.subcategory.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div>
    </div>
</div>
<br>
<div class="table-responsive text-nowrap">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center">
        <th scope="col">#</th>
        {{-- <th>ID </th> --}}
        <th>Name </th>
        <th>Category Name</th>
        <th >Details</th>
        <th >Remarks</th>
        <th >Status</th>
        <th >Created by</th>
        <th >Updated by</th>
        <th >Create Date</th>
        <th >Updated Date</th>
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @forelse ($subcategories as $subcategory)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $subcategory->name }}</td>
        <td >{{ $subcategory->categories->name ?? "N/A" }}</td>
        <td>{{ $subcategory->details }}</td>
        <td>{{ $subcategory->remarks }}</td>
        @if ($subcategory->status_id == 1)
        <td><button class="btn btn-success">Active</button></td>
        @else
        <td><button class="btn btn-warning">Inactive</button></td> 
        @endif
        <td>{{ $subcategory->createdBy->name ?? "" }}</td>
        <td>{{ $subcategory->updatedBy->name ?? ""}}</td>
        <td>{{ $subcategory->created_at }}</td>
        <td>{{ $subcategory->updated_at }}</td>
        <td class="d-flex gap-2">
          @if(auth()->user()->can('Subcategory edit'))
          <a href="{{route('admin.subcategory.edit', $subcategory->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span> </a> 
          @endif
          @if(auth()->user()->can('Subcategory delete'))
          <a href="{{route('admin.subcategory.delete', $subcategory->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> </a> 
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