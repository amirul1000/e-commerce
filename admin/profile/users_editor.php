<?php
 include("../template/header.php");
?>
<script language="javascript" src="users.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn  btn-primary"><i class="fa fa-arrow-circle-left"></i> Back</a> <br><br>

		         
	<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Profile</h2>
            </header>
            <div class="card-body">                
							
                   <form name="frm_users" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
     
                        <table  class="table table-bordered table-striped mb-0" id="datatable-default">
                             <tr>
                                 <td>Email</td>
                                 <td>
                                    <input type="text" name="email" id="email"  value="<?=$email?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>Password</td>
                                 <td>
                                    <input type="text" name="password" id="password"  value="<?=$password?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>Title</td>
                                 <td>
                                    <input type="text" name="title" id="title"  value="<?=$title?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>First Name</td>
                                 <td>
                                    <input type="text" name="first_name" id="first_name"  value="<?=$first_name?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>Last Name</td>
                                 <td>
                                    <input type="text" name="last_name" id="last_name"  value="<?=$last_name?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>Company</td>
                                 <td>
                                    <input type="text" name="company" id="company"  value="<?=$company?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>Address</td>
                                 <td>
                                    <input type="text" name="address" id="address"  value="<?=$address?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>City</td>
                                 <td>
                                    <input type="text" name="city" id="city"  value="<?=$city?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>State</td>
                                 <td>
                                    <input type="text" name="state" id="state"  value="<?=$state?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                 <td>Zip</td>
                                 <td>
                                    <input type="text" name="zip" id="zip"  value="<?=$zip?>" class="form-control">
                                 </td>
                             </tr>
                             <tr>
                                     <td>Country</td>
                                     <td><?php
                                            $info['table']    = "country";
                                            $info['fields']   = array("*");   	   
                                            $info['where']    =  "1=1 ORDER BY id DESC";
                                            $rescountry  =  $db->select($info);
                                        ?>
                                        <select  name="country_id" id="country_id"   class="form-control">
                                            <option value="">--Select--</option>
                                            <?php
                                               foreach($rescountry as $key=>$each)
                                               { 
                                            ?>
                                              <option value="<?=$rescountry[$key]['id']?>" <?php if($rescountry[$key]['id']==$country_id){ echo "selected"; }?>><?=$rescountry[$key]['country']?></option>
                                            <?php
                                             }
                                            ?> 
                                        </select>
                                    </td>
                              </tr>
                             <tr>
                                 <td>User Type</td>
                                 <td><?php
                                        $enumusers = getEnumFieldValues('users','user_type');
                                    ?>
                                    <select  name="user_type" id="user_type"   class="form-control">
                                    <?php
                                       foreach($enumusers as $key=>$value)
                                       { 
                                    ?>
                                      <option value="<?=$value?>" <?php if($value==$user_type){ echo "selected"; }?>><?=$value?></option>
                                     <?php
                                      }
                                    ?> 
                                    </select>
                                 </td>
                          </tr>
                          <tr>
                                 <td>Status</td>
                                 <td><?php
                                        $enumusers = getEnumFieldValues('users','status');
                                    ?>
                                    <select  name="status" id="status"   class="form-control">
                                    <?php
                                       foreach($enumusers as $key=>$value)
                                       { 
                                    ?>
                                      <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
                                     <?php
                                      }
                                    ?> 
                                    </select>
                                </td>
                             </tr>
                             <tr> 
                                 <td align="right"></td>
                                 <td>
                                    <input type="hidden" name="cmd" value="add">
                                    <input type="hidden" name="id" value="<?=$Id?>">			
                                    <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn btn-primary">
                                 </td>     
                             </tr>
                            </table>
                            
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

