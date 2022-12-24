@extends('layouts/contentNavbarLayout')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Product Inventory /</span> Create
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Product Inventory Details</h5>
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('product-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Item Name</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" id="name" name="name" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Unit</label>
              <input class="form-control" type="text" id="unit" name="unit" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Unit Price</label>
              <input type="number" class="form-control" id="unit_price" name="unit_price" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="stock" class="form-label">Stock</label><span class="requiredStar" style="color: red"> * </span>
              <input type="number" class="form-control" id="stock" name="stock" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastName" class="form-label">Description</label>
              <textarea class="form-control" type="text" name="description" id="description"></textarea>
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Upload Image/File</label>
              <input type="file" class="form-control" id="file" name="file" />
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <button type="reset" class="btn btn-outline-secondary" onclick="window.location='{{ route('product-list') }}'">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
