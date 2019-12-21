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
                        
                     <script type="text/javascript">
                        function isNumberKey(evt, obj) {
                    
                            var charCode = (evt.which) ? evt.which : event.keyCode
                            var value = obj.value;
                            var dotcontains = value.indexOf(".") != -1;
                            if (dotcontains)
                                if (charCode == 46) return false;
                            if (charCode == 46) return true;
                            if (charCode > 31 && (charCode < 48 || charCode > 57))
                                return false;
                            return true;
                        }
                    </script>   

                      <h2 id="product-name">Cart</h2>
                         <font color="#FF0000">
                         <?php
                           if(isset($message))
                           {
                             echo $message;
                           }
                         ?>
                         </font>
                         <div class="table-responsive">
                          <table cellspacing="3" cellpadding="3" width="100%" class="table">
                                <tr bgcolor="#33CCFF">
                                    <td>Description</td>
                                     <td>Item name</td>
                                     <td>Item number</td>
                                     <td>Quantity</td>
                                     <td>Unit Price</td>
                                     <td>Amount</td>
                                </tr>
                                <?php
                                $count = count($_SESSION['cart']);
                                $total=0;
                                $total_shipping_charge = 0;
                                if($count==0)
                                {
                                echo "<tr><td colspan=6>No Items in the cart</td></tr>";
                                }
                                else
                                {
                                 for($i=0;$i<$count;$i++)
                                   {
                                   
                                   $subtotal = $_SESSION['cart'][$i]['amount']*$_SESSION['cart'][$i]['quantity'];
                                   $_SESSION['cart'][$i]['shipping_charge'] = 30.00;
								   $shipping_charge =  $_SESSION['cart'][$i]['shipping_charge']*$_SESSION['cart'][$i]['quantity'];
                                   
                                   $total = $total+$subtotal;
                                   $total_shipping_charge =  $total_shipping_charge + $shipping_charge;
                                   
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
                                        <div style="width:300px;">
                                         <img src="../../<?=getImage($db,$_SESSION['cart'][$i]['products_id'])?>" style="width:100px;height:100px;float:left;" />
                                         <?=$_SESSION['cart'][$i]['os0']?> 
                                        </div> 
                                     </td>
                                     <td valign="top"><?=$_SESSION['cart'][$i]['item_name']?></td>
                                     <td valign="top"><?=$_SESSION['cart'][$i]['item_number']?></td>
                                     <td valign="top" nowrap>
                                       <form action="" method="post">
                                         <input type="number" name="quantity" value="<?=$_SESSION['cart'][$i]['quantity']?>" onkeypress="return isNumberKey(event,this)" style="width:60px;">											
                                         <input type="hidden" name="item_number" value="<?=$_SESSION['cart'][$i]['item_number']?>">
                                         <input type="hidden" name="item_name" value="<?=$_SESSION['cart'][$i]['item_name']?>">
                                         <input type="submit" name="cmd" value="update"  class="btn btn-success">
                                         <input type="submit" name="cmd" value="remove"  class="btn btn-danger">
                                       </form> 
                                     </td>
                                     <td valign="top"><?=number_format($_SESSION['cart'][$i]['amount'], 2, '.', '')?></td>
                                     <td valign="top"><?=$_SESSION['cart'][$i]['currency']?> <?=number_format($subtotal, 2, '.', '')?></td>
                                </tr>
                                <?php					
                                }
								$transaction_fee = round(($total+$tax+$total_shipping_charge)*3/100, 2); 
                                $_SESSION['transaction_fee'] = $transaction_fee;
								?>
                                <tr bgcolor="#DDFFFF">
                                     <td valign="top"></td>
                                     <td valign="top"></td>										
                                     <td valign="top" colspan="3">Shipping Charge</td>
                                     <td valign="top"><?=$_SESSION['cart'][0]['currency']?> <?=number_format($total_shipping_charge, 2, '.', '')?></td>
                                </tr>
                                <tr bgcolor="#4AD8E4">
                                     <td valign="top"></td>
                                     <td valign="top"></td>										
                                     <td valign="top" colspan="3">Transaction Fee (Card processing fee)</td>
                                     <td valign="top"><?=$_SESSION['cart'][0]['currency']?> <?=number_format($transaction_fee, 2, '.', '')?></td>
                                </tr>
                                <tr bgcolor="#FFFEEEE">
                                     <td valign="top"></td>
                                     <td valign="top"></td>						
                                     <td valign="top" colspan="3">Total</td>
                                     <td valign="top">
                                     <?=$_SESSION['cart'][0]['currency']?> <?=number_format($total+$tax+$total_shipping_charge+$transaction_fee, 2, '.', '')?></td>
                                </tr>
                                <?php			
                                   $_SESSION['tax'] = $tax;
                                   $_SESSION['shipping_charge'] = $shipping_charge;		 
                                   $_SESSION['total'] = $total+$tax+$total_shipping_charge+$transaction_fee;		
                                }
                                ?>	  
                              </table>
                         </div>   
                             <?php
							   if($count>0)
                                {
							 ?> 
                             <div style="width:100%;"> 
                             <form action="" method="post">
                             <?php
                               if(isset($_SESSION['users_id']))
                                 {
                                    //get lastest order 
                                    unset($info);
                                    $info["table"] = "orders";
                                    $info["fields"] = array("orders.*"); 
                                    $info["where"]   = "1   AND users_id='".$_SESSION['users_id']."' ORDER BY id DESC LIMIT 0,1";
                                    $arr =  $db->select($info);
                                    //get shipping address
                                    unset($info2);        
                                    $info2["table"] = "shipping_address";
                                    $info2["fields"] = array("shipping_address.*"); 
                                    $info2["where"]   = "1  AND id='".$arr[0]['shipping_address_id']."' LIMIT 0,1";
                                    $res2 =  $db->select($info2);						
                                    if(empty($_REQUEST['ship_first_name']))
                                    {
                                      $ship_first_name = $res2[0]['ship_first_name'];
                                    }
									else
									{
										$ship_first_name = $_REQUEST['ship_first_name'];
									}
									
                                    if(empty($_REQUEST['ship_last_name']))
                                    {
                                      $ship_last_name = $res2[0]['ship_last_name'];
                                    }
									else
									{
									  $ship_last_name = $_REQUEST['ship_last_name'];	
									}
									
									
                                    if(empty($_REQUEST['ship_adress1']))
                                    {
                                       $ship_adress1  = $res2[0]['ship_adress1'];
                                    }
									else
									{
									  $ship_adress1 = $_REQUEST['ship_adress1'];	
									}
									
                                    if(empty($_REQUEST['ship_adress2']))
                                    {
                                      $ship_adress2 = $res2[0]['ship_adress2'];
                                    }
									else
									{
									  $ship_adress2 = $_REQUEST['ship_adress2'];	
									}
									
                                    if(empty($_REQUEST['ship_zip_code']))
                                    {
                                      $ship_zip_code = $res2[0]['ship_zip_code'];
                                    }
									else
									{
									  $ship_zip_code = $_REQUEST['ship_zip_code'];	
									}
									
									
                                    if(empty($_REQUEST['ship_city']))
                                    {
                                      $ship_city = $res2[0]['ship_city'];
                                    }
									else
									{
									  $ship_city = $_REQUEST['ship_city'];	
									}
									
									
                                    if(empty($_REQUEST['ship_state']))
                                    {
                                      $ship_state = $res2[0]['ship_state'];
                                    }	
									else
									{
									  $ship_state = $_REQUEST['ship_state'];	
									}
									
											   
                                    if(empty($_REQUEST['ship_country']))
                                    {
                                      $ship_country = $res2[0]['ship_country'];
                                    }
									else
									{
									  $ship_country = $_REQUEST['ship_country'];	
									}
									
									if(empty($_REQUEST['ship_contact_phone']))
                                    {
                                      $ship_contact_phone = $res2[0]['ship_contact_phone'];
                                    }
									else
									{
									  $ship_contact_phone = $_REQUEST['ship_contact_phone'];	
									}
                                    
                                    //billing information
                                    unset($info2);        
                                    $info2["table"] = "billing_information";
                                    $info2["fields"] = array("billing_information.*"); 
                                    $info2["where"]   = "1  AND id='".$arr[0]['billing_information_id']."' LIMIT 0,1";
                                    $res2 =  $db->select($info2);
                                    if(empty($_REQUEST['first_name']))
                                    {
                                      $first_name = $res2[0]['first_name'];
                                    }
									else
									{
									  $first_name = $_REQUEST['first_name'];	
									}
									
                                    if(empty($_REQUEST['last_name']))
                                    {
                                      $last_name = $res2[0]['last_name'];
                                    }
									else
									{
									  $last_name = $_REQUEST['last_name'];	
									}
									
                                    if(empty($_REQUEST['country']))
                                    {
                                      $country = $res2[0]['country'];
                                    }
									else
									{
									  $country = $_REQUEST['country'];	
									}
									
                                    if(empty($_REQUEST['adress1']))
                                    {
                                      $adress1 = $res2[0]['adress1'];
                                    }
									else
									{
									  $adress1 = $_REQUEST['adress1'];	
									}
									
                                    if(empty($_REQUEST['adress2']))
                                    {
                                      $adress2 = $res2[0]['adress2'];
                                    }
									else
									{
									  $adress2 = $_REQUEST['adress2'];	
									}
									
                                    if(empty($_REQUEST['city']))
                                    {
                                      $city = $res2[0]['city'];
                                    } 
									else
									{
									  $city = $_REQUEST['city'];	
									}
									
                                    if(empty($_REQUEST['state']))
                                    {
                                      $state =$res2[0]['state'];
                                    } 
									else
									{
									  $state = $_REQUEST['state'];	
									}
									
                                    if(empty($_REQUEST['zip_code']))
                                    {
                                      $zip_code = $res2[0]['zip_code'];
                                    }
									else
									{
									  $zip_code = $_REQUEST['zip_code'];	
									}
									
                                    if(empty($_REQUEST['phone_no']))
                                    {
                                      $phone_no = $res2[0]['phone_no'];
                                    }
									else
									{
									  $phone_no = $_REQUEST['phone_no'];	
									}
                                }	
                             ?>
                              <div class="row">
                                 <div class="col-md-6 col-sm-12">
                                      <?php
                                          include("cart_shipping_address.php");
                                      ?>           
                                 </div>  
                                 <div class="col-md-6 col-sm-12">
                                       <?php
                                          include("cart_billing_info.php");
                                       ?>     
                                 </div>       
                              </div>    
                              </form>
                             </div> 
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