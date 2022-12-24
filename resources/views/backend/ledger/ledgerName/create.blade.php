@extends('layouts/contentNavbarLayout')

@section('title', 'Account - Category')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account /</span> Ledger Name
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Ledger Name Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('ledger-ledgerName-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Ledger Name</label>
              <input class="form-control" type="text" id="name" name="name" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="ledger_type" class="form-label">Ledger Type</label>
              <select name="ledger_type" class="form-control custom-select">
                  <option value="">Select One..</option>
                    @foreach($ledger_type as $value)
                      <option value="{{ $value->id }}">{{ $value->type_name }}</option>
                    @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="ledger_group" class="form-label">Ledger Group</label>
              <select name="ledger_group" class="form-control custom-select">
                  <option value="">Select One..</option>
                    @foreach($ledger_group as $value)
                      <option value="{{ $value->id }}">{{ $value->group_name }}</option>
                    @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="type">Status</label>
              <select name="type" class="form-control custom-select">
                  <option value="">Select One..</option>
                  <option value="Credit">Credit</option>
                  <option value="Debit">Debit</option>
              </select>
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
