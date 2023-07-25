@extends('admin.masterPage')
@section('content')

<div class="card-header">
    @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div> 
    @endif
    <div class="row">
     <div class="col-8">
      <h4>Customer {{ $title ?? "" }}</h4>
     </div>
     {{-- @if(auth()->user()->can('Customer create')) --}}
     {{-- <div class="col-4">
      <a class="btn btn-primary" href="" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div> --}}
     {{-- @endif --}}
     <div class="col-4">
      <a class="btn btn-primary" href="{{ route('admin.customer.excel') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Download</a>
     </div>
    </div>
    <div class="row mt-2">
      <div class="col-8">
        <form class="row dt-responsive table-responsive">
          <div class="col-sm-6 col-md-4">
              <div class="input-group mb-3">
                {{-- @csrf --}}
                  <input type="text" name="search" class="form-control" value="{{ request()->input('search') }}" placeholder="Search here" >
                  <div class="input-group-append mb-2">
                      <button type="submit" class="btn btn-info btn-sm">Search</button>
                  </div>
              </div>
          </div>
      </form>
      </div>
    </div>
</div>

<br>
<div class="table-responsive text-nowrap">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center" colspan="12">
        <th>#</th>
        {{-- <th>ID </th> --}}
        <th>Name</th>
        <th> Email</th>
        <th> Phone</th>
        <th > Email verified at</th>
        <th > Social id</th>
        <th > Picture</th>
        @if($title == "Deleted List")
        <th>Deleted Date</th>
        @endif
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @forelse($users as $user )
      <tr class="text-center">
        <th>{{ $i++ }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email ?? "N/A" }}</td>
        <td>{{ $user->phone ?? "N/A" }}</td>
        <td>{{ $user->email_verified_at ?? "N/A" }}</td>
        <td>{{ $user->social_id ?? "N/A" }}</td>
        
        <td><img src="{{ asset('storage/'.$user->picture) }}" height="100px" width="100px"></td>
        @if($title == "Deleted List")
            <td>{{ $user->deleted_at }}</td>
            <td class="d-flex gap-2 mt-4">
            <a href="{{route('admin.customer.restore', $user->id )}}" class="btn btn-sm btn-danger" title="Restore" > <span class="fas fa-redo fa-lg"></span>Restore</a> 
            <a href="{{route('admin.customer.pdelete', $user->id )}}" class="btn btn-sm btn-danger" title="Permanent Delete" > <span class="fa fa-trash fa-lg"></span>Permanent Delete</a> 
            </td>
        @else
            <td class="d-flex gap-2 mt-4">
            @if(auth()->user()->can('Customer edit'))
            <a href="{{route('admin.customer.edit', $user->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span>Edit </a>
            @endif
            @if(auth()->user()->can('Customer delete')) 
            <a href="{{route('admin.customer.delete', $user->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> Delete</a> 
            @endif
            </td>
        @endif
      </tr>
      @empty
        <tr>
            <td colspan="12" style="text-align:center"><h3>No data found</h3></td>
        </tr> 
    @endforelse
    </tbody>
  </table>
   {{-- Pagination --}}
   @if($title == "List")
    <div class="d-flex justify-content-center">
        {!! $users->links() !!}
    </div>
   @else
   
   @endif
</div>

@endsection