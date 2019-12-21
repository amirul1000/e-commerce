<?php
 include("../template/header.php");
?>
<script language="javascript" src="items.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn green"><i class="fa fa-arrow-circle-left"></i> List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","items"))?></b>
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

								 <form name="frm_items" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
							 <td>Orders</td>
							 <td><?php
	$info['table']    = "orders";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resorders  =  $db->select($info);
?>
<select  name="orders_id" id="orders_id"   class="form-control-static">
	<option value="">--Select--</option>
	<?php
	   foreach($resorders as $key=>$each)
	   { 
	?>
	  <option value="<?=$resorders[$key]['id']?>" <?php if($resorders[$key]['id']==$orders_id){ echo "selected"; }?>><?=$resorders[$key]['order_number']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Os0</td>
						 <td>
						    <input type="text" name="os0" id="os0"  value="<?=$os0?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Os1</td>
						 <td>
						    <input type="text" name="os1" id="os1"  value="<?=$os1?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Item Name</td>
						 <td>
						    <input type="text" name="item_name" id="item_name"  value="<?=$item_name?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Item Number</td>
						 <td>
						    <input type="text" name="item_number" id="item_number"  value="<?=$item_number?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Quantity</td>
						 <td>
						    <input type="text" name="quantity" id="quantity"  value="<?=$quantity?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Currency</td>
						 <td>
						    <input type="text" name="currency" id="currency"  value="<?=$currency?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Amount</td>
						 <td>
						    <input type="text" name="amount" id="amount"  value="<?=$amount?>" class="form-control-static">
						 </td>
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

