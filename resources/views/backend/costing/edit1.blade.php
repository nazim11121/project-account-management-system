@extends('layouts/contentNavbarLayout')

@section('page-script')
  <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
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
      margin-right: 135px;
    }
    #gtotal {
      margin-right: 122px;
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
  <span class="text-muted fw-light">Purchase / Costing /</span> Edit
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Purchase Costing Details</h5>
      <hr class="my-0">
      <div class="card-body">
        <form name="add_name" id="add_service" method="POST" action="{{ route('purchase-costing-update', $costing->id) }}" enctype="multipart/form-data">
          @csrf
          @method('patch')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="invoice_no" class="form-label">Invoice Number</label>
              <input class="form-control" type="text" id="invoice_no" name="invoice_no" value="{{ $costing->invoice_no }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="invoice_date" class="form-label">Invoice Date</label>
              <input class="form-control" type="date" name="invoice_date" id="invoice_date" value="{{ $costing->invoice_date }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="attachment" class="form-label">Attachment</label>
              <input type="file" class="form-control" id="attachment" name="attachment" value="{{ $costing->attachment }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="vendor_name" class="form-label">Select Vendor</label>
              <select name="vendor_name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($vendor as $value)
                  <option value="{{ $value->id }}" @if($value->id == $costing->vendor_name) selected @endif>{{ $value->name }}</option>
                @endforeach
              </select>
            </div><br>
            <div class="container">
                <div class="details table-responsive">
                  <table class="table table-hover table-striped table-bordered" id="tb2">
                    <thead>
                      <th>Sl</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Subtotal</th>
                      <th><input type="button" class="add btn btn-sm btn-success glyphicon glyphicon-plus" value="+" onclick="addRow('dataTable')"></th>
                    </thead>       
                    <tbody id="dataTable" class="form">
                      
                      @foreach($costingInventory as $key => $value)
                        <tr id='row_0'>
                          <td></td>
                          <td>
                            <select class="form-control product_name" name="product_name[]" id="product_name" style="width: 170px">
                              @foreach($product as $key => $products)
                                <option value="{{ $products->id }}" {{ $products->id == $value->product_name ? 'selected' : '' }}>{{ $products->name }}</option>
                              @endforeach  
                            </select>
                          </td>
                          <td>
                            <input type="text" class="quantity" required="required" name="quantity[]" value="{{$value->quantity}}" oninput="calculate('row_0')" style="width: 110px">
                          </td>
                          <td>
                            <input type="text" class="price" required="required" name="price[]" value="{{$value->price}}" oninput="calculate('row_0')" style="width: 123px">
                          </td>
                          <td>
                            <input type="text" class="subtotal" required="required" name="subtotal[]" value="{{$value->subtotal}}" style="width: 167px">
                          </td>
                          <td>
                            <button type="button" name="remove" class="btn btn-danger btn-sm remove glyphicon glyphicon-remove float-sm-right" onclick="removeRow('dataTable', '0')" >
                          </td>
                        </tr>  
                      @endforeach
                        <!-- <td id="1A"></td>
                        <td>
                          <select class="form-control product_name" name="product_name[]" id="product_name" style="width: 170px">
                            <option value="" >Search...</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="quantity" required="required" name="quantity[]" oninput="calculate('row_0')" style="width: 110px">
                        </td>
                        <td>
                          <input type="text" class="price" required="required" name="price[]" oninput="calculate('row_0')" style="width: 123px">
                        </td>
                        <td>
                          <input type="text" class="subtotal" required="required" name="subtotal[]" style="width: 167px">
                        </td>
                        <td>
                          <button type="button" name="remove" class="btn btn-danger btn-sm remove glyphicon glyphicon-remove float-sm-right" onclick="removeRow('dataTable', '0')" >
                        </td> -->
                      
                    </tbody>  
                  </table>
                </div><br>

                <div class="float-end" id="gtotal">
                  <span>Grand Total : <span><input type="text" class="" name="grand_total" id="grand_total" value="{{$costing->grand_total}}" style="cursor: not-allowed;pointer-events:none;"></span>
                </div><br>
                <div class="float-end" id="paid-amount-div">
                  <span>Paid Amount :</span><input type="text" class="" id="paid_amount" name="paid_amount"  value="{{$costing->paid_amount}}" />
                  <!-- <span>Due :</span><input type="number" class="" id="due" name="due" /> -->
                </div> 
                <div class="float-end" id="paid-amount-div">
                  <span>Due :</span><input type="text" class="" id="due" name="due" value="{{$costing->due}}"/>
                </div> 

            </div>
          </div><br>
          <div class="mt-2 float-end sub-button" id="sub-button">
            <button type="submit" class="btn btn-primary me-2">Update</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<script src="//code.jquery.com/jquery-3.1.0.min.js" type="text/javascript"></script>
