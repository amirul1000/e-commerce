<?php
 include("../template/header.php");
?>
<script language="javascript" src="slide.js"></script>
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

                <h2 class="card-title">Slide</h2>
            </header>
            <div class="card-body">              

								 <form name="frm_products" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>							 
                                             <td>File Picture</td>
                                             <td><input type="file" name="file_picture" id="file_picture"  value="<?=$file_picture?>" class="form-control-static">
                                             </td>
                                         </tr>
                                         <tr>
                                                 <td>Products</td>
                                                 <td><?php
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
                                                          <option value="<?=$resproducts[$key]['id']?>" <?php if($resproducts[$key]['id']==$products_id){ echo "selected"; }?>>id:<?=$resproducts[$key]['id']?> <?=$resproducts[$key]['brand']?> <?=$resproducts[$key]['title']?> <?=$resproducts[$key]['name']?></option>
                                                        <?php
                                                         }
                                                        ?> 
                                                    </select>
                                                    </td>
                                          </tr>
                                          <tr>
                                             <td>Status</td>
                                             <td><?php
                                                        $enumslide = getEnumFieldValues('slide','status');
                                                    ?>
                                                    <select  name="status" id="status"   class="form-control">
                                                    <?php
                                                       foreach($enumslide as $key=>$value)
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
												<input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn  btn-primary">
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
        </section>
    </div>
</div>				
<?php
 include("../template/footer.php");
?>

