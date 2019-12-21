<?php
 include("../template/header.php");
?>
<style>          
 #navlist li
	{
		float:left;
		display: inline;
		list-style-type: none;
		padding-right: 20px;
	}
</style>
 
 <form name="search_frm" id="search_frm" method="post">
    <div class="portlet-body">
     <div class="table-responsive">	
        <table align="right">
              <TR>
                <TD  nowrap="nowrap">
                  <?php
                      $hash    =  getTableFieldsName("products");
                      $hash    = array_diff($hash,array("id"));
                  ?>
                  <select   name="field_name" id="field_name"  class="form-control">
                    <option value="">--Select--</option>
                    <?php
                    foreach($hash as $key=>$value)
                    {
                    ?>
                    <option value="<?=$key?>" <?php if($_SESSION['field_name']==$key) echo "selected"; ?>><?=str_replace("_"," ",$value)?></option>
                    <?php
                    }
                  ?>
                  </select>
                </TD>
                <TD  nowrap="nowrap" align="right">
                   <input type="text"    name="field_value" id="field_value" value="<?=$_SESSION["field_value"]?>" class="form-control"></TD>
                <td nowrap="nowrap" align="right">
                  <input type="hidden" name="cmd" id="cmd" value="search_users" >
                  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="btn btn-primary" />
                </td>
              </TR>
            </table>
    </div>
    </div>
  </form>
                   
