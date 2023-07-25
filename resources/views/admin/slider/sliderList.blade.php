@extends('admin.masterPage')
@section('content')
       @if(session('success'))
            <div class="alert alert-success">
                  {{ session('success') }}
            </div> 
       @endif
<div class="card-header">
    <div class="row">
     <div class="col-10">
      <h4>Slider {{ $title ?? "" }}</h4>
     </div>
     <div class="col-2">
      <a class="btn btn-primary" href="{{ route('admin.slider.create') }}" role="button" style="background-color: #01a9ac; border-color:#01a9ac">Create new</a>
     </div>
    </div>
</div>
<br>
<div class="table-responsive text-nowrap">
<table class="table table-striped table-bordered table-lg table-hover">
    <thead class="table text-white" style="background-color: #0ac282">
      <tr class="text-center">
        <th>#</th>
        <th>Title</th>
        <th >Description</th>
        <th >Image</th>
        <th >Status</th>
        <th >Created by</th>
        <th >Updated by</th>
        <th >Create Date</th>
        <th >Updated Date</th>
        {{-- @if($title == "Deleted List")
        <th>Deleted Date</th>
        @endif --}}
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @forelse ($sliders as $slider )
      <tr class="text-center">
        <th>{{ $i++ }}</th>
        <td>{{ $slider->title }}</td>
        <td>{{ $slider->description }}</td>
        <td ><img src="{{ asset('storage/'.$slider->image) }}" height="100px" width="200px"></td>
        @if ($slider->status_id == 1)
        <td><button class="btn btn-success">Active</button></td>
        @else
        <td><button class="btn btn-warning">Inactive</button></td> 
        @endif
        {{-- @if($title == "Deleted List")
        <td>{{ $sliders->deleted_at }}</td>
        <td class="d-flex gap-2 mt-4">
          <a href="{{route('admin.sliders.restore', $sliders->id )}}" class="btn btn-sm btn-danger" title="Restore" > <span class="fas fa-redo fa-lg"></span>Restore</a> 
          <a href="{{route('admin.sliders.pdelete', $sliders->id )}}" class="btn btn-sm btn-danger" title="Permanent Delete" > <span class="fa fa-trash fa-lg"></span>Permanent Delete</a> 
        </td>
        @else--}}
        <td>{{ $slider->createdBy->name ?? "" }}</td>
        <td>{{ $slider->updatedBy->name ?? ""}}</td>
        <td>{{ $slider->created_at }}</td>
        <td>{{ $slider->updated_at }}</td>
        <td class="d-flex gap-2 mt-4">
          <a href="{{route('admin.slider.edit', $slider->id )}}" class="btn btn-sm btn-info" title="Edit" > <span class="fa fa-edit fa-lg"></span>Edit </a> 
          <a href="{{route('admin.slider.delete', $slider->id )}}" class="btn btn-sm btn-danger" title="Delete" > <span class="fa fa-trash fa-lg"></span> Delete</a> 
          
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


@endsection