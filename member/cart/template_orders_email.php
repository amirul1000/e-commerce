<?php
	  unset($info);
	$info["table"] = "orders";
	$info["fields"] = array("orders.*"); 
	$info["where"]   = "1 AND id='".$orders_id."'";
	$arr =  $db->select($info);
 ?>
   <table class="table">
	<tr bgcolor="#ABCAE0">	
	  <td>Order no</td>		
	  <td>transactionid</td>  
	  <td>Shipping Address </td>
	  <td>Billing Information </td>
	  <td>Items</td>
	  <td>Shipping Cost</td>
	  <td>Total Amount</td>
	  <td>Date Created</td>
	  <td>Delivery Status</td>
	</tr>
 <?php
		
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
	 <td valign="top"><?=$arr[$i]['order_number']?></td>
	 <td valign="top"><?=$arr[$i]['transactionid']?></td>
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
				  <img src="http://gokroy.com/<?=getImage($db,$res2[$j]['products_id'])?>" style="width:50px;height:50px;float:left;" />
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
	  </td>
	  <td valign="top"><?=$res2[0]['currency']?> <?=$arr[$i]['shipping_cost']?></td>
	  <td valign="top"><?=$res2[0]['currency']?> <?=$arr[$i]['total_amount']?></td>
	  <td valign="top"><?=date("D F d-m-Y g:i a",strtotime($arr[$i]['date_created']))?></td>
	  <td valign="top"><?=$arr[$i]['delivery_status']?></td>		
	</tr>
	<?php
       }
    ?>
                    
</table>
