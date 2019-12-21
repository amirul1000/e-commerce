<?php
 include("../template/header.php");
?>
<script language="javascript" src="referrals.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<a href="index.php?cmd=list" class="btn  btn-primary"><i class="fa fa-arrow-circle-left"></i>  List</a> <br><br>
<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Referrals</h2>
            </header>
            <div class="card-body">              

								 <form name="frm_products" id="frm_products" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
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
                                                <select  name="affiliate_users_id" id="affiliate_users_id"   class="form-control">
                                                    <option value="">--Select--</option>
                                                    <?php
                                                       foreach($resusers as $key=>$each)
                                                       { 
                                                    ?>
                                                      <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$affiliate_users_id){ echo "selected"; }?>><?=$resusers[$key]['email']?></option>
                                                    <?php
                                                     }
                                                    ?> 
                                                </select>
                                                </td>
                                      </tr>
                                      <tr>
                                             <td>Buyer Users</td>
                                             <td><?php
                                                $info['table']    = "users";
                                                $info['fields']   = array("*");   	   
                                                $info['where']    =  "1=1 ORDER BY id DESC";
                                                $resusers  =  $db->select($info);
                                            ?>
                                            <select  name="buyer_users_id" id="buyer_users_id"   class="form-control">
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
                                      </tr>
                                      <tr>
                                             <td>Products</td>
                                             <td>
                                                     <?php
                                                        $info['table']    = "products";
                                                        $info['fields']   = array("*");   	   
                                                        $info['where']    =  "1=1 ORDER BY id DESC";
                                                        $resproducts  =  $db->select($info);
                                                    ?>
                                                    <select  name="products_id" id="products_id"   class="form-control">
                                                        <option value="">--Select--</option>
                                                        <?php
                                                           foreach($resproducts as $key=>$each)
                                                           { 
                                                        ?>
                                                          <option value="<?=$resproducts[$key]['id']?>" <?php if($resproducts[$key]['id']==$products_id){ echo "selected"; }?>><?=$resproducts[$key]['product_name']?></option>
                                                        <?php
                                                         }
                                                        ?> 
                                                    </select>
                                            </td>
                                                      </tr><tr>
                                                         <td>Commission</td>
                                                         <td>
                                                            <input type="text" name="commission" id="commission"  value="<?=$commission?>" class="form-control">
                                                         </td>
                                                     </tr><tr>
                                                         <td>Date Created</td>
                                                         <td>
                                                            <input type="text" name="date_created" id="date_created"  value="<?=$date_created?>" class="datepicker form-control">
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

