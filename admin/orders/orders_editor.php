<?php
 include("../template/header.php");
?>
<script language="javascript" src="orders.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn green"><i class="fa fa-arrow-circle-left"></i> List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","orders"))?></b>
          </div>
          <div class="tools">
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a>
          </div>
      </div>
	   <div class="portlet-body">
		         <div class="table-responsive">	
	                <table class="table">
							 <tr>
							  <td>  

								 <form name="frm_orders" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
							 <td>Products</td>
							 <td><?php
	$info['table']    = "products";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resproducts  =  $db->select($info);
?>
<select  name="products_id" id="products_id"   class="form-control-static">
	<option value="">--Select--</option>
	<?php
	   foreach($resproducts as $key=>$each)
	   { 
	?>
	  <option value="<?=$resproducts[$key]['id']?>" <?php if($resproducts[$key]['id']==$products_id){ echo "selected"; }?>><?=$resproducts[$key]['company_txt']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="users_id" id="users_id"   class="form-control-static">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$users_id){ echo "selected"; }?>><?=$resusers[$key]['email']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Shipping Address</td>
							 <td><?php
	$info['table']    = "shipping_address";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resshipping_address  =  $db->select($info);
?>
<select  name="shipping_address_id" id="shipping_address_id"   class="form-control-static">
	<option value="">--Select--</option>
	<?php
	   foreach($resshipping_address as $key=>$each)
	   { 
	?>
	  <option value="<?=$resshipping_address[$key]['id']?>" <?php if($resshipping_address[$key]['id']==$shipping_address_id){ echo "selected"; }?>><?=$resshipping_address[$key]['ship_first_name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Billing Information</td>
							 <td><?php
	$info['table']    = "billing_information";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resbilling_information  =  $db->select($info);
?>
<select  name="billing_information_id" id="billing_information_id"   class="form-control-static">
	<option value="">--Select--</option>
	<?php
	   foreach($resbilling_information as $key=>$each)
	   { 
	?>
	  <option value="<?=$resbilling_information[$key]['id']?>" <?php if($resbilling_information[$key]['id']==$billing_information_id){ echo "selected"; }?>><?=$resbilling_information[$key]['first_name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Order Number</td>
						 <td>
						    <input type="text" name="order_number" id="order_number"  value="<?=$order_number?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Transactionid</td>
						 <td>
						    <input type="text" name="transactionid" id="transactionid"  value="<?=$transactionid?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Currency</td>
						 <td>
						    <input type="text" name="currency" id="currency"  value="<?=$currency?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Shipping Cost</td>
						 <td>
						    <input type="text" name="shipping_cost" id="shipping_cost"  value="<?=$shipping_cost?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Total Amount</td>
						 <td>
						    <input type="text" name="total_amount" id="total_amount"  value="<?=$total_amount?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Date Created</td>
						 <td>
						    <input type="text" name="date_created" id="date_created"  value="<?=$date_created?>" class="datepicker form-control-static">
						 </td>
				     </tr><tr>
		           		 <td>Delivery Status</td>
				   		 <td><?php
	$enumorders = getEnumFieldValues('orders','delivery_status');
?>
<select  name="delivery_status" id="delivery_status"   class="form-control-static">
<?php
   foreach($enumorders as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$delivery_status){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="id" value="<?=$Id?>">			
												<input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn red">
											 </td>     
										 </tr>
										</table>
										</div>
										</div>
								</form>
							  </td>
							 </tr>
							</table>
			      </div>
			</div>
  </div>
  <script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '../../images/calendar.gif',
	});
</script>  			
<?php
 include("../template/footer.php");
?>

