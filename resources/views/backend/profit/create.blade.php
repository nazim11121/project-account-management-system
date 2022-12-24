@extends('layouts/contentNavbarLayout')

@section('page-script')
  <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />
  <link href="{{ asset('assets/css/select2-4.0.1.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
@endsection

<style type="text/css">
  #style #name_list{
    display: block;
    background-color: white;
    list-style-type: none;
    position: relative;
    width: 185px;
    height: 60px;
    /*opacity: 10;*/
  }
  #style option{
    margin-left: 10px;
  }
  #style option:hover{
    background-color: #c2c2a3;
  }

  #sub-button{
    margin-right: 135px;
  }

  #gtotal{
    margin-right: 122px;
  }

  #paid-amount-div{
    margin-left: 576px;
    margin-top: 24px;
  }

  #paid-amount-button{
    margin-left: 533px;
  }

   /*Small devices (phones)*/
  @media only screen and (min-width: 320px) { 
    #sub-button {
      margin-right: 61px;
    }
    #gtotal {
      margin-right: 0px;
    }
    #paid-amount-div {
      margin-right: 57px;
    }
    #paid-amount-button {
      margin-right: 708px;
    }
  }
 /*Large devices (desktops)*/
  @media only screen and (min-width: 992px) { 
    #sub-button {
      margin-right: 170px;
    }
    #gtotal {
      margin-right: 152px;
    }
    #paid-amount-div {
      margin-right: 121px;
      margin-top: 22px;
    }
    #paid-amount-button {
      margin-left: 533px;
    }
  }

  #tb2 {
    counter-reset: serial-number;  /* Set the serial number counter to 0 */
  }
  #tb2 td:first-child:before {
    counter-increment: serial-number;  /* Increment the serial number counter */
    content: counter(serial-number);  /* Display the counter */
  }
</style>

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Account / Deposit(Cr) / </span>Create  
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Deposit(Cr) Details</h5>
      <hr class="my-0">
      <div class="card-body" id="card-body">
        <form name="add_name" id="add_service" method="POST" action="{{ route('account-profit-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-4">
              <label class="form-label">Date of Deposit(Cr)</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" name="income_date" value="{{ date('d-m-Y') }}" id="income_date" required="" />
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Deposit(Cr) Head</label><span class="requiredStar" style="color: red"> * </span>
              <select name="income_head" class="form-control custom-select" required="">
                <option value="">Select..</option>
                @foreach($incomeHead as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Project Name</label><span class="requiredStar" style="color: red"> * </span>
              <select name="project_name" id="project_name" class="form-control custom-select" required="">
                <option value="">Select one..</option>
              </select>
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label">Giver</label>
              <select name="giver" id="giver" class="form-control custom-select">
              </select>
            </div>
            <div class="mb-3 col-md-4">
              <label for="voucher_no" class="form-label">Voucher Number</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" id="voucher_no" name="voucher_no" value="{{$voucher_no}}" required="" />
            </div>
            <div class="mb-3 col-md-4">
              <label for="amount" class="form-label">Amount of Money</label><span class="requiredStar" style="color: red"> * </span>
              <input type="number" class="form-control" id="amount" name="amount" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Fund</label><span class="requiredStar" style="color: red"> * </span>
              <select name="source" class="form-control custom-select" required="">
                <option value="">Select..</option>
                @foreach($bankCash as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="attachment" class="form-label">Attach the File</label>
              <input type="file" class="form-control" id="attachment" name="attachment" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Payment Note</label>
              <input type="text" class="form-control" id="payment_note" name="payment_note" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Description</label>
              <input type="text" class="form-control" id="description" name="description" />
            </div>
          </div>  <br>
          <div class="float-right sub-button" id="sub-button">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="{{ asset('assets/js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('assets/jquery-toast-plugin/toastDemo.js') }}"></script>
<script src="{{ asset('assets/js/select2-4.0.1.min.js') }}" defer></script>
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

<script type="text/javascript">

  $(document).ready(function () {

    var query = $(this).val();

    $.ajax({

      url:"{{ route('account-profit-create-cname') }}",

      type:"GET",

      data:{'giver':query},

      success:function (data) {
          // console.log(data);
          $("#giver").select2({
            data: data
          });
        }
    })
});
</script>
<!-- project name function -->
<script type="text/javascript">

  $(document).ready(function () {

    var query = $(this).val();

    $.ajax({

      url:"{{ route('account-salary-create-pjname') }}",

      type:"GET",

      data:{'project_name':query},

      success:function (data) {
          // console.log(data);
          $("#project_name").select2({
            data: data
          });
        }
    })
});
</script>