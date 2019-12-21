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
                      $hash    =  getTableFieldsName("fb_post");
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
  <a href="post.php"   class="btn btn-primary"><i class="fas fa-plus"></i>Post</a> <br><br>
                 
  <a href="index.php?cmd=edit"   class="btn btn-primary"><i class="fas fa-plus"></i> Add a FB post</a> <br><br>
    
				
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
                <table class="table table-bordered table-striped mb-0" id="datatable-default">
                    <tbody>
							<tr bgcolor="#ABCAE0">
                                <!--<td>Users</td>-->
                                <td>Message</td>
                                <td>Title</td>
                                <td>Link</td>
                                <td>Description</td>
                                <td>Picture</td>
                                <td>Last Post Date Time</td>
                                <td>Is Posted</td>                                
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
								  
								  $whrstr .= " AND users_id='".$_SESSION['users_id']."'";
						 
								$rowsPerPage = 10;
								$pageNum = 1;
								if(isset($_REQUEST['page']))
								{
									$pageNum = $_REQUEST['page'];
								}
								$offset = ($pageNum - 1) * $rowsPerPage;  
						 
						 
											  
								$info["table"] = "fb_post";
								$info["fields"] = array("fb_post.*"); 
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
							<tr>
							  <!--<td>
		                            <?php
									    unset($info2);        
										$info2['table']    = users;	
										$info2['fields']   = array("name");	   	   
										$info2['where']    =  "1 AND id='".$arr[$i]['users_id']."' LIMIT 0,1";
										$res2  =  $db->select($info2);
										echo $res2[0]['name'];	
					                ?>
							   </td>-->
                              <td><?=$arr[$i]['message']?></td>
                              <td><?=$arr[$i]['title']?></td>
                              <td><?=$arr[$i]['link']?></td>
                              <td><?=$arr[$i]['description']?></td>
                              <td><?=$arr[$i]['picture']?></td>
                              <td><?=$arr[$i]['last_post_date_time']?></td>
                              <td><?=$arr[$i]['is_posted']?></td>
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
						   <td colspan="10" align="center">
							  <?php              
									  unset($info);
					
									   $info["table"] = "fb_post";
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











