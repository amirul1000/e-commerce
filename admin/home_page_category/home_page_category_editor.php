<?php
 include("../template/header.php");
?>
<script language="javascript" src="home_page_category.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>


<script language="javascript">
	var arrLevel = new Array();
	var selected = new Array();
	function fillUpNextLevel(vg_id,level)
	{ 
	   if(vg_id>0)
	   {
			level = level+1;   	
			$("#spinner").html('<img src="../../images/indicator.gif" alt="Wait" />');
			$.ajax({  
			  url: '../../lib_cat/ajax.category.php?cmd=get_level_data&category_id='+vg_id+'&level='+level,
			  success: function(data) {
						if(data!=0)
						{    
							//arrLevel[level-2] = level-1;
							$("#next_level_"+level).html(data);
						}	
						$("#spinner").html('');
				  },
			  error: function(){
								$("#spinner").html('');
								}
				});
	   }		
	}
													         
</script>

<a href="index.php?cmd=list" class="btn  btn-primary"><i class="fa fa-arrow-circle-left"></i>  List</a> <br><br>
<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Home page category</h2>
            </header>
            <div class="card-body">              

								 <form name="frm_products" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
                                             <td>Category</td>
                                             <td>
											    <?php
													if(empty($Id) || empty($parent_category_txt))
													{
												 ?>
												 
												   <div id="spinner"></div>
													  <?php
															unset($info);		  
														 $info["table"] = "category";
														 $info["fields"] = array("category.*"); 
														 $info["where"]   = "1   AND parent_category_id='0' ORDER BY cat_name ASC";
														 $arr =  $db->select($info);					
														?>
														<select  name="category_id_1" id="category_id_1"   class="form-control" onchange="fillUpNextLevel(this.value,1);">
															<option value="">--Select--</option>
															<?php
															   for($i=0;$i<count($arr);$i++)							
															   { 
															?>
															  <option value="<?=$arr[$i]['id']?>" <?php if($arr[$i]['id']==$parent_category_id){ echo "selected"; }?>><?=$arr[$i]['cat_name']?></option>
															<?php
															   }
															?> 
														</select>                                
													<div id="id_div">
															 <div id="next_level_2">
															 </div>
													</div>
													<?php
													}
													else
													{
													?>
														 <div id="spinner"></div>
														  <?php
															$arr_cat = explode(";",$parent_category_txt);
															
															foreach($arr_cat as $key=>$cat_name)
															{
																$level = $key+1;
			
																 unset($info);
																 unset($data);
																$info["table"] = "category";
																$info["fields"] = array("category.*"); 
																if($level==1)
																{
																   $info["where"]   = "1   AND parent_category_id='0' ORDER BY cat_name ASC";	
																}
																else
																{
																	$info["where"]   = "1 AND parent_category_id='".$parent_category_id."'   ORDER BY cat_name ASC";
																}
																
																$arr =  $db->select($info);
																			
																if($level==2)
																{
																	echo '<div id="id_div">';
																}
																$options = "";
																for($i=0;$i<count($arr);$i++)
																	{
																	  $selected = ""; 	
																	  if($arr[$i]["cat_name"]==$cat_name)
																	  {
																		  $parent_category_id =  $arr[$i]["id"];
																		  $selected = 'selected="selected"';
																	  }
																		
																	  $options .= '<option value="'.$arr[$i]["id"].'" '.$selected.'>'.$arr[$i]["cat_name"].'</option>';
																	}
																	if(count($arr)>0)
																	{
																			
																			if($level>1)
																			{		
																				echo '<div id="next_level_'.$level.'">';
																			}
																		
																			//echo json_encode($arr);	
																			$str = '<select  name="category_id_'.$level.'" id="category_id_'.$level.'"  class="form-control" onchange="fillUpNextLevel(this.value,'.$level.');" required>
																					  <option value="">--Select--</option>
																					  '.$options.'
																					</select>';
																			if($level>1)
																			{		
																				$level2 = $level + 1;
																				$str .= '<div id="next_level_'.$level2.'"></div>';
																			}
																			echo $str;
																	}
															}
															
															foreach($arr_cat as $key=>$cat_name)
															{
															   if($key>1)
																{
																	echo '</div>';
																}
															}
															
															
															echo '</div>';
																
															?>
													<?php
													}
													?></td>
                                          </tr>
                                          <tr>
                                                 <td>Display Position</td>
                                                 <td><?php
													$enumhome_page_category = getEnumFieldValues('home_page_category','display_position');
												?>
												<select  name="display_position" id="display_position"   class="form-control">
												<?php
												   foreach($enumhome_page_category as $key=>$value)
												   { 
												?>
												  <option value="<?=$value?>" <?php if($value==$display_position){ echo "selected"; }?>><?=$value?></option>
												 <?php
												  }
												?> 
												</select>
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
                                                 <td>
												 <?php
                                                    $enumhome_page_category = getEnumFieldValues('home_page_category','status');
                                                ?>
                                                <select  name="status" id="status"   class="form-control">
                                                <?php
                                                   foreach($enumhome_page_category as $key=>$value)
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

