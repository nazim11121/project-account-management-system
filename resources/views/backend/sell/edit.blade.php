@extends('layouts/contentNavbarLayout')

@section('title', 'Account - Category')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account /</span> Sell
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Sell Details Edit</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('account-sell-update',$sell->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Select Customer Name</label>
              <select name="name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($customer as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="account_number" class="form-label">Select Project Name</label>
              <select name="name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($project as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="account_number" class="form-label">Select Employee Name</label>
              <select name="name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($employee as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="sell_amount" class="form-label">Sell Amount</label>
              <input class="form-control" type="text" id="sell_amount" name="sell_amount" value="{{ $value->sell_amount }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="sell_date" class="form-label">Sell Date</label>
              <input class="form-control" type="date" id="sell_date" name="sell_date" value="{{ $value->sell_date }}"/>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
