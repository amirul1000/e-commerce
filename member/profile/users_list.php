<?php
 include("../template/header.php");
?>


  
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
                <table class="table table-bordered table-striped mb-0" id="datatable-default">
                    <tbody>
						 <?php
								
								if($_SESSION["search"]=="yes")
								  {
									$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
								  }
								  else
								  {
									$whrstr = "";
								  }
								$whrstr = " AND id='".$_SESSION["users_id"]."'";  
						 
								$rowsPerPage = 10;
								$pageNum = 1;
								if(isset($_REQUEST['page']))
								{
									$pageNum = $_REQUEST['page'];
								}
								$offset = ($pageNum - 1) * $rowsPerPage;  
						 
						 
											  
								$info["table"] = "users";
								$info["fields"] = array("users.*"); 
								$info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT $offset, $rowsPerPage";
													
								
								$arr =  $db->select($info);
								
								for($i=0;$i<count($arr);$i++)
								{
								
						 ?>
							  <tr><td>Email</td><td><?=$arr[$i]['email']?></td></tr>
                              <tr><td>Title</td><td><?=$arr[$i]['title']?></td></tr>
                              <tr><td>First Name</td><td><?=$arr[$i]['first_name']?></td></tr>
                              <tr><td>Last Name</td><td><?=$arr[$i]['last_name']?></td></tr>
                              <tr><td>Company</td><td><?=$arr[$i]['company']?></td></tr>
                              <tr><td>Address</td><td><?=$arr[$i]['address']?></td></tr>
                              <tr><td>City</td><td><?=$arr[$i]['city']?></td></tr>
                              <tr><td>State</td><td><?=$arr[$i]['state']?></td></tr>
                              <tr><td>Zip</td><td><?=$arr[$i]['zip']?></td></tr>
                              <tr><td>Country</td><td>
								<?php
                                    unset($info2);        
                                    $info2['table']    = "country";	
                                    $info2['fields']   = array("country");	   	   
                                    $info2['where']    =  "1 AND id='".$arr[$i]['country_id']."' LIMIT 0,1";
                                    $res2  =  $db->select($info2);
                                    echo $res2[0]['country'];	
                                ?>
							   </td></tr>
                              <tr><td>Created At</td><td><?=$arr[$i]['created_at']?></td></tr>
                              <tr><td>Updated At</td><td><?=$arr[$i]['updated_at']?></td></tr>
                              <tr><td>User Type</td><td><?=$arr[$i]['user_type']?></td></tr>
                              <tr><td>Status</td> <td><?=$arr[$i]['status']?></td></tr>
			  
							  <tr><td></td><td nowrap >
								  
                                  <a href="index.php?cmd=edit&id=<?=$arr[$i]['id']?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</a>
							 </td></tr>
						
							
						<?php
								  }
						?>
						
						
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
                        
 
<?php
include("../template/footer.php");
?>









