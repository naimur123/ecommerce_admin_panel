@extends('admin.masterPage')
@section('content')
<style>
    table.table-bordered > thead > tr > th{
      height: 5px !important;
    }
    table.table-bordered > tbody > tr > td{
       border: 0.2px solid rgba(112, 108, 108, 0.2);
       height: 5px !important;
    }
</style>
<div class="page-body">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h5>{{ ucfirst($pageTitle) }}</h5>
                </div>
                {{-- @if(auth()->user()->can('Product create'))
                <div class="col-md-2">
                    
                   <a class="btn btn-primary" href="{{ route('admin.products.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
                    
                </div>
                @endif --}}
            </div>
        </div>
      <div class="card-body">
            <div class="dt-plugin-buttons"></div>
                <div class="dt-responsive table-responsive">
                    <table id="table" class="table table-bordered nowrap">
                        <thead class="{{ isset($tableStyleClass) ? $tableStyleClass : ''}}" style="background-color: #7bb882;">
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
            // "rowCallback": function(row, data) {
            //     var status = data.status;
            //     switch (status) {
            //         case 'Pending':
            //             $(row).css("background-color", "#ffeecc");
            //             break;
            //         case 'Processing':
            //             $(row).css("background-color", "#ccffff");
            //             break;
            //         case 'Cancelled':
            //             $(row).css("background-color", "#ffcccc");
            //             break;
            //         default:
            //             break;
            //     }
            // },
           

        });
    });
</script>

@endsection