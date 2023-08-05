<script>
    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}")
    @endif
</script>
{{-- @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div> 
@endif --}}
<script>
     @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
     @endif
</script>
