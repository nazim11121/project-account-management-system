@extends('layouts/contentNavbarLayout')

@section('page-script')
  <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />
  <link href="{{ asset('assets/css/select2-4.0.1.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
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
  <span class="text-muted fw-light">Account /</span> Ledger
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <!-- <h5 class="card-header">Ledger</h5> -->
      <hr class="my-0">
      <div class="card-body" id="card-body">
        <form name="add_name" id="add_service" method="POST" action="{{ route('account-ledger-details') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-3">
              <label class="form-label">Project Name</label><span class="requiredStar" style="color: red"> * </span>
              @if(!empty($start_date))
                <select name="project_name" id="receiver" class="form-control custom-select">
                   <option value="{{$projectName}}">{{$projectName}}</option>
                </select>
              @else
                <select name="project_name" id="receiver" class="form-control custom-select"></select>
              @endif
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">Account Name</label><span class="requiredStar" style="color: red"> * </span>
              @if(!empty($start_date))
                <select name="account_name" class="form-control custom-select" required="">
                    <option value="0">All</option>
                    @foreach($bankCash as $value)
                      <option value="{{ $value->id }}" @if($value->id == $accountName) selected @endif>{{ $value->name }}</option>
                    @endforeach
                </select>
              @else
                <select name="account_name" class="form-control custom-select" required="">
                    <option value="0">All</option>
                    @foreach($bankCash as $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
              @endif
            </div>
            <div class="mb-3 col-md-2">
              <label class="form-label">Start Date</label><span class="requiredStar" style="color: red"> * </span>
              @if(!empty($start_date))
                <div class='input-group date' id='datetimepicker'>
                    <input type='text' class="form-control" name="start_date" value="{{$start_date}}" required="" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              @else
                <div class='input-group date' id='datetimepicker'>
                    <input type='text' class="form-control" name="start_date" required="" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              @endif
            </div>
            <div class="mb-3 col-md-2">
              <label class="form-label">End Date</label><span class="requiredStar" style="color: red"> * </span>
              @if(!empty($start_date))
                <div class='input-group date' id='datetimepicker2'>
                  <input type='text' class="form-control" name="end_date" value="{{$end_date}}" required="" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              @else
                <div class='input-group date' id='datetimepicker2'>
                  <input type='text' class="form-control" name="end_date" required="" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              @endif
            </div>
            <div class="mb-3 col-md-2">
              <button type="submit" class="btn btn-primary me-2 mt-4">Search</button>
            </div>
          </div>
        </form>
        
        <div class="row text-center"  style="font-size: 16px">
          <div class="col-md-3">
            <div class="card bg-white mb-2" style="max-width: 12rem;max-height: 5rem">
              <div class="card-header">Total Expense(Dr.)
                <h4 class="title" style="text-align: center;color: #dc3545">{{$expense}}</h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-white mb-2" style="max-width: 12rem;max-height: 5rem">
              <div class="card-header">Total Deposit(Cr.)
                <h4 class="title" id="deposite" style="text-align: center;color: #28a745">৳{{ $deposite }}</h4>
                <input type="hidden" name="deposite" id="t_deposite" value="{{$deposite}}">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-white mb-2" style="max-width: 12rem;max-height: 5rem">
              <div class="card-header">Balance
                <h4 class="title" id="balance" style="text-align: center;color: #007bff">৳{{ $balance }}</h4>
                <input type="hidden" name="balance" id="t_balance" value="{{$balance}}">
              </div>
            </div>
          </div>  
        </div><br>
        <div class="table-responsive">
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th>Sl</th>
                <th>Date</th>
                <th>Voucher No.</th>
                <!-- <th>Head</th> -->
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <?php $total = 0; ?>
              @foreach ($ledger as $key => $value)
              <?php if($value->type=='dr'){$total-=$value->total;}else{$total+=$value->total;} ?>
                <tr>
                  <td>{{ ++$key }}</td>
                  <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ date('d-m-Y',strtotime($value->created_at)) }}</strong></td>  
                  <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $value->voucher_no }}</strong></td> 
                  @if($value->type=='cr')  
                    <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->total }}</strong></td>
                  @else
                    <td></td>
                  @endif 
                  @if($value->type=='dr') 
                    <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->total }}</strong></td> 
                  @else
                    <td></td>
                  @endif  
                  <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $total }}</strong></td>
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>  
        <input type="hidden" name="" id="totalIncome" value="{{$balance}}">
        <input type="hidden" name="" id="total_expense" value="{{$total}}">
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
  $(function() {
      $('#datetimepicker').datetimepicker({
          // viewMode: 'months',
          format: 'DD/MM/YYYY',
          defaultDate: new Date()
      });
      $('#datetimepicker2').datetimepicker({
          // viewMode: 'months',
          format: 'DD/MM/YYYY',
          defaultDate: new Date()
      });
  });
</script>

<script type="text/javascript">
  
  $(document).ready(function () {
    var balance = $("#t_balance").val();
    var deposite = $("#t_deposite").val();
    var totalExpense = parseFloat(deposite)-parseFloat(balance);
    $("#totalExpenseShow").html('৳'+parseFloat(totalExpense));
    // console.log(totalExpense);
  });

</script>
<script type="text/javascript">
$(document).ready(function () {
 
      var query = $(this).val();;

      $.ajax({

        url:"{{ route('account-ledger-project_name') }}",

        type:"GET",

        data:{'receiver':query},

        success:function (data) {
            // console.log(data);
            $('#receiver').empty().append('<option value="0">All</option>');
            $('#receiver').select2({
              data: data,
              tags: true
            });
          }
        })
      });
</script>