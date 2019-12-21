<?php
 include("../template/header.php");
 include("tinymce.php");
?>
<script language="javascript" src="users.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn  btn-primary"><i class="fa fa-arrow-circle-left"></i> List</a> <br><br>

		         
	<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">FB post</h2>
            </header>
            <div class="card-body">  
    
                 <form name="frm_about" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
                  <div class="portlet-body">
                 <div class="table-responsive">	
                    <table class="table">
										 <tr>
							 <!--<td>Users</td>
							 <td><?php
								$info['table']    = "users";
								$info['fields']   = array("*");   	   
								$info['where']    =  "1=1 ORDER BY id DESC";
								$resusers  =  $db->select($info);
							?>
							<select  name="users_id" id="users_id"   class="form-control">
								<option value="">--Select--</option>
								<?php
								   foreach($resusers as $key=>$each)
								   { 
								?>
								  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$users_id){ echo "selected"; }?>><?=$resusers[$key]['name']?></option>
								<?php
								 }
								?> 
							</select></td>
					  </tr>-->
                      <tr>
						 <td valign="top">Message</td>
						 <td>
						    <textarea name="message" id="message"  class="form-control" style="width:200px;height:100px;"><?=$message?></textarea>
						 </td>
				     </tr>
                     <tr>
						 <td valign="top">Title</td>
						 <td>
						    <input type="text" name="title" id="title"  value="<?=$title?>" class="form-control">
                         </td>
				     </tr>
                     <tr>
						 <td>Link</td>
						 <td>
						    <input type="text" name="link" id="link"  value="<?=$link?>" class="form-control">
						 </td>
				     </tr>
                     <tr>
						 <td valign="top">Description</td>
						 <td>
						    <textarea name="description" id="description"  class="form-control" style="width:200px;height:100px;"><?=$description?></textarea>
						 </td>
				     </tr>
                     <tr>
						 <td>Picture</td>
						 <td>
						    <input type="text" name="picture" id="picture"  value="<?=$picture?>" class="form-control">
						 </td>
				     </tr><!--<tr>
						 <td>Last Post Date Time</td>
						 <td>
						    <input type="text" name="last_post_date_time" id="last_post_date_time"  value="<?=$last_post_date_time?>" class="datepicker form-control">
						 </td>
				     </tr>
                     <tr>
		           		 <td>Is Posted</td>
				   		 <td><?php
								$enumfb_post = getEnumFieldValues('fb_post','is_posted');
							?>
							<select  name="is_posted" id="is_posted"   class="form-control">
							<?php
							   foreach($enumfb_post as $key=>$value)
							   { 
							?>
							  <option value="<?=$value?>" <?php if($value==$is_posted){ echo "selected"; }?>><?=$value?></option>
							 <?php
							  }
							?> 
							</select>
                            </td>
				       </tr>-->
                       <tr> 
                         <td align="right"></td>
                         <td>
                            <input type="hidden" name="cmd" value="add">
                            <input type="hidden" name="id" value="<?=$Id?>">			
                            <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn btn-primary">
                         </td>     
                     </tr>
                    </table>
                    </div>
                    </div>
              </form>
           
           </div>
        </section>
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

