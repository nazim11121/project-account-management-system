@extends('layouts/contentNavbarLayout')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account / Bank-Cash Account/</span> Edit
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Bank/Cash Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('account-bank-cash-update', $bankCash->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Account Name</label><span class="requiredStar" style="color: red"> * </span>
              <input type="text" class="form-control" id="name" name="name" value="{{ $bankCash->name}}" required />
            </div>
            <div class="mb-3 col-md-6">
              <label for="current_balance" class="form-label">Current Balance</label>
              <input type="number" class="form-control" id="current_balance" name="current_balance" value="{{ $bankCash->current_balance}}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="description" class="form-label">Description</label>
              <textarea type="text" class="form-control" id="description" name="description" value="{{ $bankCash->description }}">{{ $bankCash->description }}</textarea>
            </div>
            <div class="mb-3 col-md-12">
              <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{  ($bankCash->status == 1 ? ' checked' : '') }}>
              <label for="lastName" class="form-label">Set as default</label>
            </div> 
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button type="reset" class="btn btn-outline-secondary" onclick="window.location='{{ route('account-bank-cash-list') }}'">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
