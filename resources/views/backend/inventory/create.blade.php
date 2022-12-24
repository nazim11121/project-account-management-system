@extends('layouts/contentNavbarLayout')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Project /</span> Create
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Project Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('project-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Project Name</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" id="name" name="name" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="client_name">Client Name</label><span class="requiredStar" style="color: red"> * </span>
              <select name="client_name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($client as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="assign_date" class="form-label">Start Date</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="date" id="assign_date" name="assign_date" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="submission_date" class="form-label">Handover Date</label><span class="requiredStar" style="color: red"> * </span>
              <input type="date" class="form-control" id="submission_date" name="submission_date" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="total_cost">Estimate Cost</label>
              <input type="number" class="form-control" id="total_cost" name="total_cost" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="total_price">Project Value(Price)</label><span class="requiredStar" style="color: red"> * </span>
              <input type="number" class="form-control" id="total_price" name="total_price" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <textarea type="text" class="form-control" id="address" name="address"></textarea> 
            </div>
            <div class="mb-3 col-md-6">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" type="text" name="description" id="description"></textarea>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Status</label>
              <select name="status" class="form-control custom-select">
                  <option value="">Select One..</option>
                  <option value="running">Running</option>
                  <option value="stop">Stop</option>
                  <option value="complete">Complete</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="file">Upload File</label>
              <input type="file" class="form-control" id="file" name="file" />
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <button type="reset" class="btn btn-outline-secondary" onclick="window.location='{{ route('project-list') }}'">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
