@extends('layouts/contentNavbarLayout')

@section('page-script')
  <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />
  <link href="{{ asset('assets/css/select2-4.0.1.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap-v3.3.6/css/bootstrap-datetimepicker-4.17.37.min.css') }}">
  <script src="{{ asset('assets/bootstrap-v3.3.6/js/jquery-1.12.4.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap-v3.3.6/js/moment-2.14.1.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap-v3.3.6/js/bootstrap-3.3.6.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap-v3.3.6/js/bootstrap-datetimepicker-4.17.37.min.js') }}"></script>
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

    .col-2{
      width: 43.666667%!important;
    }
    .col-3{
      width: 30%!important;
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

    .row .my-2{
      margin-left: 528px;
    }
    .col-2{
      width: 24.666667%!important;
    }
  }

  @media (min-width: 768px){
    .col-sm-7 {
        width: 70%!important;
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
<h4 class="fw-bold ">
  <span class="text-muted fw-light">Account / Salary / </span>Create  
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Salary Details</h5>
      <hr class="my-0">
      <div class="card-body" id="card-body">
        <form name="add_name" id="add_service" method="POST" action="{{ route('account-salary-store') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="mb-3 col-md-3">
              <label class="form-label">Expense Date</label><span class="requiredStar" style="color: red"> * </span>
              <div class='input-group date' id='datetimepicker'>
                  <input type='text' class="form-control" name="expense_date" id="expense_date" required="" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
              <!-- <input class="form-control" type="text" name="expense_date" value="{{ date('d-m-Y') }}" id="expense_date" required="" /> -->
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">Expense Head</label><span class="requiredStar" style="color: red"> * </span>
              <select name="expense_head" class="form-control custom-select" required="">
                <option value="">Select..</option>
                @foreach($expenseHead as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">Project Name</label>
              <select name="project_name" id="project_name" class="form-control custom-select">
                <option value="">Select one..</option>
              </select>
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">Receiver</label>
              <select name="receiver" id="receiver" class="form-control custom-select">
              </select>
            </div>
            <div class="mb-3 col-md-3"><span class="requiredStar" style="color: red"> * </span>
              <label for="voucher_no" class="form-label">Voucher Number</label>
              <input class="form-control" type="text" id="voucher_no" name="voucher_no" value="{{$voucher_no}}" required="" />
            </div>
            <div class="mb-3 col-md-3">
              <label class="form-label">Payment From</label><span class="requiredStar" style="color: red"> * </span>
              <select name="source" class="form-control custom-select" required="">
                <option value="">Select..</option>
                @foreach($bankCash as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-3">
              <label for="attachment" class="form-label">Attach the File</label>
              <input type="file" class="form-control" id="attachment" name="attachment" />
            </div>
                        
            <div class="container mt-4">
                <div class="details table-responsive">
                  <table class="table table-hover table-striped table-bordered" id="tb2">
                    <thead>
                      <th width="2%" style="display: none"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                      <th class="text-center">Sl</th>
                      <th class="text-center">Expense Details</th>
                      <th class="text-center">Amount</th>
                      <th class="text-center"><input type="button" class="add btn btn-sm btn-success glyphicon glyphicon-plus" value="+" id="addRows"></th>
                    </thead>       
                    <tbody id="dataTable" class="form text-center">
                      <tr>
                        <td><input class="itemRow" type="checkbox" style="display: none"></td>
                        <!-- <td id="1A" class="text-center"></td> -->
                        <td>
                          <input type="text" class="form-control" name="expense_details[]" id="expense_details_1">
                        </td>
                        <td style="width: 200px">
                          <input type="number" class="subtotal form-control" id="subtotal_1" name="amount[]" required="">
                        </td>
                        <td class="text-center">
                          <button type="button" name="remove" class="btn btn-danger btn-sm remove glyphicon glyphicon-trash float-sm-right" id="removeRows">
                        </td>
                      </tr>
                    </tbody>  
                  </table>
                </div>

                <div class="row mt-1">
                  <div class="col-12 col-sm-12 text-grey text-90 order-first order-sm-last">
                    <div class="row my-2">
                      <div class="col-2 text-right" >
                        Grand Total :
                      </div>
                      <div class="col-3" style="font-size: 1.2em;">
                         ৳ <b><span class="text-150 text-secondary-d1" id="total2">0.00</span></b>
                        <input type="text" name="total" id="total" style="display: none;" required="">
                      </div>
                    </div>
                  </div>  
                </div>
            </div>
          </div>
          <div class="row">&nbsp;
            <div class="mb-3 col-md-6">
              <label class="form-label">Payment Note</label>
              <input type="text" class="form-control" id="payment_note" name="payment_note" />
            </div>
          </div>
          <div class="float-end sub-button" id="sub-button">
            <button type="submit" class="btn px-4 py-2 btn-primary me-2">Save</button>
            <button type="reset" class="btn py-2 btn-secondary">Cancel</button>
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

      url:"{{ route('account-salary-create-ename') }}",

      type:"GET",

      data:{'receiver':query},

      success:function (data) {
          // console.log(data);
          $("#receiver").select2({
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
<script type="text/javascript">
   $(document).ready(function(){
    $(document).on('click', '#checkAll', function() {           
      $(".itemRow").prop("checked", this.checked);
    }); 
    $(document).on('click', '.itemRow', function() {    
      if ($('.itemRow:checked').length == $('.itemRow').length) {
        $('#checkAll').prop('checked', true);
      } else {
        $('#checkAll').prop('checked', false);
      }
    });  
    var count = $(".itemRow").length;
    $(document).on('click', '#addRows', function() { 
      count++;
      var htmlRows = '';
      htmlRows += '<tr>';
      htmlRows += '<td><input style="display: none" class="itemRow" type="checkbox"></td>';
      htmlRows += '<td><input type="text" name="expense_details[]" id="expense_details_'+count+'" class="form-control" autocomplete="off"></td>';   
      htmlRows += '<td><input type="number" name="amount[]" id="subtotal_'+count+'" class="form-control subtotal" autocomplete="off" required></td>'; 
      htmlRows += '<td class="text-center"><button type="button" name="remove" class="btn btn-danger btn-sm remove glyphicon glyphicon-trash float-sm-right" id="removeRows_'+count+'"></td>';         
      htmlRows += '</tr>';
      $('#tb2').append(htmlRows);
    }); 
    $(document).on('click', '.remove', function(){
      // $("#removeRows_1").each(function() {
        $(this).closest('tr').remove();
      // });
      $('#checkAll').prop('checked', false);
      calculateTotal();
    }); 
    $(document).on('input', "[id^=subtotal_]", function(){
      calculateTotal();
    });   
  });
  function calculateTotal(){
    var totalAmount = 0; 
    $("[id^='subtotal_']").each(function() {
      var id = $(this).attr('id');
      id = id.replace("subtotal_",'');
      var subtotal = $('#subtotal_'+id).val();
      var total = subtotal;
      totalAmount += parseFloat(total);  
      
    });
    var cleanNum = isNaN(totalAmount) ? '0.00' : totalAmount;
    $('#total').val(parseFloat(cleanNum)); 
    $('#total2').html(parseFloat(cleanNum)); 
  }
</script>
<script type="text/javascript">
  $(function() {
      $('#datetimepicker').datetimepicker({
          // viewMode: 'months',
          format: 'DD/MM/YYYY',
          defaultDate: new Date()
      });
  });
</script> 