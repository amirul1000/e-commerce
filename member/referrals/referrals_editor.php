<?php
 include("../template/header.php");
?>
<script language="javascript" src="referrals.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn green"><i class="fa fa-arrow-circle-left"></i> List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","referrals"))?></b>
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

								 <form name="frm_referrals" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
							 <td>Affiliate Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="affiliate_users_id" id="affiliate_users_id"   class="form-control-static">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$affiliate_users_id){ echo "selected"; }?>><?=$resusers[$key]['email']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Buyer Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="buyer_users_id" id="buyer_users_id"   class="form-control-static">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$buyer_users_id){ echo "selected"; }?>><?=$resusers[$key]['email']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
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
	  <option value="<?=$resproducts[$key]['id']?>" <?php if($resproducts[$key]['id']==$products_id){ echo "selected"; }?>><?=$resproducts[$key]['name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Commission</td>
						 <td>
						    <input type="text" name="commission" id="commission"  value="<?=$commission?>" class="form-control-static">
						 </td>
				     </tr><tr>
						 <td>Date Created</td>
						 <td>
						    <input type="text" name="date_created" id="date_created"  value="<?=$date_created?>" class="datepicker form-control-static">
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

