@extends('layouts/contentNavbarLayout')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account / Expense Head /</span> Edit
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Expense Head Details</h5>
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('account-expense-head-update', $expenseHead->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="mb-3 col-md-12">
              <label for="name" class="form-label">Head Name</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" id="name" name="name" value="{{$expenseHead->name}}" required />
            </div>
            <div class="mb-3 col-md-6">
              <label for="code" class="form-label">Head Code</label>
              <input class="form-control" type="text" id="code" name="code" value="{{$expenseHead->code}}" />
            </div>
            <div class="mb-3 col-md-12">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" type="text" id="description" name="description" value="{{$expenseHead->description}}">{{$expenseHead->description}}</textarea>
            </div>
            <!-- <div class="mb-3 col-md-12">
              <label for="lastName" class="form-label">Status</label>
              <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{  ($expenseHead->status == 1 ? ' checked' : '') }}>
            </div> -->
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button type="reset" class="btn btn-outline-secondary" onclick="window.location='{{ route('account-expense-head-list') }}'">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
