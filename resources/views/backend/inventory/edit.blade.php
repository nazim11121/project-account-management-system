@extends('layouts/contentNavbarLayout')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Project /</span> Edit
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Project Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('project-update', $inventory->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Project Name</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" id="name" name="name" value="{{ $inventory->name }}" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="client_name">Client Name</label><span class="requiredStar" style="color: red"> * </span>
              <select name="client_name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($client as $value)
                  <option value="{{ $value->id }}" @if($value->id == $inventory->client_name) selected @endif>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="assign_date" class="form-label">Assign Date</label>
              <input class="form-control" type="date" id="assign_date" name="assign_date" value="{{ $inventory->assign_date }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="organization" class="form-label">Submission Date</label>
              <input type="date" class="form-control" id="submission_date" name="submission_date" value="{{ $inventory->submission_date }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="total_cost">Estimate Cost</label>
              <input type="text" class="form-control" id="total_cost" name="total_cost" value="{{ $inventory->total_cost }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="total_price">Project Value(Price)</label><span class="requiredStar" style="color: red"> * </span>
              <input type="text" class="form-control" id="total_price" name="total_price" value="{{ $inventory->total_price }}" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <textarea type="text" class="form-control" id="address" name="address" value="{{ $inventory->address }}" >{{ $inventory->address }}</textarea> 
            </div>
            <div class="mb-3 col-md-6">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" type="text" name="description" id="description" value="{{ $inventory->description }}">{{ $inventory->description }}</textarea> 
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Status</label>
              <select name="status" class="form-control custom-select">
                  <option value="running" {{ $inventory->status == 'running' ? 'selected' : '' }}>Running</option>
                  <option value="stop" {{ $inventory->status == 'stop' ? 'selected' : '' }}>Stop</option>
                  <option value="complete" {{ $inventory->status == 'complete' ? 'selected' : '' }}>Complete</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="file">Upload File</label>
              @if(empty($inventory->file))
                <input type="file" class="form-control" id="file" name="file" data-max-file-size="5M" data-default-file="" />
              @else
                <img id='img' src="{{ asset('storage/uploads/project') }}/{{$inventory->file }}" style="width:140px; height:100px; margin-left:2px; margin-bottom: 10px">
                <input type="file" class="form-control" id="file" name="file" data-max-file-size="5M" data-default-file="" />
              @endif
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button type="reset" class="btn btn-outline-secondary" onclick="window.location='{{ route('project-list') }}'">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>
@endsection
