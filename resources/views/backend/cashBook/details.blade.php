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
      margin-right: 0px;
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
  <span class="text-muted fw-light">Account /</span> Cashbook
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <!-- <h5 class="card-header">Ledger</h5> -->
      <hr class="my-0">
      <div class="card-body" id="card-body">
        <form name="add_name" id="add_service" method="POST" action="{{ route('account-cashbook-details') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="mb-3 col-md-3">
              <label class="form-label">Date</label><span class="requiredStar" style="color: red"> * </span>
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
              <button type="submit" class="btn btn-primary me-2 mt-4">Search</button>
            </div>
          </div>
        </form>
          <div class="row">
            <div class="table-responsive col-md-6">
              <h5 class="">Deposit(Cr)</h5>
                <table class="table table-hover table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Voucher No.</th>
                      <th>Head</th>
                      <th>Source</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php $total = 0; ?>
                    @foreach ($profit as $key => $value)
                    <?php $total+=$value->total; ?>
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $value->voucher_no }}</strong></td> 
                        @if(empty($value->income_head))
                          <td></td>
                        @else         
                          <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->income_heads->name }}</strong></td>
                        @endif 
                        <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->sources->name }}</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->total }}</strong></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="float-end" id="gtotal">
                  <span>Total : <span><input type="text" class="" name="total" id="profit_total" value="{{$total}}" style="cursor: not-allowed;pointer-events:none;width: 102px;text-align: center"></span>
                </div>
            </div>

            <div class="table-responsive col-md-6">
              <h5 class="">Expense(Dr)</h5>
                <table class="table table-hover table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Voucher No.</th>
                      <th>Head</th>
                      <th>Source</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php $total = 0; ?>
                    @foreach ($expense as $key => $value)
                     <?php $total+=$value->total; ?>
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger"></i> <strong>{{ $value->voucher_no }}</strong></td>                
                        <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->expense_heads->name }}</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->sources->name }}</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-1"></i> <strong>{{ $value->total }}</strong></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="float-end" id="gtotal">
                  <span>Total : <input type="text" class="" name="total" id="expense_total" value="{{$total}}" style="cursor: not-allowed;pointer-events:none;width: 102px;text-align: center"></span>
                </div>
            </div>
        </div><br>
        <div class="float-center mb-2 col-sm-3">
          <button class="btn btn-info profit" style="display: none"><strong>Total Deposit : </strong><span id="grandTotal"></span> Tk</button>
          <button class="btn btn-info loss" style="display: none"><strong>Total Loss : </strong><span id="grandTotalLoss"></span> Tk</button>
        </div>
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
    var profit = $("#profit_total").val();
    var expense = $("#expense_total").val();
    if (parseFloat(profit)<parseFloat(expense)) {
      var grandTotal = (parseFloat(expense) - parseFloat(profit));
      $("#grandTotalLoss").html(grandTotal);
      $(".loss").removeAttr("style").hide();
      $(".loss").show();
    }else{
      var grandTotal = (parseFloat(profit) - parseFloat(expense));
      $("#grandTotal").html(grandTotal);
      $(".profit").removeAttr("style").hide();
      $(".profit").show();
    }
  });

</script>