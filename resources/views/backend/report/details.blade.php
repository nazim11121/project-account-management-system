@extends('layouts/contentNavbarLayout')
  <link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />
@section('content')
<div class="col-md-12">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Reporting / </span> Details
  </h4>
</div>
  <h5 class="card-header text-center">{{$start_date}} To {{$end_date}}</h5>
  <div class="row">
    <div class="table-responsive col-md-6">
      <h5 class="card-header">Profit</h5>
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
          <span>Cash : <span><input type="text" class="" name="total" id="profit_total" value="{{$total}}" style="cursor: not-allowed;pointer-events:none;width: 102px;text-align: center"></span>
        </div>
    </div>

    <div class="table-responsive col-md-6">
      <h5 class="card-header">Expense</h5>
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
  <button class="btn btn-info profit" style="display: none"><strong>Total Profit : </strong><span id="grandTotal"></span> Tk</button>
  <button class="btn btn-info loss" style="display: none"><strong>Total Loss : </strong><span id="grandTotalLoss"></span> Tk</button>
</div>

@endsection
<script src="{{ asset('assets/datatables4/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('assets/jquery-toast-plugin/toastDemo.js') }}"></script>

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