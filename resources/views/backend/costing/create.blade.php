@extends('layouts/contentNavbarLayout')

@section('page-script')
  <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('assets/jquery-toast-plugin/jquery.toast.min.css') }}" />
  <link href="{{ asset('assets/css/select2-4.0.1.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
@endsection


<style>
.ui-autocomplete {
  max-height: 100px;
  overflow-y: auto;
  /* prevent horizontal scrollbar */
  overflow-x: hidden;
}
/* IE 6 doesn't support max-height
 * we use height instead, but this forces the menu to always be this tall
 */
* html .ui-autocomplete {
  height: 100px;
}
</style>

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

   /*Small devices (phones)*/
  @media only screen and (min-width: 320px) { 
    #sub-button {
      margin-right: 37px;
    }
     #gtotal-div {
      width: 100px;
    }
    #paid-amount-div {
      width: 114px;
    }
    #due-div {
      width: 60px;
    }
    #gamount{
      width: auto;
    }
    #damount{
      width: auto;
    }
    #paid_amount{
      width: 65px;
    }
  }
 /*Large devices (desktops)*/
  @media only screen and (min-width: 992px) { 

    #sub-button {
      margin-right: 0px;
    }
    #gtotal-div {
      margin-left: 182px;
    }
    #paid-amount-div {
      margin-left: 171px;
    }
    #due-div {
      margin-left: 222px;
    }
  }

  #value {
    counter-reset: serial-number;  /* Set the serial number counter to 0 */
  }
  #value td:first-child:before {
    counter-increment: serial-number;  /* Increment the serial number counter */
    content: counter(serial-number);  /* Display the counter */
  }
</style>

