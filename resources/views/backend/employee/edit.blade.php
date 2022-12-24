@extends('layouts/contentNavbarLayout')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Employee /</span> Edit
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Employee Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('employee-update', $employee->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="client_name" class="form-label">Name</label><span class="requiredStar" style="color: red"> * </span>
              <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="mobile" class="form-label">Mobile</label><span class="requiredStar" style="color: red"> * </span>
              <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $employee->mobile }}" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="dept" class="form-label">Department</label>
              <input type="text" class="form-control" id="dept" name="dept" value="{{ $employee->dept }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="position" class="form-label">Position</label>
              <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <textarea type="text" class="form-control" id="address" name="address" value="{{ $employee->address }}">{{ $employee->address }}</textarea>
            </div>
            <div class="mb-3 col-md-6">
              <label for="description" class="form-label">Description</label>
              <textarea type="text" class="form-control" id="description" name="description" value="{{ $employee->description }}">{{ $employee->description }}</textarea>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button type="reset" class="btn btn-outline-secondary" onclick="window.location='{{ route('employee-list') }}'">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
