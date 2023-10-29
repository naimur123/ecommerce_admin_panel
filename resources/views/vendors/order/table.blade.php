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
</script>

@endsection