<a href="index.php?cmd=edit"   class="btn btn-primary"><i class="fas fa-plus"></i> Add a <?=ucwords(str_replace("_"," ","product"))?></a> <br><br>
                   
                   
				
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
                <table class="table table-bordered table-striped mb-0" id="datatable-default">
                    <tbody>
							<tr bgcolor="#ABCAE0">
							  <td>Category</td>
                              <!--<td>Parent Category Txt</td>
                              <td>Category Txt</td>-->
                              <td>Product Name</td>
                              <td>Product Title</td>
                              <td>Picture</td>
                              <td>More Images</td>
                              <td>Brand</td>
                              <td>Model</td>
                              <td>Sku</td>
                              <!--<td>Gender For</td>-->
                              <td>Product display position</td>
                              <!--<td>Created At</td>
                              <td>Updated At</td>-->
                              <td>Status</td>
			                  <td>Edit</td>
                              <td>Delete</td>
							</tr>
						 <?php
								
								if($_SESSION["search"]=="yes")
								  {
									$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
								  }
								  else
								  {
									$whrstr = "";
								  }
						 
								$rowsPerPage = 10;
								$pageNum = 1;
								if(isset($_REQUEST['page']))
								{
									$pageNum = $_REQUEST['page'];
								}
								$offset = ($pageNum - 1) * $rowsPerPage;  
						 
						 
											  
								$info["table"] = "products";
								$info["fields"] = array("products.*"); 
								$info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT $offset, $rowsPerPage";
													
								
								$arr =  $db->select($info);
								
								for($i=0;$i<count($arr);$i++)
								{
								
								   $rowColor;
						
									if($i % 2 == 0)
									{
										
										$row="#C8C8C8";
									}
									else
									{
										
										$row="#FFFFFF";
									}
								
						 ?>
							<tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">
							  <td>
		                            <?php
									    unset($info2);        
										$info2['table']    = "category";	
										$info2['fields']   = array("cat_name");	   	   
										$info2['where']    =  "1 AND id='".$arr[$i]['category_id']."' LIMIT 0,1";
										$res2  =  $db->select($info2);
										echo $res2[0]['cat_name'];	
					                ?>
							   </td>
                              <!--<td><?=$arr[$i]['parent_category_txt']?></td>
                              <td><?=$arr[$i]['category_txt']?></td>-->
                              <td><?=$arr[$i]['product_name']?></td>
                              <td><?=$arr[$i]['product_title']?></td>
                              <td><img src="../../<?=$arr[$i]['file_products']?>" style="width:100px;height:100px"></td>
                              <td>
                                  <!-- Add jQuery library -->
                                <script type="text/javascript" src="../../fancybox/lib/jquery-1.8.2.min.js"></script>	
                                <!-- Add mousewheel plugin (this is optional) -->
                                <script type="text/javascript" src="../../fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>	
                                <!-- Add fancyBox main JS and CSS files -->
                                <script type="text/javascript" src="../../fancybox/source/jquery.fancybox.js?v=2.1.3"></script>
                                <link rel="stylesheet" type="text/css" href="../../fancybox/source/jquery.fancybox.css?v=2.1.2" media="screen" />	
                                <!-- Add Button helper (this is optional) -->
                                <link rel="stylesheet" type="text/css" href="../../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
                                <script type="text/javascript" src="../../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>	
                                <!-- Add Thumbnail helper (this is optional) -->
                                <link rel="stylesheet" type="text/css" href="../../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
                                <script type="text/javascript" src="../../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>	
                                <!-- Add Media helper (this is optional) -->
                                <script type="text/javascript" src="../../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
                 
                                                             
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            /*
                                             *  Simple image gallery. Uses default settings
                                             */
                                
                                            $('.fancybox_<?=$i?>').fancybox();
                                        });
                                    </script>
                                    <style type="text/css">
                                        .fancybox-custom .fancybox-skin {
                                            box-shadow: 0 0 50px #222;
                                        }
                                    </style>
                
                                 <?php
                                        $info["table"] = "products_images";
                                        $info["fields"] = array("products_images.*"); 
                                        $info["where"]   = "1  AND  products_id='".$arr[$i]['id']."' ORDER BY order_no ASC";
                                        $arr2 =  $db->select($info);
                              ?>             
                               <p>
                                 <?php
                                   for($j=0;$j<count($arr2);$j++) 
                                   {
                                 ?>  
                                     <a class="fancybox_<?=$i?>" href="../../<?=$arr2[$j]['file_name']?>" data-fancybox-group="gallery" title="<?=$arr2[$j]['order_no']?>">  
                                       <img src="../../<?=$arr2[$j]['file_name']?>" style="width:50px;height:50px;">
                                    </a> 
                                    <a href="index.php?cmd=delete_more&id=<?=$arr2[$j]['id']?>"   onClick=" return confirm('Are you sure to delete this item ?');">Delete</a>
                                 <?php
                                  }
                                 ?>
                               </p> 
                              </td>
                              <td><?=$arr[$i]['brand']?></td>
                              <td><?=$arr[$i]['model']?></td>
                              <td><?=$arr[$i]['sticker']?></td>
                              <!--<td><?=$arr[$i]['gender_for']?></td>-->
                              <td><?=$arr[$i]['product_display_position']?></td>
                              <!--<td><?=$arr[$i]['created_at']?></td>
                              <td><?=$arr[$i]['updated_at']?></td>-->
                              <td><?=$arr[$i]['status']?></td>
			                  <td>
                                  <a href="index.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                              </td>
                              <td>    
								  <a href="index.php?cmd=delete&id=<?=$arr[$i]['id']?>" class="on-default remove-row"   onClick=" return confirm('Are you sure to delete this item ?');"><i class="far fa-trash-alt"></i></a>
							 </td>
						
							</tr>
						<?php
								  }
						?>
						
						<tr>
						   <td colspan="14" align="center">
							  <?php              
									  unset($info);
					
									   $info["table"] = "products";
									   $info["fields"] = array("count(*) as total_rows"); 
									   $info["where"]   = "1  $whrstr ORDER BY id DESC";
									  
									   $res  = $db->select($info);  
					
												
										$numrows = $res[0]['total_rows'];
										$maxPage = ceil($numrows/$rowsPerPage);
										$self = 'index.php?cmd=list';
										$nav  = '';
										
										$start    = ceil($pageNum/5)*5-5+1;
										$end      = ceil($pageNum/5)*5;
										
										if($maxPage<$end)
										{
										  $end  = $maxPage;
										}
										
										for($page = $start; $page <= $end; $page++)
										//for($page = 1; $page <= $maxPage; $page++)
										{
											if ($page == $pageNum)
											{
												$nav .= "<li>$page</li>"; 
											}
											else
											{
												$nav .= "<li><a href=\"$self&&page=$page\" class=\"nav\">$page</a></li>";
											} 
										}
										if ($pageNum > 1)
										{
											$page  = $pageNum - 1;
											$prev  = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Prev]</a></li>";
									
										   $first = "<li><a href=\"$self&&page=1\" class=\"nav\">[First Page]</a></li>";
										} 
										else
										{
											$prev  = '<li>&nbsp;</li>'; 
											$first = '<li>&nbsp;</li>'; 
										}
									
										if ($pageNum < $maxPage)
										{
											$page = $pageNum + 1;
											$next = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Next]</a></li>";
									
											$last = "<li><a href=\"$self&&page=$maxPage\" class=\"nav\">[Last Page]</a></li>";
										} 
										else
										{
											$next = '<li>&nbsp;</li>'; 
											$last = '<li>&nbsp;</li>'; 
										}
										
										if($numrows>1)
										{
										  echo '<ul id="navlist">';
										   echo $first . $prev . $nav . $next . $last;
										  echo '</ul>';
										}
									?>     
						   </td>
						</tr>
                        </tbody>
						</table>
		 </div>
        </section>
    </div>
</div>			
				
<?php
include("../template/footer.php");
?>









