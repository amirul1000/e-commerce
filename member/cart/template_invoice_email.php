<?php
		  unset($info);
	$info["table"] = "orders";
	$info["fields"] = array("orders.*"); 
	$info["where"]   = "1 AND id='".$orders_id."'";
	$arr =  $db->select($info);
	
	  unset($info2);        
	$info2["table"] = "billing_information";
	$info2["fields"] = array("billing_information.*"); 
	$info2["where"]   = "1  AND id='".$arr[0]['billing_information_id']."' LIMIT 0,1";
	$resbi =  $db->select($info2);
	
		unset($info2);        
	$info2["table"] = "shipping_address";
	$info2["fields"] = array("shipping_address.*"); 
	$info2["where"]   = "1  AND id='".$arr[0]['shipping_address_id']."' LIMIT 0,1";
	$ressa =  $db->select($info2);
	
	    unset($info);
		unset($data);		  
	$info["table"] = "items";
	$info["fields"] = array("items.*"); 
	$info["where"]   = "1 AND id='".$orders_id."'";
	$arritems =  $db->select($info);
	    unset($info);
		unset($data);		  
	$info["table"] = "products";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1 AND id='".$arritems[0]['products_id']."'";
	$arrproduct =  $db->select($info);
	$arrcompany = get_company_info($db,$arrproduct[0]['company_id']);
 ?>

<table cellspacing="3" cellpadding="3" width="100%">
   <tr>
           <td>
           </td>
           <td> 
                <h2>Invoice</h2>
           </td>
           <td>
             <?=$arr[0]['invoice_number']?><br>
             <?=date("D F d-m-Y g:i a",strtotime($arr[0]['date_created']))?>
           </td>  
   </tr>
   <tr>
        <td colspan="3">
             Gokroy.com<br>
             E-commerce Solution<br>
        </td>
   </tr>
   <tr>
           <td valign="top">
               To:
               <table width="100%" class="rcorner">  
                  <tr><td>First name</td><td><?=$resbi[0]['first_name']?></td></tr>
                  <tr><td>Last name</td><td><?=$resbi[0]['last_name']?></td></tr>
                  <tr><td>Adress1</td><td><?=$resbi[0]['adress1']?></td></tr>
                  <tr><td>Adress2</td><td><?=$resbi[0]['adress2']?></td></tr>
                  <tr><td>City</td><td><?=$resbi[0]['city']?></td></tr>
                  <tr><td>State</td><td><?=$resbi[0]['state']?></td></tr>
                  <tr><td>Zip code</td><td><?=$resbi[0]['zip_code']?></td></tr>
                  <tr><td>Cell Phone</td><td><?=$resbi[0]['contact_phone']?></td></tr>
                  <tr><td>Country</td><td><?=$resbi[0]['country']?></td></tr>
              </table>    
           </td>
           <td valign="top"> 
              Shipping Address:
              <table width="100%" class="rcorner">  
				<tr><td>First name</td><td><?=$ressa[0]['ship_first_name']?></td></tr>
				<tr><td>Last name</td><td><?=$ressa[0]['ship_last_name']?></td></tr>
				<tr><td>Adress1</td><td><?=$ressa[0]['ship_adress1']?></td></tr>
				<tr><td>Adress2</td><td><?=$ressa[0]['ship_adress2']?></td></tr>
				<tr><td>Zip code</td><td><?=$ressa[0]['ship_zip_code']?></td></tr>
				<tr><td>City</td><td><?=$ressa[0]['ship_city']?></td></tr>
				<tr><td>State</td><td><?=$ressa[0]['ship_state']?></td></tr>
				<tr><td>Country</td><td><?=$ressa[0]['ship_country']?></td></tr>
				<tr><td>Cell Phone</td><td><?=$ressa[0]['ship_contact_phone']?></td></tr>
		      </table>   
           </td>
           <td valign="top">
               Vendor:
               <table width="100%" class="rcorner"> 
               <tr><td>Company name</td><td><?=$arrcompany[0]['company_name']?></td></tr>
               <tr><td>Business type</td><td><?=$arrcompany[0]['business_type']?></td></tr>
				<tr><td>Area</td><td><?=$arrcompany[0]['area']?></td></tr>
				<tr><td>Zip code</td><td><?=$arrcompany[0]['zip_code']?></td></tr>
				<tr><td>City</td><td><?=$arrcompany[0]['city_town']?></td></tr>
				<tr><td>State</td><td><?=$arrcompany[0]['state']?></td></tr>
                <tr><td>Address</td><td><?=$arrcompany[0]['address']?></td></tr>
				<tr><td>Country</td><td><?=$arrcompany[0]['country_txt']?></td></tr>
				<tr><td>Cell Phone</td><td><?=$arrcompany[0]['cell_phone']?></td></tr>
		      </table>   
           </td>  
   </tr>
   <tr>
        <td colspan="3">
              <table cellspacing="1" cellpadding="3" border="0" width="100%" class="table rcorner">
                    <tr bgcolor="#ABCAE0">
                      <td>Os0</td>
                      <td>Item Name</td>
                      <td>Item Number</td>
                      <td>Quantity</td>
                      <td>Amuont</td>
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
                          unset($info2);
                        $info2["table"] = "items";
                        $info2["fields"] = array("items.*"); 
                        $info2["where"]   = "1    AND orders_id='".$arr[$i]['id']."' ORDER BY id ASC";
                        $resitems =  $db->select($info2);                        
                        for($j=0;$j<count($resitems);$j++)
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
                      <img src="http://gokroy.com/<?=getImage($db,$resitems[$j]['products_id'])?>" style="width:50px;height:50px;float:left;" />
                       <?=$resitems[$j]['os0']?>
                      </div>
                     </td>
                      <td><?=$resitems[$j]['item_name']?></td>
                      <td><?=$resitems[$j]['item_number']?></td>
                      <td><?=$resitems[$j]['quantity']?></td>
                      <td><?=$resitems[$j]['currency']?> <?=$resitems[$j]['amount']?></td>
                    </tr>
                <?php
                          }				 
                ?>
                <tr>
                  <td valign="top" colspan="5" align="right"><?=$resitems[0]['currency']?> <?=$arr[$i]['shipping_cost']?></td>
                <tr>   
                </tr>
                  <td valign="top" colspan="5" align="right"><?=$resitems[0]['currency']?> <?=$arr[$i]['total_amount']?></td>
                <tr>   
                </tr>  
                </tr>
                <?php
				   }
				?>
                </table>
        </td>
   </tr>
</table>