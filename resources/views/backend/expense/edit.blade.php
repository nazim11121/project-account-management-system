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
        <form id="formAccountSettings" method="POST" action="{{ route('account-expense-update',$expenses->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Expense Name</label>
              <input class="form-control" type="text" id="name" name="name" value="{{ $expenses->name }}" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="amount" class="form-label">Amount</label>
              <input type="number" class="form-control" id="amount" name="amount" value="{{ $expenses->amount }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastName" class="form-label">Category</label>
              <select name="category" class="form-control custom-select">
                  <option value="Salary" {{ $expenses->category == 'Salary' ? 'selected' : '' }}>Salary</option>
                  <option value="Stationary" {{ $expenses->category == 'Stationary' ? 'selected' : '' }}>Stationary</option>
                  <option value="Office_Expense" {{ $expenses->category == 'Office_Expense' ? 'selected' : '' }}>Office Expense</option>
                  <option value="Entertainment" {{ $expenses->category == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                  <option value="Conveyance" {{ $expenses->category == 'Conveyance' ? 'selected' : '' }}>Conveyance</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="method">Payment Method</label>
              <select name="method" class="form-control custom-select">
                  <option value="cash" {{ $expenses->category == 'cash' ? 'selected' : '' }}>Cash</option>
                  <option value="bank" {{ $expenses->category == 'bank' ? 'selected' : '' }}>Bank</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="description" class="form-label">Description</label>
              <input class="form-control" type="text" name="description" id="description" value="{{ $expenses->description }}" />
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
