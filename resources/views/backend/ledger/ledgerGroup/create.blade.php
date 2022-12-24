@extends('layouts/contentNavbarLayout')

@section('title', 'Account - Category')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account /</span> Ledger Type
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Ledger Group Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('ledger-ledgerGroup-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="group_name" class="form-label">Type Name</label>
              <input class="form-control" type="text" id="group_name" name="group_name" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Code</label>
              <input class="form-control" type="text" id="code" name="code" />
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
