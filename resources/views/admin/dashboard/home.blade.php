@extends('admin.masterPage')

@section('content')
{{-- <div class="container">
    Success
</div> --}}
<div class="col-xl-3 col-md-3 col-sm-6">
    <div class="card bg-c-green update-card">
        <div class="card-block">
            <div class="row align-items-end">
                <div class="col-8">
                    <h4 class="text-white">{{ 0 }}</h4>
                    <h6 class="text-white m-b-0">Total Advisors</h6>
                </div>
                <div class="col-4 text-right"><iframe class="chartjs-hidden-iframe" style="display: block; overflow: hidden; border: 0px none; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;" tabindex="-1" __idm_frm__="10737418265"></iframe>
                    <canvas id="update-chart-2" height="50" style="display: block; width: 45px; height: 50px;" width="45"></canvas>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href=""> Total Advisors</a>
        </div>
    </div>
</div>

@endsection