@section('content')
<h4 class="fw-bold py-3 mb-2">
  <span class="text-muted fw-light">Purchase / Costing / </span>Create  
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Purchase Costing Details</h5>
      <hr class="my-0">
      <div class="card-body" id="card-body">
        <form name="add_name" id="invoice-form" class="invoice-form" method="POST" action="{{ route('purchase-costing-store') }}" enctype="multipart/form-data">
        	@csrf
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="invoice_no" class="form-label">Invoice Number</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" id="invoice_no" name="invoice_no" value="{{$invoice_no}}" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="invoice_date" class="form-label">Invoice Date</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="date" name="invoice_date" id="invoice_date" required="" />
            </div>
            <!-- <div class="mb-3 col-md-6">
              <label for="attachment" class="form-label">Attachment</label>
              <input type="file" class="form-control" id="attachment" name="attachment" />
            </div> -->
            <div class="mb-3 col-md-6">
              <label for="vendor_name" class="form-label">Select Vendor</label>
              <select name="vendor_name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($vendor as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
            </div><br>
            <div class="table">
                <div class="details table-responsive">
                  <table class="table table-hover table-striped table-bordered" id="value">
                    <thead>
                      <th width="15px">Sl</th>
                      <th width="250px">Product Name<span class="requiredStar" style="color: red">* </span></th>
                      <th width="170px">Quantity<span class="requiredStar" style="color: red">* </span></th>
                      <th width="170px">Unit Price<span class="requiredStar" style="color: red">* </span></th>
                      <th width="200px">Subtotal<span class="requiredStar" style="color: red">* </span></th>
                      <th width="20px"><input type="button" class="float-end add btn btn-sm btn-success glyphicon glyphicon-plus" id="addRows" value="+"></th>
                    </thead>       
                    <tbody id="dataTable" class="form">
                      <tr>
                        <td id="1A"></td>
                        <td style="display: none">
                          <input  class="itemRow" type="checkbox">
                        </td>
                        <td>
                          <select name="product_name[]" id="receiver_1" class="form-control custom-select">
                            <!-- <option value="">Search..</option> -->
                          </select>  
                        </td>
                        <td>
                          <input type="number" class="form-control quantity" required="required" name="quantity[]" id="quantity_0" min="0" oninput="this.value = Math.abs(this.value)">
                        </td>
                        <td>
                          <input type="number" class="form-control price" required="required" name="price[]" id="price_0" min="0" oninput="this.value = Math.abs(this.value)">
                        </td>
                        <td>
                          <input type="number" class="form-control subtotal" required="required" name="subtotal[]" id="total_0" style="pointer-events: none;" min="0" oninput="this.value = Math.abs(this.value)">
                        </td>
                        <td>
                          <button type="button" name="remove" class="float-end btn btn-danger btn-sm remove glyphicon glyphicon-remove float-end" id="removeRows" >
                        </td>
                      </tr>
                    </tbody>   
                  </table>
                </div><br>
              </div>
              <div class="row mt-1">
                <div class="col-12 col-sm-5 text-grey-d2 text-95 mt-2 mt-lg-0">
                  <input type="text" placeholder="Payment note..." class="form-control" id="payment_note" name="payment_note" /><br>
                  <div class="custom-file">
                    <label class="custom-file-label" for="customFile">Attachment</label>
                    <input type="file" class="form-control" id="attachment" name="attachment" />
                  </div>
                </div>
                <div class="col-12 col-sm-7 text-grey text-90 order-first order-sm-last">
                  <div class="row my-2">
                    <div class="col-3 text-right" id="gtotal-div">
                      Grand Total
                    </div>
                    <div class="col-3" id="gamount" style="font-size: 1.2em;">
                      ৳ <b><span class="text-150 text-secondary-d1" id="subTotal2">0.00</span></b>
                      <input type="text" name="grand_total" id="subTotal" style="display: none;">
                    </div>
                  </div>
                  <div class="row my-2">
                    <div class="col-3 text-right" id="paid-amount-div">
                      Paid Amount
                    </div>
                    <div class="col-3 row" style="font-size: 1.2em;">
                      <span><input type="number" class="form-control" id="paid_amount" name="paid_amount" placeholder="0" min="0" oninput="this.value = Math.abs(this.value)"/></span>
                    </div>
                  </div>
                  <div class="row my-2">
                    <div class="col-2 text-right" id="due-div">
                      Due
                    </div>
                    <div class="col-3" id="damount" style="font-size: 1.2em;">
                      ৳ <b><span class="text-150 text-secondary-d1" id="due2">0.00</span></b>
                      <input type="number" name="due" id="due" style="display: none;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <div class="mt-4 float-end" id="sub-button">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- <div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags_1">
</div> -->
 
