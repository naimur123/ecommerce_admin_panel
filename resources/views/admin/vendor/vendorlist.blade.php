@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>{{ $title }}</h4>
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
        <th >Details</th>
        <th >Image</th>
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @forelse ($vendors as $vendor)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $vendor->name }}</td>
        <td>{{ $vendor->email ?? "N/A" }}</td>
        <td>{{ $vendor->phone ?? "N/A"}}</td>
        <td>{!! $vendor->details !!}</td>
        <td><img src="{{ asset('storage/'.$vendor->picture) }}" height="100px" width="100px"></td>
        <td class="d-flex gap-2 ml-2 mt-4">
          <a href="{{ route('admin.vendor.permisssion', $vendor->id ) }}" class="btn btn-sm btn-danger" title="Permission" > <span class="fa fa-key fa-lg"></span> </a> 
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