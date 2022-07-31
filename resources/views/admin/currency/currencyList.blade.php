@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-9">
      <h4>Currency List</h4>
     </div>
     <div class="col-3">
      <a class="btn btn-primary" href="{{ route('admin.currency.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
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
        <th>Short name </th>
        <th>Currency country name </th>
        <th>Currency symbol </th>
        <th >Remarks</th>
        <th >Status</th>
        <th >Created by</th>
        <th >Updated by</th>
        <th >Create date</th>
        <th >Updated date</th>
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @foreach ($currencies as $currency)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $currency->name }}</td>
        <td>{{ $currency->short_name }}</td>
        <td>{{ $currency->country->name ?? "N/A" }}</td>
        <td>{{ $currency->currency_symbol }}</td>
        <td>{{ $currency->remarks }}</td>
        @if ($currency->status_id == 1)
        <td><button class="btn btn-success">Active</button></td>
        @else
        <td><button class="btn btn-warning">Inactive</button></td> 
        @endif
        <td>{{ $currency->createdBy->name ?? "" }}</td>
        <td>{{ $currency->updatedBy->name ?? ""}}</td>
        <td>{{ $currency->created_at }}</td>
        <td>{{ $currency->updated_at }}</td>
        <td class="d-flex gap-2">
          <a href="{{route('admin.currency.edit', $currency->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span> </a> 
          <a href="{{route('admin.currency.delete', $currency->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> </a> 
          
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>


@endsection