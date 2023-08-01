@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>Admin List</h4>
     </div>
     <div class="col-2">
      {{-- <a class="btn btn-primary" href="{{ route('admin.brand.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a> --}}
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
        <th>Email</th>
        <th >Phone</th>
        <th >Address</th>
        <th >Bio</th>
        <th >Image</th>
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @forelse ($admins as $admin)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $admin->name }}</td>
        <td>{{ $admin->email ?? "N/A" }}</td>
        <td>{{ $admin->phone ?? "N/A"}}</td>
        <td>{{ $admin->address ?? "N/A"}}</td>
        <td>{{ $admin->bio ?? "N/A" }}</td>
        <td><img src="{{ asset('storage/'.$admin->image) }}" height="100px" width="100px"></td>
        <td class="d-flex gap-2 ml-2 mt-4">
          <a href="{{ route('admin.admin.edit', $admin->id ) }}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span> </a> 
          <a href="" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> </a> 
          <a href="{{ route('admin.permisssion', $admin->id ) }}" class="btn btn-sm btn-danger" title="Permission" > <span class="fa fa-key fa-lg"></span> </a> 
          
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