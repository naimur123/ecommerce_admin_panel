@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>Coupon List</h4>
     </div>
     <div class="col-2">
      <a class="btn btn-primary" href="{{ route('admin.coupon.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div>
    </div>
</div>
<br>
<div class="table-responsive text-nowrap">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center">
        <th scope="col">#</th>
        <th>Code</th>
        <th>Value</th>
        <th>Start date</th>
        <th>Start Time</th>
        <th>End Date</th>
        <th>End Time</th>
        <th >Status</th>
        <th >Created by</th>
        <th >Updated by</th>
        <th >Create Date</th>
        <th >Updated Date</th>
        {{-- <th >Action</th> --}}
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @foreach ($coupons as $coupon)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $coupon->name }}</td>
        <td>{{ $coupon->value }}</td>
        <td>{{ $coupon->start_date }}</td>
        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s',$coupon->start_time)->format('h:i A') }}</td>
        <td>{{ $coupon->end_date }}</td>
        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s',$coupon->end_time)->format('h:i A') }}</td>
        @if ($coupon->status_id == 1)
        <td><button class="btn btn-success">Active</button></td>
        @else
        <td><button class="btn btn-warning">Inactive</button></td> 
        @endif
        <td>{{ $coupon->createdBy->name ?? "" }}</td>
        <td>{{ $coupon->updatedBy->name ?? ""}}</td>
        <td>{{ $coupon->created_at }}</td>
        <td>{{ $coupon->updated_at }}</td>
        {{-- <td class="d-flex gap-2">
          <a href="{{route('admin.coupon.edit', $coupon->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span> </a> 
          <a href="{{route('admin.coupon.delete', $coupon->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> </a> 
          
        </td> --}}
      </tr>
    @endforeach
    </tbody>
  </table>
</div>


@endsection