@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>Activity Log List</h4>
     </div>

    </div>
</div>
<br>
<div class="table-responsive text-nowrap">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center">
        <th scope="col">#</th>
        <th>Activity</th>
        <th>MAC</th>
        <th>IP</th>
        <th>Admin Name</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @foreach ($activities as $activity)
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $activity->activity }}</td>
        <td>{{ $activity->mac }}</td>
        <td>{{ $activity->ip }}</td>
        <td>{{ $activity->admin->name ?? "N/A" }}</td>
        <td>{{ $activity->created_at }}</td>
      </tr>
      
    @endforeach
    
  </table>
  {{-- Pagination --}}
  <div class="d-flex justify-content-center">
    {!! $activities->links() !!}
  </div>
</div>


@endsection