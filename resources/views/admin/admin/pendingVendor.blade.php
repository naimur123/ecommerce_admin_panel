@extends('admin.masterPage')
@section('content')

<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>{{ $title ?? '' }}</h4>
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
        <th >Details</th>
        <th >Image</th>
        <th >Status</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @forelse ($vendors as $vendor)
      <input type="hidden" id="vendor_id" value="{{ $vendor->id }}">
      <tr class="text-center">
        <th scope="row">{{ $i++ }}</th>
        <td>{{ $vendor->name }}</td>
        <td>{{ $vendor->email ?? "N/A" }}</td>
        <td>{{ $vendor->phone ?? "N/A"}}</td>
        <td>{!! $vendor->details ?? "" !!}</td>
        <td><img src="{{ asset('storage/'.$vendor->picture) }}" height="100px" width="100px"></td>
        <td class="d-flex gap-2 ml-2 mt-4">
           <button id="approve" class="btn btn-warning btn-sm">Approve</button>
           <button id="cancel" class="btn btn-danger btn-sm">Cancel</button>
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
<script>
    $(document).ready(function(){
        $("#approve").click(function(){
            var status = 1;
            var vendor_id = $("#vendor_id").val();
            $.ajax({
                url: '{{ route('admin.statusupdate.vendor') }}?vendor_id=' + vendor_id + '&status_id=' + status,
                type: 'get',
                success: function (res) {
                    Swal.fire({
                        title: 'Approved!',
                        text: 'Vendor Approved!',
                        icon: 'success',
                        onClose: function () {
                            // This function will be called when the user clicks the "OK" button
                            // You can remove the success message from the DOM or take any other action here
                            window.location.reload();
                        }
                    });
                   
                }
            });
        })
    })
</script>

@endsection