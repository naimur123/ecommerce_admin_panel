@extends('admin.masterPage')
@section('content')
<div class="page-body">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h5>{{ ucfirst($pageTitle) }}</h5>
                </div>
                @if(auth()->user()->can('Product create'))
                <div class="col-md-2">
                    
                   <a class="btn btn-primary" href="{{ route('admin.products.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
                    
                </div>
                @endif
            </div>
        </div>
      <div class="card-body">
            <div class="dt-plugin-buttons"></div>
                <div class="dt-responsive table-responsive">
                    <table id="table" class="table table-striped table-bordered nowrap">
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
            ordering: false,
            ajax: '{{ isset($dataTableUrl) && !empty($dataTableUrl) ? $dataTableUrl : URL::current() }}',
            columns: [
                @foreach($dataTableColumns as $column)
                    { data: '{{ $column }}', name: '{{ $column }}' },
                @endforeach
            ],
            "language": {
                "lengthMenu": "_MENU_"
            },
        });

        $('#table').on('click', '.approve-product', function() {
            var status = 1;
            var productId = $(this).data('product-id');
            $.ajax({
                url: '{{ route('admin.products.approve') }}?product_id=' + productId + '&status_id=' + status,
                type: 'get',
                success: function (res) {
                    Swal.fire({
                        title: 'Approved!',
                        text: 'Product Approved!',
                        icon: 'success',
                        onClose: function () {
                            window.location.reload();
                        }
                    });
                   
                }
            });
        });
    });


</script>

@endsection