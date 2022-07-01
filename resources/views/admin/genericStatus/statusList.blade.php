@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>Status List</h4>
     </div>
     <div class="col-2">
      <a class="btn btn-primary" href="{{ route('admin.status.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
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
        <th >Created by</th>
        <th >Updated by</th>
        <th >Create Date</th>
        <th >Updated Date</th>
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @foreach ($statuses as $status)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $status->name }}</td>
        <td>{{ $status->short_name }}</td>
        <td>{{ $status->createdBy->name ?? "" }}</td>
        <td>{{ $status->updatedBy->name ?? ""}}</td>
        <td>{{ $status->created_at }}</td>
        <td>{{ $status->updated_at }}</td>
        <td class="d-flex gap-2">
          <a href="{{route('admin.status.edit', $status->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span> </a> 
          <a href="{{route('admin.status.delete', $status->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> </a> 
          
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>


@endsection