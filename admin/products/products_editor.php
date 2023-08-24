<?php
 include("../template/header.php");
?>
<!--<script language="javascript" src="products.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>-->
<!--<link rel="stylesheet" href="../../datepicker/jquery-ui.css">
<script src="../../datepicker/jquery-1.10.2.js"></script>
<script src="../../datepicker/jquery-ui.js"></script>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


<script type="text/javascript" src="../../js/selectize.js"></script>
<link rel='stylesheet' href='../../css/selectize.css'>
<link rel='stylesheet' href='../../css/selectize.default.css'>


<style type="text/css">
    .selectize-input {
      width: 100% !important;
      height: 62px !important;
    }
</style>
<style>			
	/*progressbar*/
	#progressbar {
		margin-bottom: 30px;
		overflow: hidden;
		/*CSS counters to number the steps*/
		counter-reset: step;
	}
	#progressbar li {
		list-style-type: none;
		color: #333;
		text-transform: uppercase;
		text-align:center;
		font-size: 12px;
		width: 13%;
		float: left;
		position: relative;
	}
	#progressbar li:before {
		content: counter(step);
		counter-increment: step;
		width: 20px;
		line-height: 20px;
		display: block;
		font-size: 10px;
		color: #333;
		background: white;
		border-radius: 3px;
		margin: 0 auto 5px auto;
	}
	/*progressbar connectors*/
	#progressbar li:after {
		content: '';
		width: 100%;
		height: 2px;
		background: white;
		position: absolute;
		left: -50%;
		top: 9px;
		z-index: -1; /*put it behind the numbers*/
	}
	#progressbar li:first-child:after {
		/*connector not needed before the first step*/
		content: none; 
	}
	/*marking active/completed steps green*/
	/*The number of the step and the connector before it = green*/
	#progressbar li.active:before,  #progressbar li.active:after{
		background: #27AE60;
		color: white;
	}
