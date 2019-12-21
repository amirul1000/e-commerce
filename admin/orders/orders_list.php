<?php
   include("../template/header.php");
?>
    <style>
		.rcorner{
		  border-radius: 25px;
		  border: 2px solid #73AD21;
		  padding: 20px; 
		}
   </style>
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
                  $hash    =  getTableFieldsName("orders");
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
<div class="row">
    <div class="col">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Orders</h2>
            </header>
            <div class="card-body">
                       <?php
					    $rowsPerPage = 10;
						$pageNum = 1;
						if(isset($_REQUEST['page']))
						{
							$pageNum = $_REQUEST['page'];
						}
						$offset = ($pageNum - 1) * $rowsPerPage;
									  
						$info["table"] = "orders";
						$info["fields"] = array("orders.*"); 
						$info["where"]   = "1  ORDER BY  FIELD(delivery_status, 'pending','completed','return'),id  DESC  LIMIT $offset, $rowsPerPage";
						$arr =  $db->select($info);
						
						if(count($arr)>0)
						{
					 ?>
				       <table class="table table-bordered table-striped mb-0" id="datatable-default">
                         <tr bgcolor="#ABCAE0">
                              <td>Users</td>
                              <td>Shipping Address </td>
                              <td>Billing Information </td>
                              <td>Items</td>
                              <td>Shipping Cost</td>
                              <td>Total Amount</td>
                              <td>Date Created</td>
                              <td>Delivery Status</td>
                              <th>Edit</th>
                              <th>Delete</th>
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
                                              
                                $info["table"] = "orders";
                                $info["fields"] = array("orders.*"); 
                                $info["where"]   = "1   $whrstr ORDER BY  FIELD(delivery_status, 'pending','completed','return'),id  DESC  LIMIT $offset, $rowsPerPage";
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
                            <tr bgcolor="<?=$row?>">
                              <td valign="top">
                                    <?php
                                          unset($info2);        
                                        $info2['table']    = "users";	
                                        $info2['fields']   = array("users.*");	   	   
                                        $info2['where']    =  "1 AND id='".$arr[$i]['users_id']."' LIMIT 0,1";
                                        $res2  =  $db->select($info2);
                                        echo $res2[0]['email'].'<br>';	
                                        echo $res2[0]['first_name'].' '.$res2[0]['last_name'];	
                                    ?>
                               </td>
                              <td valign="top">
                                    <?php
                                            unset($info2);        
                                        $info2["table"] = "shipping_address";
                                        $info2["fields"] = array("shipping_address.*"); 
                                        $info2["where"]   = "1  AND id='".$arr[$i]['shipping_address_id']."' LIMIT 0,1";
                                        $res2 =  $db->select($info2);
                                    ?>
                                    <table width="100%" class="rcorner">  
                                        <tr><td>First name</td><td><?=$res2[0]['ship_first_name']?></td></tr>
                                        <tr><td>Last name</td><td><?=$res2[0]['ship_last_name']?></td></tr>
                                        <tr><td>Adress1</td><td><?=$res2[0]['ship_adress1']?></td></tr>
                                        <tr><td>Adress2</td><td><?=$res2[0]['ship_adress2']?></td></tr>
                                        <tr><td>Zip code</td><td><?=$res2[0]['ship_zip_code']?></td></tr>
                                        <tr><td>City</td><td><?=$res2[0]['ship_city']?></td></tr>
                                        <tr><td>State</td><td><?=$res2[0]['ship_state']?></td></tr>
                                        <tr><td>Country</td><td><?=$res2[0]['ship_country']?></td></tr>
                                        <tr><td>Cell Phone</td><td><?=$res2[0]['ship_contact_phone']?></td></tr>
                                  </table>  
                               </td>
                              <td valign="top">
                                  <?php
                                          unset($info2);        
                                        $info2["table"] = "billing_information";
                                        $info2["fields"] = array("billing_information.*"); 
                                        $info2["where"]   = "1  AND id='".$arr[$i]['billing_information_id']."' LIMIT 0,1";
                                        $res2 =  $db->select($info2);
                                  ?>
                                  <table width="100%" class="rcorner">  
                                      <tr><td>First name</td><td><?=$res2[0]['first_name']?></td></tr>
                                      <tr><td>Last name</td><td><?=$res2[0]['last_name']?></td></tr>
                                      <tr><td>Country</td><td><?=$res2[0]['country']?></td></tr>
                                      <tr><td>Adress1</td><td><?=$res2[0]['adress1']?></td></tr>
                                      <tr><td>Adress2</td><td><?=$res2[0]['adress2']?></td></tr>
                                      <tr><td>City</td><td><?=$res2[0]['city']?></td></tr>
                                      <tr><td>State</td><td><?=$res2[0]['state']?></td></tr>
                                      <tr><td>Zip code</td><td><?=$res2[0]['zip_code']?></td></tr>
                                      <tr><td>Cell Phone</td><td><?=$res2[0]['contact_phone']?></td></tr>
                                  </table>  
                              </td>
                              <td valign="top">
                                  <!--Item-->
                                       <table cellspacing="1" cellpadding="3" border="0" width="100%" class="table rcorner">
                                        <tr bgcolor="#ABCAE0">
                                          <td>Os0</td>
                                          <td>Item Name</td>
                                          <td>Item Number</td>
                                          <td>Quantity</td>
                                          <td>Amuont</td>
                                        </tr>
                                       <?php
                                              unset($info2);
                                            $info2["table"] = "items";
                                            $info2["fields"] = array("items.*"); 
                                            $info2["where"]   = "1    AND orders_id='".$arr[$i]['id']."' ORDER BY id ASC";
                                            $res2 =  $db->select($info2);                        
                                            for($j=0;$j<count($res2);$j++)
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
                                        <tr bgcolor="<?=$row?>">
                                         <td>
                                          <div style="width:100px;">
                                          <img src="../../<?=getImage($db,$res2[$j]['products_id'])?>" style="width:50px;height:50px;float:left;" />
                                           <?=$res2[$j]['os0']?>
                                          </div>
                                         </td>
                                          <td><?=$res2[$j]['item_name']?></td>
                                          <td><?=$res2[$j]['item_number']?></td>
                                          <td><?=$res2[$j]['quantity']?></td>
                                          <td><?=$res2[$j]['currency']?> <?=$res2[$j]['amount']?></td>
                                        </tr>
                                    <?php
                                              }
                                    ?>
                                    </table>
                                  <!--Item/-->
                              </td>
                              <td valign="top"><?=$arr[$i]['currency']?> <?=$arr[$i]['shipping_cost']?></td>
                              <td valign="top"><?=$arr[$i]['currency']?> <?=$arr[$i]['total_amount']?></td>
                              <td valign="top"><?=date("D F Y-m-d g:i a",strtotime($arr[$i]['date_created']))?></td>
                              <td valign="top">
                                   <form action="" method="post">
                                      <select name="delivery_status">
                                        <option value="escrow" <?php if($arr[$i]['delivery_status']=="escrow") { echo "selected";}?>>escrow</option>
                                        <option value="pending" <?php if($arr[$i]['delivery_status']=="pending") { echo "selected";}?>>pending</option>
                                        <option value="completed" <?php if($arr[$i]['delivery_status']=="completed") { echo "selected";}?>>completed</option>
                                        <option value="return" <?php if($arr[$i]['delivery_status']=="return") { echo "selected";}?>>return</option>
                                      </select>
                                      <br />
                                      <input type="hidden" name="cmd" value="change_delivery_status"/>
                                      <input type="hidden" name="id" value="<?=$arr[$i]['id']?>" />
                                      <input type="submit" value="submit" />
                                  </form>
                              </td>			  
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
					
									   $info["table"] = "orders";
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
						</table>
	                  <?php
                       }
                       else
					   {
				       ?>
                       <h6>Orders is empty</h6>
                       <?php	
					   }
                       ?>
                       
         </div>
        </section>
    </div>
</div>			               
<?php
   include("../template/footer.php");
?>   