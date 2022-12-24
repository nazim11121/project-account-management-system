@extends('layouts/contentNavbarLayout')

<!-- @section('title', 'Account settings - Account') -->

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Vendor /</span> Create
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Vendor Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('vendor-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Vendor Name</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" id="name" name="name" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="company_name" class="form-label">Company Name</label>
              <input type="text" class="form-control" id="company_name" name="company_name" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="contact_person_name" class="form-label">Contact Person Name</label><span class="requiredStar" style="color: red"> * </span>
              <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="designation" class="form-label">Contact Person Designation</label>
              <input type="text" class="form-control" id="designation" name="designation" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="mobile" class="form-label">Mobile</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" name="mobile" id="mobile" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="website" class="form-label">Website</label>
              <input type="text" class="form-control" id="website" name="website" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <textarea type="text" class="form-control" id="address" name="address"></textarea>
            </div>
            <div class="mb-3 col-md-6">
              <label for="details" class="form-label">Details</label>
              <textarea type="text" class="form-control" id="details" name="details" /></textarea>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <button type="reset" class="btn btn-outline-secondary" onclick="window.location='{{ route('vendor-list') }}'">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