</style>
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

                <h2 class="card-title">Products</h2>
            </header>
            <div class="card-body">              

								 <form name="frm_products" id="frm_products" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
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
                                          </tr><tr>
                                             <td>Product Name</td>
                                             <td>
                                                <input type="text" name="product_name" id="product_name"  value="<?=$product_name?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td>Product Title</td>
                                             <td>
                                                <input type="text" name="product_title" id="product_title"  value="<?=$product_title?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td>Brand</td>
                                             <td>
                                                <input type="text" name="brand" id="brand"  value="<?=$brand?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td>Model</td>
                                             <td>
                                                <input type="text" name="model" id="model"  value="<?=$model?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td>Sku</td>
                                             <td>
                                                <input type="text" name="sku" id="sku"  value="<?=$sku?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td valign="top">Description</td>
                                             <td>
                                                <textarea name="description" id="description"  class="form-control" style="width:100%;height:200px;"><?=$description?></textarea>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td width="20%">Product Condition</td>
                                             <td>
                                                <input type="text" name="product_condition" id="product_condition"  value="<?=$product_condition?>">
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#product_condition')
                                                                    .selectize({
                                                                            plugins: ['remove_button'],
                                                                            persist: false,
                                                                            create: true,
                                                                            maxItems: null,
                                                                            valueField: 'id',
                                                                            placeholder: 'Condition ...',
                                                                            labelField: 'title',
                                                                            searchField: 'title',
                                                                            maxItems: 1,
                                                                            options: [
                                                                                      
                                                                                         {id: 'New', title: 'New', url: ''},
                                                                                         {id: 'Used', title: 'Used', url: ''},
                                                                                         {id: 'Old', title: 'Old', url: ''},
                                                                                         {id: 'REPAIRED', title: 'REPAIRED', url: ''},
                                                                                      
                                                                                    ],
                                                                                    create: true
                                                                                });             
                                                    
                                                    
                                                    });
                                                    </script>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td width="20%">Sticker (Optional)</td>
                                             <td>
                                                <input type="text" name="sticker" id="sticker"  value="<?=$sticker?>">
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#sticker')
                                                                    .selectize({
                                                                            plugins: ['remove_button'],
                                                                            persist: false,
                                                                            create: true,
                                                                            maxItems: null,
                                                                            valueField: 'id',
                                                                            placeholder: 'Sticker ...',
                                                                            labelField: 'title',
                                                                            searchField: 'title',
                                                                            maxItems: 1,
                                                                            options: [
                                                                                         {id: '', title: 'none', url: ''},
                                                                                         {id: 'sale', title: 'sale', url: ''},
                                                                                         {id: 'new', title: 'new', url: ''}
                                                                                    ],
                                                                                    create: true
                                                                                });             
                                                    
                                                    
                                                    });
                                                    </script>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Gender For</td>
                                             <td>
                                                <input type="text" name="gender_for" id="gender_for"  value="<?=$gender_for?>">
                                                 <script>
                                                    $(document).ready(function() {
                                                        $('#gender_for')
                                                                    .selectize({
                                                                            plugins: ['remove_button'],
                                                                            persist: false,
                                                                            create: true,
                                                                            maxItems: null,
                                                                            valueField: 'id',
                                                                            placeholder: 'Gender ...',
                                                                            labelField: 'title',
                                                                            searchField: 'title',
                                                                            options: [
                                                                                      
                                                                                         {id: 'Everyone', title: 'Everyone', url: ''},
                                                                                         {id: 'Male', title: 'Male', url: ''},
                                                                                         {id: 'Female', title: 'Female', url: ''},
                                                                                         {id: 'Other', title: 'Other', url: ''},
                                                                                      
                                                                                    ],
                                                                                    create: true
                                                                                });             
                                                    
                                                    
                                                    });
                                                    </script>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Age For</td>
                                             <td>
                                                <input type="text" name="age_for" id="age_for"  value="<?=$age_for?>">
                                                 <script>
                                                    $(document).ready(function() {
                                                        $('#age_for')
                                                                    .selectize({
                                                                            plugins: ['remove_button'],
                                                                            persist: false,
                                                                            create: true,
                                                                            maxItems: null,
                                                                            valueField: 'id',
                                                                            placeholder: 'Age ...',
                                                                            labelField: 'title',
                                                                            searchField: 'title',
                                                                            options: [
                                                                                      
                                                                                         {id: 'Any', title: 'Any', url: ''},
                                                                                         {id: '3 -12 years old', title: '3 -12 years old', url: ''},
                                                                                         {id: '13+ and above', title: '13+ and above', url: ''},
                                                                                         {id: '18+', title: '18+', url: ''},
                                                                                         {id: '19+', title: '19+', url: ''},
                                                                                         {id: '21+', title: '21+', url: ''},
                                                                                         {id: '25-28 years old', title: '25-28 years old', url: ''},
                                                                                         {id: '29-35 years old', title: '29-35 years old', url: ''},
                                                                                         {id: '36-40 years old', title: '36-40 years old', url: ''},
                                                                                         {id: '41-50 years old', title: '41-50 years old', url: ''},
                                                                                         {id: '50-60 years old', title: '50-60 years old', url: ''},
                                                                                         {id: 'Senior Citizen (65+)', title: 'Senior Citizen (65+)', url: ''},
                                                                                      
                                                                                    ],
                                                                                    create: true
                                                                                });             
                                                    
                                                    
                                                    });
                                                    </script>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Occasions</td>
                                             <td>
                                                <input type="text" name="occasions" id="occasions"  value="<?=$occasions?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td>Material Used</td>
                                             <td>
                                                <input type="text" name="material_used" id="material_used"  value="<?=$material_used?>" class="form-control">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Size</td>
                                             <td>
                                                <input type="text" name="size" id="size"  value="<?=$size?>">
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#size')
                                                                    .selectize({
                                                                            plugins: ['remove_button'],
                                                                            persist: false,
                                                                            create: true,
                                                                            maxItems: null,
                                                                            valueField: 'id',
                                                                            placeholder: 'Size ...',
                                                                            labelField: 'title',
                                                                            searchField: 'title',
                                                                            options: [
                                                                                         {id: 'Any', title: 'Any', url: ''},
                                                                                         {id: 'Free Size', title: 'Free Size', url: ''},
                                                                                         {id: 'S', title: 'S', url: ''},
                                                                                         {id: 'M', title: 'M', url: ''},
                                                                                         {id: 'L', title: 'L', url: ''},
                                                                                         {id: 'XL', title: 'XL', url: ''},
                                                                                         {id: 'XXL', title: 'XXL', url: ''},
                                                                                         {id: 'XXXL', title: 'XXXL', url: ''},
                                                                                         
                                                                                      
                                                                                    ],
                                                                                    create: true
                                                                                });             
                                                    
                                                    
                                                 });
                                                 </script>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Color</td>
                                             <td>
                                                <input type="text" name="color" id="color"  value="<?=$color?>">
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#color')
                                                                    .selectize({
                                                                            plugins: ['remove_button'],
                                                                            persist: false,
                                                                            create: true,
                                                                            maxItems: null,
                                                                            valueField: 'id',
                                                                            placeholder: 'Color ...',
                                                                            labelField: 'title',
                                                                            searchField: 'title',
                                                                            options: [
                                                                                         {id: 'ALL Color', title: 'ALL Color', url: ''},
                                                                                         {id: 'Not Specific', title: 'Not Specific', url: ''},
                                                                                         {id: 'WHITE', title: 'WHITE', url: ''},
                                                                                         {id: 'BLACK', title: 'BLACK', url: ''},
                                                                                         {id: 'RED', title: 'RED', url: ''},
                                                                                         {id: 'BLUE', title: 'BLUE', url: ''},
                                                                                         {id: 'YELLOW', title: 'YELLOW', url: ''},
                                                                                         {id: 'GREEN', title: 'GREEN', url: ''}
                                                                                      
                                                                                    ],
                                                                                    create: true
                                                                                });             
                                                    
                                                    
                                                    });
                                                    </script>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Width X HeightX Length</td>
                                             <td>
                                                <input type="text" name="width" id="width"  value="<?=$width?>" class="form-control-static">X                                                 
                                                <input type="text" name="height" id="height"  value="<?=$height?>" class="form-control-static">X                                                
                                                <input type="text" name="length" id="length"  value="<?=$length?>" class="form-control-static">
                                                <select name="width_height_length_unit"  class="form-control-static">
                                                    <option value="">Select...</option>
                                                    <option value="Meter" selected="">Meter</option>
                                                    <option value="CMeter">CMeter</option>
                                                    <option value="Feet">Feet</option>
                                                </select>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Weight</td>
                                             <td>
                                                <input type="text" name="weight" id="weight"  value="<?=$weight?>" class="form-control-static">
                                                <select name="weight_unit"  class="form-control-static">
                                                    <option value="">Select...</option>
                                                    <option value="GRAM" selected="">GRAM</option>
                                                    <option value="CGRAM">CGRAM</option>
                                                    <option value="KG">KG</option>
                                                </select>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Price</td>
                                             <td>
                                                <input type="text" name="price" id="price"  value="<?=$price?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td>Discount</td>
                                             <td>
                                                <input type="text" name="discount" id="discount"  value="<?=$discount?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td>Net Price</td>
                                             <td>
                                                <input type="text" name="net_price" id="net_price"  value="<?=$net_price?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td>Currency</td>
                                             <td>
                                                <input type="text" name="currency" id="currency"  value="<?=$currency?>" class="form-control">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Affiliate commission</td>
                                             <td>
                                                <input type="text" name="affiliate_commission" id="affiliate_commission"  value="<?=$affiliate_commission?>" class="form-control">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>File Products</td>
                                             <td>
                                             <input type="file" name="file_products" id="file_products"  value="<?=$file_products?>" class="form-control">
                                             </td>
                                         </tr><tr>
                                             <td valign="top">Term Condition</td>
                                             <td>
                                                <textarea name="term_condition" id="term_condition"  class="form-control" style="width:100%;height:200px;"><?=$term_condition?></textarea>
                                             </td>
                                         </tr><tr>
                                             <td valign="top">Delivery Info</td>
                                             <td>
                                                <textarea name="delivery_info" id="delivery_info"  class="form-control" style="width:100%;height:200px;"><?=$delivery_info?></textarea>
                                             </td>
                                         </tr><tr>
                                             <td valign="top">Damage Return</td>
                                             <td>
                                                <textarea name="damage_return" id="damage_return"  class="form-control" style="width:100%;height:200px;"><?=$damage_return?></textarea>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Product display position</td>
                                             <td>
                                                <input type="text" name="product_display_position" id="product_display_position"  value="<?=$product_display_position?>">
                                                <script>
													$(document).ready(function() {
														$('#product_display_position')
																	.selectize({
																			plugins: ['remove_button'],
																			persist: false,
																			create: true,
																			maxItems: null,
																			valueField: 'id',
																			placeholder: 'Display position ...',
																			labelField: 'title',
																			searchField: 'title',
																			options: [
																					  
																						 {id: 'Featured', title: 'Featured', url: ''},
																						 {id: 'Bestsellers', title: 'Bestsellers', url: ''},
																						 {id: 'Specials', title: 'Specials', url: ''},
																						 {id: 'Latest', title: 'Latest', url: ''},
																					  
																					],
																					create: true
																				}); 
													});
                                                </script>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Status</td>
                                             <td><?php
                                                    $enumusers = getEnumFieldValues('products','status');
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
                                             <td colspan="2">
                                                       
                                             </td> 
                                         </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="id" value="<?=$Id?>">			
											 </td>     
										 </tr>
										</table>
										</div>
										</div>
								</form>
                                
                                 <table> 
                                    <tr>
                                     <td> 
                                        <h5>More Images</h5> <br>	    
                                    
                                             <?php
                                                       if(isset($Id)) {
                                                         $url = 'upload_more.php?id='.$Id;
                                                      }
                                                      else {
                                                        $url = 'upload_more.php';
                                                        }
                                                    ?>
                                             <!-- BEGIN PAGE CONTENT-->
                                                <div class="row">
                                                    <div class="col-md-12">							
                                                        <form action="<?=$url?>" class="dropzone" id="my-dropzone">
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- END PAGE CONTENT-->  
                                           <code> 
                                               [N.B. Supported file extension is pdf,png,jpg,jpeg. Example file.jpg]
                                           </code>          
                                     </td>
                                    </tr>
                                 </table>
                                <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="btn btn-primary">
                                <script language="javascript">
								 $(document).ready(function(){
									  $("#btn_submit").click(function() {
										  $("#frm_products").submit();
										});
								  });
								  
								  function checkRequired()
								  {
									  
								  }
								</script> 
                                
            
             </div>
        </section>
    </div>
