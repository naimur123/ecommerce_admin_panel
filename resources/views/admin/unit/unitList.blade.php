@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>Unit List</h4>
     </div>
     <div class="col-2">
      <a class="btn btn-primary" href="{{ route('admin.unit.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div>
    </div>
</div>
<br>
<div class="table-responsive text-nowrap">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center">
        <th scope="col">#</th>
        <th>Name </th>
        <th>Short Name </th>
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
    @forelse ($units as $unit)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $unit->name }}</td>
        <td>{{ $unit->short_name }}</td>
        <td>{{ $unit->remarks }}</td>
        @if ($unit->status_id == 1)
        <td><button class="btn btn-success">Active</button></td>
        @else
        <td><button class="btn btn-warning">Inactive</button></td> 
        @endif
        <td>{{ $unit->createdBy->name ?? "" }}</td>
        <td>{{ $unit->updatedBy->name ?? ""}}</td>
        <td>{{ $unit->created_at }}</td>
        <td>{{ $unit->updated_at }}</td>
        <td class="d-flex gap-2">
          <a href="{{route('admin.unit.edit', $unit->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span> </a> 
          <a href="{{route('admin.unit.delete', $unit->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> </a> 
          
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