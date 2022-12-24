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
      margin-left: 153px;
    }
    #paid-amount-div {
      margin-left: 146px;
    }
    #due-div {
      margin-left: 197px;
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
        <form name="add_name" id="invoice-form" class="invoice-form" method="POST" action="{{ route('purchase-costing-update', $costing->id) }}" enctype="multipart/form-data">
          @csrf
          @method('patch')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="invoice_no" class="form-label">Invoice Number</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="text" id="invoice_no" name="invoice_no" value="{{ $costing->invoice_no }}" required="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="invoice_date" class="form-label">Invoice Date</label><span class="requiredStar" style="color: red"> * </span>
              <input class="form-control" type="date" name="invoice_date" id="invoice_date" value="{{ $costing->invoice_date }}" required="" />
            </div>
            <!-- <div class="mb-3 col-md-6">
              <label for="attachment" class="form-label">Attachment</label>
              <input type="file" class="form-control" id="attachment" name="attachment" value="{{ $costing->attachment }}" />
            </div> -->
            <div class="mb-3 col-md-6">
              <label for="vendor_name" class="form-label">Select Vendor</label>
              <select name="vendor_name" class="form-control custom-select">
                <option value="">Select One..</option>
                @foreach($vendor as $value)
                  <option value="{{ $value->id }}" @if($value->id == $costing->vendor_name) selected @endif>{{ $value->name }}</option>
                @endforeach
              </select>
            </div><br>
            <div class="table">
                <div class="details table-responsive">
                  <table class="table table-hover table-striped table-bordered" id="value">
                    <thead>
                      <th style="display: none"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                      <th width="15px">Sl</th>
                      <th width="250px">Product Name</th>
                      <th width="170px">Quantity</th>
                      <th width="170px">Unit Price</th>
                      <th width="200px">Subtotal</th>
                      <th width="20px"><input type="button" class="float-end add btn btn-sm btn-success glyphicon glyphicon-plus" id="addRows" value="+"></th>
                    </thead>       
                    <tbody>
                      <?php
                      	$count = 0;
                      	foreach($costingInventory as $key => $value){
                      	$count++;
                      ?>
                        <tr>

                          <td style="display: none"><input class="itemRow" type="checkbox"></td>
                          <td>{{$count}}</td>
                          <td>
                            <select class="form-control product_name" name="product_name[]" id="product_names" style="width: 170px">
                              @foreach($product as $key => $products)
                                <option value="{{ $products->name }}" {{ $products->name == $value->product_name ? 'selected' : '' }}>{{ $products->name }}</option>
                              @endforeach  
                            </select>
                          </td>
                          <td>
                            <input type="text" class="quantity form-control" required="required" name="quantity[]" id="quantity_<?php echo $count;?>" value="{{$value->quantity}}" min="0" oninput="this.value = Math.abs(this.value)" style="width: 110px">
                          </td>
                          <td>
                            <input type="text" class="price form-control" required="required" name="price[]" id="price_<?php echo $count;?>" value="{{$value->price}}" min="0" oninput="this.value = Math.abs(this.value)" style="width: 123px">
                          </td>
                          <td>
                            <input type="text" class="subtotal form-control" required="required" name="subtotal[]" id="total_<?php echo $count;?>" value="{{$value->subtotal}}" min="0" oninput="this.value = Math.abs(this.value)" style="width: 167px">
                          </td>
                          <td>
                            <button type="button" name="remove" id="removeRows" class="btn btn-danger btn-sm remove glyphicon glyphicon-remove float-end">
                          </td>
                        </tr>  
                      <?php } ?>
                    </tbody>  
                  </table>
                </div>
                </div>
                <div class="row mt-2">
                  <div class="col-12 col-sm-5 text-grey-d2 text-95 mt-2 mt-lg-0">
                    <input type="text" placeholder="Payment note..." class="form-control" id="payment_note" name="payment_note" value="{{$costing->payment_note}}" /><br>
                    <div class="custom-file">
                      <label class="custom-file-label" for="customFile">Attachment</label>
                      @if(empty($costing->attachment))
                        <input type="file" class="form-control" id="attachment" name="attachment" value="{{ $costing->attachment }}" />
                      @else
                        <img id='img' src="{{ asset('storage/uploads/attachment') }}/{{$costing->attachment }}" style="width:140px; height:100px; margin-left:2px; margin-bottom: 10px">
                        <input type="file" class="form-control" id="attachment" name="attachment" value="{{ $costing->attachment }}" />
                      @endif
                    </div>
                  </div>
                  <div class="col-12 col-sm-7 text-grey text-90 order-first order-sm-last">
                    <div class="row my-2">
                      <div class="col-3 text-right" id="gtotal-div">
                        Grand Total
                      </div>
                      <div class="col-3" id="gamount" style="font-size: 1.2em;">
                        ৳ <b><span class="text-150 text-secondary-d1" id="subTotal2">{{$costing->grand_total}}</span></b>
                        <input type="text" name="grand_total" value="{{$costing->grand_total}}" id="subTotal" style="display: none;">
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-3 text-right" id="paid-amount-div">
                        Paid Amount
                      </div>
                      <div class="col-3 row" style="font-size: 1.2em;">
                        <span><input type="number" value="{{$costing->paid_amount}}" class="form-control" id="paid_amount" name="paid_amount" placeholder="0" /></span>
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-2 text-right" id="due-div">
                        Due
                      </div>
                      <div class="col-3" id="damount" style="font-size: 1.2em;">
                        ৳ <b><span class="text-150 text-secondary-d1" id="due2">{{$costing->due}}</span></b>
                        <input type="number" name="due" id="due" value="{{$costing->due}}" style="display: none;">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="float-end" id="gtotal">
                  <span>Grand Total : <span><input type="text" class="form-control" name="grand_total" id="subTotal" value="{{$costing->grand_total}}" style="cursor: not-allowed;pointer-events:none;"></span>
                </div><br>
                <div class="float-end" id="paid-amount-div">
                  <span>Paid Amount :</span><input type="text" class="form-control" id="paid_amount" name="paid_amount"  value="{{$costing->paid_amount}}" />
                </div> 
                <div class="float-end" id="paid-amount-div">
                  <span>Due :</span><input type="text" class="form-control" id="due" name="due" value="{{$costing->due}}"/>
                </div> 
              </div> -->

          </div>
          <div class="mt-4 float-end sub-button" id="sub-button">
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

    // $('#product_names').click(function() {

        var query = $(this).val();

        $.ajax({

          url:"{{ route('purchase-costing-create-pname2') }}",

          type:"GET",

          data:{'product_names':query},

          success:function (data) {
              console.log(data);
              $('#product_names').empty();
              for (let index = 0; index < data.length; index++) {
              $('#product_names').append('<option value="'+data[index].name+'">'+data[index].name+'</option>');
                }
            }
        })
    // });
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
			htmlRows += '<td><select class="form-control product_name" name="product_name[]" id="product_names" style="width: 170px">@<?php foreach ($product as $key => $products): ?><option value="{{ $products->name }}">{{ $products->name }}</option><?php endforeach ?></select></td>';	
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
		// 	calculateTotal();
		// });	
		// $(document).on('blur', "#paid_amount", function(){
		// 	var amountPaid = $(this).val();
		// 	var totalAftertax = $('#due').val();	
		// 	if(amountPaid && totalAftertax) {
		// 		totalAftertax = totalAftertax-amountPaid;			
		// 		$('#amountDue').val(totalAftertax);
		// 	} else {
		// 		$('#amountDue').val(totalAftertax);
		// 	}	
		// });	
		$(document).on('click', '.deleteInvoice', function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to remove this?")){
				$.ajax({
					url:"action.php",
					method:"POST",
					dataType: "json",
					data:{id:id, action:'delete_invoice'},				
					success:function(response) {
						if(response.status == 1) {
							$('#'+id).closest("tr").remove();
						}
					}
				});
			} else {
				return false;
			}
		});
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
		// var taxRate = $("#taxRate").val();
		var amountPaid = $('#paid_amount').val();	
		// if(amountPaid) {
			// var taxAmount = subTotal*taxRate/100;
			// $('#taxAmount').val(taxAmount);
			// subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
			// $('#totalAftertax').val(subTotal);		
		// 	var amountPaid = $('#paid_amount').val();
		// 	var totalAftertax = $('#subTotal').val();	
		// 	if(amountPaid && totalAftertax) {
		// 		totalAftertax = totalAftertax-amountPaid;			
		// 		$('#due').val(totalAftertax);
  //       $('#due2').html(totalAftertax);
		// 	} else {		
		// 		$('#due').val(subTotal);
  //       $('#due2').html(subTotal);
		// 	}
		// }
	}		
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