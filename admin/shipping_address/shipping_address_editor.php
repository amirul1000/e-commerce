<?php
 include("../template/header.php");
?>
<script language="javascript" src="shipping_address.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn green"><i class="fa fa-arrow-circle-left"></i> List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","shipping_address"))?></b>
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

								 <form name="frm_shipping_address" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
						 <td>Ship First Name</td>
						 <td>
						    <input type="text" name="ship_first_name" id="ship_first_name"  value="<?=$ship_first_name?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Ship Last Name</td>
						 <td>
						    <input type="text" name="ship_last_name" id="ship_last_name"  value="<?=$ship_last_name?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Ship Adress1</td>
						 <td>
						    <input type="text" name="ship_adress1" id="ship_adress1"  value="<?=$ship_adress1?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Ship Adress2</td>
						 <td>
						    <input type="text" name="ship_adress2" id="ship_adress2"  value="<?=$ship_adress2?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Ship Zip Code</td>
						 <td>
						    <input type="text" name="ship_zip_code" id="ship_zip_code"  value="<?=$ship_zip_code?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Ship City</td>
						 <td>
						    <input type="text" name="ship_city" id="ship_city"  value="<?=$ship_city?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Ship State</td>
						 <td>
						    <input type="text" name="ship_state" id="ship_state"  value="<?=$ship_state?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Ship Country</td>
						 <td>
						    <input type="text" name="ship_country" id="ship_country"  value="<?=$ship_country?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Ship Contact Phone</td>
						 <td>
						    <input type="text" name="ship_contact_phone" id="ship_contact_phone"  value="<?=$ship_contact_phone?>" class="form-control-static">
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

