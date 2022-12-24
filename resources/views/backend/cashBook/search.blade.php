@extends('layouts/contentNavbarLayout')

@section('page-script')
  <link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Reporting / </span>Search  
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Report Search</h5>
      <hr class="my-0">
      <div class="card-body" id="card-body">
        <form name="add_name" id="add_service" method="POST" action="{{ route('reporting-searchValue') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-3">
              <label class="form-label">Start Date</label><span class="requiredStar" style="color: red"> * </span>
              <div class='input-group date' id='datetimepicker'>
                  <input type='text' class="form-control" name="start_date" required="" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">Start Date</label><span class="requiredStar" style="color: red"> * </span>
              <div class='input-group date' id='datetimepicker2'>
                  <input type='text' class="form-control" name="end_date" required="" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
            </div>
          </div>
          <div class="float-right sub-button" id="sub-button">
            <button type="submit" class="btn btn-primary me-2">Report Show</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('assets/jquery-toast-plugin/toastDemo.js') }}"></script>

<script type="text/javascript">
  $(function() {
      $('#datetimepicker').datetimepicker({
          // viewMode: 'months',
          format: 'DD/MM/YYYY'
      });
      $('#datetimepicker2').datetimepicker({
          // viewMode: 'months',
          format: 'DD/MM/YYYY'
      });
  });
</script>  
<script type="text/javascript">
  $(document).ready(function () {
    @if (session('success'))
    showSuccessToast('{{ session("success") }}');
    @elseif(session('warning'))
    showWarningToast('{{ session("warning") }}');
    @elseif(session('danger'))
    showDangerToast('{{ session("danger") }}');
    @endif
  });
</script>