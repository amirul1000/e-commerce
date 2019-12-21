<?php
 include("../template/header.php");
?>
<script language="javascript" src="company.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn green"><i class="fa fa-arrow-circle-left"></i> List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","company"))?></b>
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

								 <form name="frm_company" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
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
						 <td>Company Name</td>
						 <td>
						    <input type="text" name="company_name" id="company_name"  value="<?=$company_name?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td valign="top">Description</td>
						 <td>
						    <textarea name="description" id="description"  class="form-control-static" style="width:200px;height:100px;"><?=$description?></textarea>
						 </td>
				     </tr><tr>
						 <td>File Logo</td>
						 <td><input type="file" name="file_logo" id="file_logo"  value="<?=$file_logo?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Business Type</td>
						 <td>
						    <input type="text" name="business_type" id="business_type"  value="<?=$business_type?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Main Products</td>
						 <td>
						    <input type="text" name="main_products" id="main_products"  value="<?=$main_products?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Total Annual Revenue</td>
						 <td>
						    <input type="text" name="total_annual_revenue" id="total_annual_revenue"  value="<?=$total_annual_revenue?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Total Employees</td>
						 <td>
						    <input type="text" name="total_employees" id="total_employees"  value="<?=$total_employees?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Year Established</td>
						 <td>
						    <input type="text" name="year_established" id="year_established"  value="<?=$year_established?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Social Link</td>
						 <td>
						    <input type="text" name="social_link" id="social_link"  value="<?=$social_link?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Email</td>
						 <td>
						    <input type="text" name="email" id="email"  value="<?=$email?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Cell Phone</td>
						 <td>
						    <input type="text" name="cell_phone" id="cell_phone"  value="<?=$cell_phone?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Land Phone</td>
						 <td>
						    <input type="text" name="land_phone" id="land_phone"  value="<?=$land_phone?>" class="form-control-static">
						 </td>
				     </tr><tr>
							 <td>Country</td>
							 <td><?php
	$info['table']    = "country";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$rescountry  =  $db->select($info);
?>
<select  name="country_id" id="country_id"   class="form-control-static">
	<option value="">--Select--</option>
	<?php
	   foreach($rescountry as $key=>$each)
	   { 
	?>
	  <option value="<?=$rescountry[$key]['id']?>" <?php if($rescountry[$key]['id']==$country_id){ echo "selected"; }?>><?=$rescountry[$key]['country']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Country Txt</td>
						 <td>
						    <input type="text" name="country_txt" id="country_txt"  value="<?=$country_txt?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>State</td>
						 <td>
						    <input type="text" name="state" id="state"  value="<?=$state?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>City Town</td>
						 <td>
						    <input type="text" name="city_town" id="city_town"  value="<?=$city_town?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Area</td>
						 <td>
						    <input type="text" name="area" id="area"  value="<?=$area?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Zip Code</td>
						 <td>
						    <input type="text" name="zip_code" id="zip_code"  value="<?=$zip_code?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td valign="top">Address</td>
						 <td>
						    <textarea name="address" id="address"  class="form-control-static" style="width:200px;height:100px;"><?=$address?></textarea>
						 </td>
				     </tr><tr>
						 <td>Latitude</td>
						 <td>
						    <input type="text" name="latitude" id="latitude"  value="<?=$latitude?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Longitude</td>
						 <td>
						    <input type="text" name="longitude" id="longitude"  value="<?=$longitude?>" class="form-control-static">
						 </td>
				     </tr><tr>
		           		 <td>Status</td>
				   		 <td><?php
	$enumcompany = getEnumFieldValues('company','status');
?>
<select  name="status" id="status"   class="form-control-static">
<?php
   foreach($enumcompany as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
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