@endsection
<!-- <script src="//code.jquery.com/jquery-3.1.0.min.js" type="text/javascript"></script> -->
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
  $(document).on('blur', "[id^=receiver_]", function(){

  //   inS();
  
  // function inS(){
    var rowNum = 0;
    $("[id^='receiver_']").each(function() {
      rowNum++;
      var id = $(this).attr('id');
      id = id.replace("receiver_",'');
      
    });

      var query = $(this).val();;

      $.ajax({

        url:"{{ route('purchase-costing-create-pname') }}",

        type:"GET",

        data:{'receiver_2':query},

        success:function (data) {
            // console.log(data);
            // $('#receiver_'+rowNum).empty().append('<option value="">Search..</option>');
            $('#receiver_'+rowNum).select2({
              data: data,
              tags: true
            });
          }
        })
      });  
    
  // }  
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
      htmlRows += '<td style="display: none"><input class="itemRow" type="checkbox"></td>';          
      htmlRows += '<td>'+count+'</td>';          
      htmlRows += '<td><select name="product_name[]" id="receiver_'+count+'" class="form-control custom-select"></select></td>';  
      htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off" min="0" oninput="this.value = Math.abs(this.value)"></td>';      
      htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off" min="0" oninput="this.value = Math.abs(this.value)"></td>';    
      htmlRows += '<td><input type="number" name="subtotal[]" id="total_'+count+'" class="form-control total" autocomplete="off" min="0" oninput="this.value = Math.abs(this.value)"></td>'; 
      htmlRows += '<td><button type="button" name="remove" id="removeRows" class="btn btn-danger btn-sm remove glyphicon glyphicon-remove float-end"></td>'; 
      htmlRows += '</tr>';
      $('#value').append(htmlRows);
    }); 
    $(document).on('click', '#removeRows', function(){
      // $(".itemRow:checked").each(function() {
        $(this).closest('tr').remove();
      // });
      //$('#checkAll').prop('checked', false);
      calculateTotal();
    });   
    $(document).on('input', "[id^=quantity_]", function(){
      calculateTotal();
    }); 
    $(document).on('input', "[id^=price_]", function(){
      calculateTotal();
    }); 
    // $(document).on('blur', "#taxRate", function(){   
    //  calculateTotal();
    // });  
    // $(document).on('blur', "#paid_amount", function(){
    //  var amountPaid = $(this).val();
    //  var totalAftertax = $('#due').val();  
    //  if(amountPaid && totalAftertax) {
    //    totalAftertax = totalAftertax-amountPaid;     
    //    $('#amountDue').val(totalAftertax);
    //  } else {
    //    $('#amountDue').val(totalAftertax);
    //  } 
    // });  
  }); 
  function calculateTotal(){
    var totalAmount = 0; 
    $("[id^='price_']").each(function() {
      var id = $(this).attr('id');
      id = id.replace("price_",'');
      var price = $('#price_'+id).val();
      var quantity  = $('#quantity_'+id).val();
      if(!quantity) {
        quantity = 1;
      }
      var total = price*quantity;
      $('#total_'+id).val(parseFloat(total));
      totalAmount += total;   
    });
    $('#subTotal').val(parseFloat(totalAmount));  
    $('#subTotal2').html(parseFloat(totalAmount)); 
  }  
    // var taxRate = $("#taxRate").val();
    // var amountPaid = $('#paid_amount').val(); 
    // if(amountPaid) {
      // var taxAmount = subTotal*taxRate/100;
      // $('#taxAmount').val(taxAmount);
      // subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
      // $('#totalAftertax').val(subTotal);   
 //      var amountPaid = $('#paid_amount').val();
 //      var totalAftertax = $('#subTotal').val(); console.log('amountPaid');
 //      if(amountPaid && totalAftertax) {
 //        totalAftertax = totalAftertax-amountPaid;     
 //        $('#due').val(totalAftertax);
 //      } else {    
 //        $('#due').val(subTotal);
 //      }
 //    }
 // }  
</script>
<script type="text/javascript">
  $(document).on('input','#paid_amount', function(){
      var amountPaid = $('#paid_amount').val();
      var totalAftertax = $('#subTotal').val(); 
        if(parseFloat(amountPaid) <= parseFloat(totalAftertax)) {
          totalAftertax = totalAftertax-amountPaid;    
          $('#due').val(totalAftertax);
          $('#due2').html(totalAftertax);
        } else {   
          alert('Paid Amount can not be greater than Grand Total Amount');
          $("#paid_amount").val("");
          $("#due").val("");
          $("#due2").html("");
        }
      });
</script>

  <script>
    $(document).on('blur', "[id^=tags_]", function(){
      inSs();
    });
    function inSs(){
      var rowNum = 0;
      $("[id^='tags_']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("tags_",'');
        // console.log(id);

  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( '#tags_'+id ).autocomplete({
//      source: availableTags, // uncomment this and comment the following to have normal autocomplete behavior
      source: function (request, response) {
          response( availableTags);
      },
      minLength: 0
    }).focus(function(){
//        $(this).data("uiAutocomplete").search($(this).val()); // uncomment this and comment the following to have autocomplete behavior when opening
        $(this).data("uiAutocomplete").search('');
    });
  } );
  } );
    }
  </script>