<!-- <script src="{{ asset('assets/js/jquery-1.9.1.min.js') }}"></script> -->
<script src="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('assets/jquery-toast-plugin/toastDemo.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
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

 <!--  $(function () {
  $("select").select2();
}); -->

<script type="text/javascript">

  $(document).ready(function () {

    // $('#product_name').click(function() {

        var query = $(this).val();

        $.ajax({

          url:"{{ route('purchase-costing-create-pname') }}",

          type:"GET",

          data:{'product_name':query},

          success:function (data) {
              //console.log(data);
              $('#product_name').empty();
              for (let index = 0; index < data.length; index++) {
              $('#product_name').append('<option value="'+data[index].id+'">'+data[index].name+'</option>');
                }
            }
        })
    // });
});
</script>
<script>
  function calculate(elementID) {
      var mainRow = document.getElementById(elementID);console.log(mainRow);
      var myBox1 = mainRow.querySelectorAll('[class=quantity]')[0].value;
      var myBox2 = mainRow.querySelectorAll('[class=price]')[0].value;
      var total = mainRow.querySelectorAll('[class=subtotal]')[0];
      var myResult1 = myBox1 * myBox2;
      total.value = myResult1;
      grandtotal();
  }

  function grandtotal(){

      //calculation script
      var $form = $('#add_service'),
          $sumDisplay = $('#grand_total');

      var $summands = $form.find('.subtotal');
      var sum = 0;
      $summands.each(function ()
      {
          var value = Number($(this).val());
          if (!isNaN(value)) sum += value;
      });

      $sumDisplay.val(sum);
  }

  function addRow(tableID) {
    // serial increment
    var data = $("#tb2 tr:eq(1)").appendTo("#tb2");
    data.find("input");
    // console.log(data.find("input.price"));
    // serial increment end
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length; 
    if (rowCount < 10) { 

        var row = table.insertRow(rowCount);
       // console.log(row);
        var colCount = table.rows[0].cells.length;
        row.id = 'row_' + rowCount;
        for (var i = 0; i < colCount; i++) {
            var newcell = row.insertCell(i);
            newcell.outerHTML = table.rows[0].cells[i].outerHTML;
        }
        var listitems = row.getElementsByTagName("input")
        for (i = 0; i < listitems.length - 1; i++) {
            listitems[i].setAttribute("oninput", "calculate('" + 
        row.id + "')");
        }
        // listitems[listitems.length - 1].setAttribute("onclick", "removeRow('dataTable', " + row.id + ")");
    } else {
        alert("Maximum 10.");
    }
  }

  function removeRow(tableID, index) {
    //Removing the row
    var table = document.getElementById(tableID);
    table.deleteRow(index);
    //Modifying the ids of subsequent rows
    var rowCount = table.rows.length;
    for (var i = index; i < rowCount; i++) {
        table.rows[i].id = "row_" + i;
    }
    //Handling the counts
    grandtotal();
  }
</script>
<!-- Due calculation -->
<script>
  $(document).ready(function(){
      // Get value on button click and show alert
      $("#paid_amount").on('keyup',function(){
          var paid_amount = $("#paid_amount").val();
          var grand_total = $("#grand_total").val();
          if (parseFloat(grand_total)>=parseFloat(paid_amount)) {
            console.log(grand_total);
            console.log(paid_amount);
            var due = (grand_total-paid_amount);
            $("#due").val(due);
          }else{
            alert('Paid Amount can not be greater than Grand Total Amount');
            $("#paid_amount").val("");
            $("#due").val("");
            // window.location.reload();
          }
      });
  });
</script>

<!-- <script type="text/javascript">
  $(function(){
    $('.add').on('click', function() {
        var data = $("#tb2 tr:eq(1)").clone(true).appendTo("#tb2");
        data.find("input").val('');
    });
    $(document).on('click', '.remove', function() {
      var trIndex = $(this).closest("tr").index();
        if(trIndex>1) {
        $(this).closest("tr").remove();
      } else {
        
      }
    });
  }); 
</script> -->