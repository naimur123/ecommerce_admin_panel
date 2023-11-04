@extends('vendors.masterPage')
@section('content')
<style>
    table.table-bordered > thead > tr > th{
       border: 0.5px solid rgb(211, 207, 207);
    }
    table.table-bordered > tbody > tr > td{
       border: 0.5px solid rgb(211, 207, 207);
       text-align: center;
    }
    .bg-light-blue {
        background-color: rgb(79, 236, 217);
    }
</style>
<div class="page-body">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h5>{{ ucfirst($pageTitle) }}</h5>
                </div>
            </div>
        </div>
      <div class="card-body">
            <div class="dt-plugin-buttons"></div>
                <div class="dt-responsive table-responsive">
                    <table id="table" class="table table-bordered nowrap">
                        <thead class="{{ isset($tableStyleClass) ? $tableStyleClass : 'bg-primary'}}">
                            <tr>
                                @foreach($tableColumns as $column)
                                    <th> @lang('table.'.$column)</th>
                                @endforeach                                
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
    </div>
</div>  


<script type="text/javascript">
    let table;
    $(document).ready(function() {
            table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: '{{ isset($dataTableUrl) && !empty($dataTableUrl) ? $dataTableUrl : URL::current() }}',
            columns: [
                @foreach($dataTableColumns as $column)
                    { data: '{{ $column }}', name: '{{ $column }}' },
                @endforeach
            ],
            "language": {
                "lengthMenu": "_MENU_"
            }

        });
    });
    $('#table').on('click', '.accept-order', function() {
        var status = 'Accepted';
        var OrderId = $(this).data('order-id');
        var productId = $(this).data('product-id');
        var quantity = $(this).data('quantity');
        $.ajax({
                url: '{{ route('vendor.order.updateStatus') }}?product_id=' + productId + '&status=' + status + '&order_id=' + OrderId + '&quantity=' +quantity,
                type: 'get',
                success: function (res) {
                    if (res.message == "Accepted") {
                    Swal.fire({
                        title: res.message,
                        text: "Order Accpeted",
                        icon: 'success',
                        onClose: function () {
                            window.location.reload();
                        }
                    });
                } 
                else{
                    Swal.fire({
                        title: res.message,
                        text: "Product is less than 0",
                        icon: 'error',
                    });
                }
            
            }
        });
    });  
    $('#table').on('click', '.cancel-order', function() {
        var status = 'Cancelled';
        var OrderId = $(this).data('order-id');
        $.ajax({
            url: '{{ route('vendor.order.updateStatus') }}?order_id=' + OrderId + '&status=' + status,
            type: 'get',
            success: function (res) {
                if (res.message == "Cancelled") {
                    Swal.fire({
                        title: res.message,
                        text: 'Order Cancelled',
                        icon: 'success',
                        onClose: function () {
                            window.location.reload();
                        }
                    });
                } 
            }
        });
    });
    $('#table').on('click', 'ship-order', function() {
        var status = 'Shipped';
        var OrderId = $(this).data('order-id');
        $.ajax({
            url: '{{ route('vendor.order.updateStatus') }}?order_id=' + OrderId + '&status=' + status,
            type: 'get',
            success: function (res) {
                console.log(res);
                if (res.message == "Shipped") {
                    Swal.fire({
                        title: res.message,
                        text: 'Order Shipped',
                        icon: 'success',
                        onClose: function () {
                            window.location.reload();
                        }
                    });
                } 
            }
        })
    });
</script>

@endsection