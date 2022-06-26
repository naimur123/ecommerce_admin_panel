@extends('admin.masterPage')
@section('content')
<div class="card-header">
    <div class="row">
     <div class="col-9">
      <h4>Product List</h4>
     </div>
     <div class="col-3">
      <a class="btn btn-primary" href="{{ route('admin.products.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div>
    </div>
</div>
<br>
<div class="table-responsive text-nowrap">
    <table id="dtHorizontalExample" class="table table-striped table-hover table-bordered table-lg" cellspacing="4"
    width="100%">
    <thead>
      <tr style="background-color: #0ac282">
        <th >Name </th>
        <th >Category Name</th>
        <th >Brand Name</th>
        <th >Subcategory Name</th>
        <th >Code </th>
        <th >Quantity</th>
        <th >Price</th>
        <th >Discount Price</th>
        <th >Discount Percentage</th>
        <th >Status</th>
        <th >Image</th>
        <th >Create Date</th>
        <th >Modified Date</th>
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Tiger</td>
        <td>Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011/04/25</td>
        <td>$320,800</td>
        <td>5421</td>
        <td>t.nixon@datatables.net</td>
      </tr>
      
    </tbody>
  </table>
</div>
{{-- <script>
    $(document).ready(function () {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
});
</script> --}}
{{-- <style>
    .dtHorizontalExampleWrapper {
  max-width: 600px;
  margin: 0 auto;
}
#dtHorizontalExample th, td {
  white-space: nowrap;
}

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
 bottom: .5em;
}
</style> --}}

@endsection