</div>				 
                               
	            <link href="../../dropzone/css/dropzone.css" rel="stylesheet"/>			
                <script src="../../dropzone/dropzone.js"></script>                  
                <!--<script src="../../assets/admin/pages/scripts/form-dropzone.js"></script>-->
                <script type="text/javascript" >
                 var FormDropzone = function () {
                    return {
                        //main function to initiate the module
                        init: function () {  
                
                            Dropzone.options.myDropzone = {
                                init: function() {
                                    this.on("addedfile", function(file) {
                                        // Create the remove button
                                        var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-block'>Remove file</button>");
                                        
                                        // Capture the Dropzone instance as closure.
                                        var _this = this;
                
                                        // Listen to the click event
                                        removeButton.addEventListener("click", function(e) {
                                          // Make sure the button click doesn't submit the form:
                                          e.preventDefault();
                                          e.stopPropagation();
                
                                          // Remove the file preview.
                                          _this.removeFile(file);
                                          // If you want to the delete the file on the server as well,
                                          // you can do the AJAX request here.
                                          remove_file(file.name);
                                        });
                
                                        // Add the button to the file preview element.
                                        file.previewElement.appendChild(removeButton);
                                    });
                                }            
                            }
                        }
                    };
                }();
                
                function remove_file(file)
                {
                   $.ajax({
                        url: "index.php",
                        type: "POST",
                            data: { 
                                'cmd':'delete_dropzone_file',
                                'name': file
                            }
                        });
                }
                </script>
                <script>
                    $(document).ready(function() {  
                             FormDropzone.init();
                    });
                </script>
						 
  <script>
	/*$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '../../images/calendar.gif',
	});*/
</script>  			
<!-- end: page -->
</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="../#" class="mobile-close d-md-none">
							Collapse <i class="fas fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark"></div>
			
								<ul>
									<li>
										<time datetime="2017-04-19T00:00+00:00">04/19/2017</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="../img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="../img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="../img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="../img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>
		</section>

		<!-- Vendor -->
		<!--<script src="../vendor/jquery/jquery.js"></script>-->
		<script src="../vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../vendor/popper/umd/popper.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../vendor/common/common.js"></script>
		<script src="../vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="../vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="../vendor/jquery-appear/jquery.appear.js"></script>
		<script src="../vendor/owl.carousel/owl.carousel.js"></script>
		<script src="../vendor/isotope/isotope.js"></script>
        
        
        <!-- Specific Page Vendor -->
		<script src="../vendor/select2/js/select2.js"></script>
		<script src="../vendor/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="../vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
		<script src="../vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
        
		
		<!-- Theme Base, Components and Settings -->
		<script src="../js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../js/theme.init.js"></script>

		<!-- Examples -->
		<script src="../js/examples/examples.landing.dashboard.js"></script>
	</body>
</html>