@extends('layouts/contentNavbarLayout')

<!-- @section('title', 'Account settings - Account') -->

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account /</span> Expense
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Expense Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('account-expense-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Expense Name</label>
              <input class="form-control" type="text" id="name" name="name" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="amount" class="form-label">Amount</label>
              <input type="number" class="form-control" id="amount" name="amount" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastName" class="form-label">Expense Head</label>
              <select name="category" class="form-control custom-select">
                  <option value="">Select One..</option>
                  <option value="Salary">Salary</option>
                  <option value="Stationary">Stationary</option>
                  <option value="Office_Expense">Office Expense</option>
                  <option value="Entertainment">Entertainment</option>
                  <option value="Conveyance">Conveyance</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="method">Payment Method</label>
              <select name="method" class="form-control custom-select">
                  <option value="">Select One..</option>
                  <option value="cash">Cash</option>
                  <option value="bank">Bank</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="description" class="form-label">Description</label>
              <input class="form-control" type="text" name="description" id="description" />
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
