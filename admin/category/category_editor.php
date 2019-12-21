<?php
 include("../template/header.php");
?>
<script language="javascript" src="category.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">


 <a href="index.php?cmd=list" class="btn  btn-primary"><i class="fa fa-arrow-circle-left"></i> List</a> <br><br>
 <div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Category</h2>
            </header>
            <div class="card-body">                
				<form name="frm_category" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								
									 <table  class="table table-bordered table-striped mb-0" id="datatable-default">
										 <tr>
                                             <td>File Icon</td>
                                             <td><input type="file" name="file_icon" id="file_icon"  value="<?=$file_icon?>" class="textbox">
                                             </td>
                                         </tr>
                                         <tr>
											 <td>Parent Category</td>
											 <td>
											  <?php
													$info['table']    = "category";
													$info['fields']   = array("*");   	   
													$info['where']    =  "1=1 ORDER BY id DESC";
													$rescategory  =  $db->select($info);
												?>
												<select  name="parent_category_id" id="parent_category_id"   class="form-control">
													<option value="">--Select--</option>
													<?php
													   foreach($rescategory as $key=>$each)
													   { 
													?>
													  <!--<option value="<?=$rescategory[$key]['id']?>" <?php if($rescategory[$key]['id']==$parent_category_id){ echo "selected"; }?>><?=$rescategory[$key]['cat_name']?></option>-->
													  <option value="<?=$rescategory[$key]['id']?>" <?php if($rescategory[$key]['id']==$_REQUEST['parent_category_id']){ echo "selected"; }?>><?=$rescategory[$key]['cat_name']?></option>
													<?php
													 }
													?> 
												</select>
												</td>
									  </tr>
									  <tr>
										 <td>Cat Name</td>
										 <td>
										    <input type="text" name="cat_name" id="cat_name"  value="<?=$cat_name?>" class="form-control">
										 </td>
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
								
							</form>
           </div>
        </section>
    </div>
</div>					

<?php
 include("../template/footer.php");
?>

