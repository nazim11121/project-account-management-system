@extends('layouts/contentNavbarLayout')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
<link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />
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
</style>
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Purchase / Costing / </span>Create  
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Purchase Costing Details</h5>
      <hr class="my-0">
      <div class="card-body">
        <form id="formAccountSettings" method="POST" action="{{ route('purchase-costing-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="invoice_no" class="form-label">Invoice Number</label>
              <input class="form-control" type="text" id="invoice_no" name="invoice_no" value="{{$invoice_no}}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="invoice_date" class="form-label">Invoice Date</label>
              <input class="form-control" type="date" name="invoice_date" id="invoice_date" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="attachment" class="form-label">Attachment</label>
              <input type="file" class="form-control" id="attachment" name="attachment" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="vendor_name" class="form-label">Select Vendor</label>
              <select name="vendor_name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($vendor as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Product Search</label>
              <input id="product_name" type="text" name="product_search"  placeholder="" class="form-control">
              <input id="value" type="hidden" name="product_search">
              <div class="card" id="name_list"></div>
            </div>
            <div class="panel panel-default">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <tr>
                            <!-- <td>
                                <label for="product_search" class="form-label">Product Image</label>
                                <img src="">
                            </td> -->
                            <td>
                                <label for="product_search" class="form-label">Product Name</label>
                                <input class="form-control" id="product_names" type="text" name="product_search[]" />
                                <!-- <input id="product_name" type="text" name="product_search[]"  placeholder="" class="form-control"> -->
                                <!-- <div class="card" id="name_list"></div> -->
                                <!-- <input id="value" type="hidden" name="product_search[]"> -->
                            </td>
                            <td>
                                <label for="quantity" class="form-label">Quantity</label>
                                <input class="form-control" type="number" id="quantity" name="quantity[]" />
                            </td>
             
                            <td>
                                <label for="price" class="form-label">Price</label>
                                <input class="form-control price" type="number" id="price" name="price[]" />
                            </td>
                            <td>
                                <input type="button" value="+" class="btn btn-danger" onclick="addRow('dataTable')" />
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- <div class="form-inline" style="margin-left: 12px"> -->
                  <td><span><b>Grand Total :</b></span></td>
                  <td><b><span id="total_sum_value"></span></b></td>
                  <input type="text" id="total" name="total" style="display: none" />
                  <br>
                    <span><b>Paid Amount</b></span>
                    <input type="number" class="mb-2 col-sm-2"  id="paid_amount" name="paid_amount" />
                <!-- </div> -->
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('assets/jquery-toast-plugin/toastDemo.js') }}"></script>
<script type="text/javascript" language="javascript">
    function addRow(tableID) {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);
      var colCount = table.rows[0].cells.length;
      for (var i = 0; i < colCount; i++) {
            var newcell = row.insertCell(i);
            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
            //alert(newcell.childNodes);
            switch (newcell.childNodes[0].type) {
              case "text":
                  newcell.childNodes[0].value ="";
                  break;
              // case "checkbox":
              //     newcell.childNodes[0].checked =false;
              //     break;
              // case "select-one":
              //     newcell.childNodes[0].selectedIndex = 0;
              //     break;
            }
        }
    }
</script>
<script type="text/javascript">
  $(document).ready(function () {

    $('#product_name').on('keyup',function() {

        var query = $(this).val();
        // if (query.length > "0") {
        $.ajax({

          url:"{{ route('purchase-costing-create-pname') }}",

          type:"GET",

          data:{'product_name':query},

          success:function (data) {
              // console.log(data);
              $('#name_list').html(data);
            }
        })
    });

    $(document).on('click', 'li', function(){
      var value = $(this).text();
      var value2 = $(this).val();
      // console.log(value);
      $('#product_name').val(value);
      $('#value').val(value2);
      $('#name_list').html("");
      $('#product_names').val(value);
    });
  });  
    $(document).ready(function(){
      
    $("#dataTable").on('input', '.price', function () {
        var calculated_total_sum = 0;
        console.log('hi');
        $("#dataTable .price").each(function () {
          var get_textbox_value = $(this).val();
          if ($.isNumeric(get_textbox_value)) {
            calculated_total_sum += parseFloat(get_textbox_value);
          }                  
        });
        $("#total_sum_value").html(calculated_total_sum);
        $("#total").val(calculated_total_sum);
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