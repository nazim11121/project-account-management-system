@extends('layouts/contentNavbarLayout')

<!-- @section('title', 'Tables - Basic Tables') -->

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account / Category / </span> Tables
  <a href="{{ route('account-category-create') }}" class="btn btn-primary text-white" style="margin-left: 90%">Create</a>
</h4>

<!-- Hoverable Table rows -->
<div class="card">
  <!-- <h5 class="card-header">Hoverable rows</h5> -->
  <div class="table text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Sl</th>
          <th>Name</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        
        <?php foreach ($category as $key => $value): ?>
          <tr>  
        		<td>{{ ++$key }}</td>
        		<td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $value->name }}</strong></td>
            @if($value->status ==1)
        		  <td><span class="badge bg-label-primary me-1">Active</span></td>
            @else
              <td><span class="badge bg-label-primary me-1">Inactive</span></td>  
            @endif
        		<td>
        		  <div class="dropdown">
        		    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
        		    <div class="dropdown-menu">
        		      <a class="dropdown-item" href="{{ route('account-category-edit',$value->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
        		      <form action="{{ route('account-category-destroy', $value->id)}}" method="post">
        		        @csrf
        		        @method('DELETE')
        		        <button class="btn bx bx-trash me-1" type="submit">Delete</button>
        		       </form>
        		      
        		    </div>
        		  </div>
        		</td>
          </tr>  
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

@endsection
