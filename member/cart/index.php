<?php
       session_start();
		include("../../common/lib.php");
		include("../../lib/class.db.php");
		include("../../common/config.php");
		include("../../lib_cat/lib.php");
		include("../../lib_products/lib.php");
		include("../../common_lib/common_lib.php");
		/*require_once('../../image_lib/image_lib_class.php');
		include("paypal_pro.lib.php");	*/
	   
	    if(empty($_SESSION['users_id'])) 
	    {
	      Header("Location: ../../login/");
	    }	
	      
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     	//paypal pro transaction
	      case "order" :  
				//global $httptrnsaction;
			  // if(card_payment_submit()==true)
			  // {
				  //if($httptrnsaction['ACK']=="Success")
				  //{
					$TRANSACTIONID = $httptrnsaction['TRANSACTIONID'];
					order_add($db);
					$message = " <font color=\"red\">Order has been completed successfully</font>";
					unset($_SESSION['cart']);
					
				 // }
			  // }
			  // else
				//{
				//   $message = "Please fix your credit card and billing information <br>
				//		   <font color=\"red\">".str_replace("%2e"," ",str_replace("%20"," ",$httptrnsaction['L_LONGMESSAGE0']))."</font>";
					 
				// }
	        include("cart_list.php");
		   break;	
		 case "update":
		          //Update Quantity at cart
				   $count = count($_SESSION['cart']);					   
				   for($i=0;$i<$count;$i++)
				   {
					 if($_REQUEST['item_number']==$_SESSION['cart'][$i]['item_number']  && $_REQUEST['item_name']==$_SESSION['cart'][$i]['item_name'])
					 {
						  $_SESSION['cart'][$i]['quantity'] =$_REQUEST['quantity'];
					   break;	 
					 }
				  }
				include("cart_list.php");
				break;	
		  case "remove":
		            //Remove item from cart
				       $removeflag = false;
				       $count = count($_SESSION['cart']);					   
					   for($i=0;$i<$count;$i++)
					   {
					     
					     if($_REQUEST['item_number']==$_SESSION['cart'][$i]['item_number']  && $_REQUEST['item_name']==$_SESSION['cart'][$i]['item_name'])
						 {
						  $remove_position=$i;
						  $removeflag = true;
						  break;
						 }
					  }
					  if($removeflag == true)
					  {
					  for($i=$remove_position;$i<$count-1;$i++)
					   {
					    $_SESSION['cart'][$i]['os0'] = $_SESSION['cart'][$i+1]['os0'];
						$_SESSION['cart'][$i]['os1'] = $_SESSION['cart'][$i+1]['os1'];
						$_SESSION['cart'][$i]['item_name'] = $_SESSION['cart'][$i+1]['item_name'];
						$_SESSION['cart'][$i]['item_number'] = $_SESSION['cart'][$i+1]['item_number'];
						$_SESSION['cart'][$i]['quantity'] = $_SESSION['cart'][$i+1]['quantity'];
						$_SESSION['cart'][$i]['currency'] = $_SESSION['cart'][$i+1]['currency'];
						$_SESSION['cart'][$i]['amount'] = $_SESSION['cart'][$i+1]['amount'];
						$_SESSION['cart'][$i]['products_id'] = $_SESSION['cart'][$i+1]['products_id'];
						$_SESSION['cart'][$i]['shipping_charge'] = $_SESSION['cart'][$i+1]['shipping_charge'];
					   } 
					   unset($_SESSION['cart'][$i]);
					   }
		        include("cart_list.php");
				break;		   
         case "list" :    	 
			  if(!empty($_REQUEST['page'])&&$_SESSION["search"]=="yes")
				{
				  $_SESSION["search"]="yes";
				}
				else
				{
				   $_SESSION["search"]="no";
					unset($_SESSION["search"]);
					unset($_SESSION['field_name']);
					unset($_SESSION["field_value"]); 
				}
				include("cart_list.php");
				break;
	     default :   
		       include("cart_list.php");         
	   }
/*
  get image by ProductID
*/	   
function getImage($db,$products_id)
{
	   unset($info);
	$info["table"] = "products";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1 AND id='".$products_id."'";	
	$arr =  $db->select($info);
	
	return $arr[0]['file_products'];
}
/*
  order add
*/
function order_add($db)
{
	//add shipping address
	   unset($info);
	   unset($data);
	$info['table']    = "shipping_address";
	$data['ship_first_name']   = $_REQUEST['ship_first_name'];
	$data['ship_last_name']   = $_REQUEST['ship_last_name'];
	$data['ship_adress1']   = $_REQUEST['ship_adress1'];
	$data['ship_adress2']   = $_REQUEST['ship_adress2'];
	$data['ship_zip_code']   = $_REQUEST['ship_zip_code'];
	$data['ship_city']   = $_REQUEST['ship_city'];
	$data['ship_state']   = $_REQUEST['ship_state'];
	$data['ship_country']   = $_REQUEST['ship_country'];	
	$data['ship_contact_phone']   = $_REQUEST['ship_contact_phone'];	
	$info['data']     =  $data;	
	//$info['debug']     = true;
	$db->insert($info);
	$shipping_address_id = $db->lastInsert(true);
	//add billing information
       unset($info);
	   unset($data);
	$info['table']    = "billing_information";
	$data['first_name']   = $_REQUEST['first_name'];
	$data['last_name']   = $_REQUEST['last_name'];
	$data['country']   = $_REQUEST['country'];
	$data['adress1']   = $_REQUEST['adress1'];
	$data['adress2']   = $_REQUEST['adress2'];
	$data['city']   = $_REQUEST['city'];
	$data['state']   = $_REQUEST['state'];
	$data['zip_code']   = $_REQUEST['zip_code'];
	$data['contact_phone']   = $_REQUEST['contact_phone'];
	$info['data']     =  $data;	
	//$info['debug']     = true;
	$db->insert($info);		
	$billing_information_id = $db->lastInsert(true);	
	//add order
       unset($info);
	   unset($data);
	$info['table']    = "orders";
	$data['transactionid'] = date("YmdHis");
	$data['order_number'] = date("YmdHis");
	$data['invoice_number'] = date("YmdHis");
	$data['users_id']   = $_SESSION['users_id'];
	$data['shipping_address_id']   = $shipping_address_id;
	$data['billing_information_id']   = $billing_information_id;
	$data['currency']   = $_REQUEST['currency'];
	$data['shipping_cost']   = $_REQUEST['shipping_cost'];
	$data['transaction_fee']   = $_REQUEST['transaction_fee'];
	$data['total_amount']   = $_REQUEST['payment_amuont'];
	$data['date_created']   = date("Y-m-d H:i:s");
	$data['delivery_status']   = 'pending';
	$info['data']     =  $data;	
	//$info['debug']     = true;
	$db->insert($info);				
	$orders_id = $db->lastInsert(true);
	//add item
	$count = count($_SESSION['cart']);					
	for($i=0;$i<$count;$i++)
	{
	    	unset($info);
	        unset($data);
		$info['table']    = "items";
		$data['orders_id']   = $orders_id;
		$data['products_id']   = $_SESSION['cart'][$i]['products_id'];
		$data['os0']   = $_SESSION['cart'][$i]['os0'];
		$data['item_name']   = $_SESSION['cart'][$i]['item_name'];
		$data['item_number']   = $_SESSION['cart'][$i]['item_number'];
		$data['quantity']   = $_SESSION['cart'][$i]['quantity'];
		$data['currency']   = $_SESSION['cart'][$i]['currency'];
		$data['amount']   = $_SESSION['cart'][$i]['amount'];
		$info['data']     =  $data;
		//$info['debug']     = true;	
		$db->insert($info);	
		
		referrals($db,$_SESSION['cart'][$i]['products_id']);				
			
	}
	
	////////////////////////////////////////////////////////////////
		unset($info);
		unset($data);		  
	$info["table"] = "products";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1 AND id='".$_SESSION['cart'][0]['products_id']."'";
	$arrproduct =  $db->select($info);
	
	
	//$arrseller = get_users_info($db,$arrproduct[0]['users_id']);	
	$arrbuyer  = get_users_info($db,$_SESSION['users_id']);
	$msg_body  = get_orders_email_conment($db,$orders_id);
	
	///////Buyer email///////////
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	//$headers .= 'To: '.$data['email'].'' . "\r\n";
	$headers .= 'From: O2 <orders@O2.com>' . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
	
	// Mail it
	$subject = "Your order has been placed successfully";// "You requested to change Your Password";
	
	
	$message_body  = "Dear ".$arrbuyer[0]['first_name']." ".$arrbuyer[0]['last_name'].",<br>
	                  The following products has been placed sucessfully.
					  That will be delivred to the shipping address as soon as possible.
					  You can keep track the status by the order no."
	                   .$msg_body."<br>
					   Thank You,<br>
						O2<br>
						<img src=\"http://128.199.142.104/images/logo.png\"  style=\"height:50px;\">";
	$staus = mail($arrbuyer[0]['email'], $subject, $message_body, $headers);
	
	/////////////Merchant email///////////////////
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	//$headers .= 'To: '.$data['email'].'' . "\r\n";
	$headers .= 'From: O2 <orders@O2.com>' . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
	
	// Mail it
	$subject = "An order has been placed successfully";// "You requested to change Your Password";
	
	
	$message_body  = "Dear ".$arrseller[0]['first_name']." ".$arrseller[0]['last_name'].",<br>
	                  The following products has been placed sucessfully.
					  Please deliver this to the shipping address as soon as possible."
	                   .$msg_body."<br>
					   Thank You,<br>
					     O2<br>
						<img src=\"http://O2.com/images/logo.png\"  style=\"height:50px;\">";
	$staus = mail($arrseller[0]['email'], $subject, $message_body, $headers);
	
	
	/////////////////////Invoice////////////////////////////
	$msg_body  = get_invoice_email_conment($db,$orders_id);
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	//$headers .= 'To: '.$data['email'].'' . "\r\n";
	$headers .= 'From: O2 <invoice@O2.com>' . "\r\n";
	//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
	//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
	
	// Mail it
	$subject = "Invoice from O2.com";// "You requested to change Your Password";
	
	
	$message_body  = "Dear ".$arrbuyer[0]['first_name']." ".$arrbuyer[0]['last_name'].",<br>
	                  Your invoice has been sent you purchase from O2.com
					  You can keep track the status by the order no."
	                   .$msg_body."<br>
					   Thank You,<br>
						O2<br>
						<img src=\"http://O2.com/images/logo.png\"  style=\"height:50px;\">";
	$staus = mail($arrbuyer[0]['email'], $subject, $message_body, $headers);
	
	
	
}
function get_quantity($db,$ProductID)
{
      unset($info);
	$info["table"] = "products";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1 AND id='".$products_id."'";
	$arr =  $db->select($info);
	
	return $arr[0]['quantity']; 
	
}
/*
  get orders email conment
*/
function get_orders_email_conment($db,$orders_id)
{
	ob_start();
	include(dirname(__FILE__).'/template_orders_email.php');
	$msg_body = ob_get_clean();
	
	return $msg_body;
}

/*
  get orders email conment
*/
function get_invoice_email_conment($db,$orders_id)
{
	ob_start();
	include(dirname(__FILE__).'/template_invoice_email.php');
	$msg_body = ob_get_clean();
	
	return $msg_body;
}

function referrals($db,$products_id)
{
      unset($info);
	  unset($data);
	$info["table"] = "products";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1  AND id='".$products_id."'";
	$arr =  $db->select($info);
	
	$products_id = $arr[0]['id'];
	$affiliate_commission = $arr[0]['affiliate_commission'];
    $cost = $_REQUEST['mc_gross'];
	
	
	$cookie_name = "affiliate_users_id";
	if(isset($_COOKIE[$cookie_name])) {
		  if($_SESSION['users_id']!=$_COOKIE[$cookie_name])
		  {
			  
			   unset($info);
			   unset($data);
			$info['table']    = "referrals";
			$data['affiliate_users_id']   =$_COOKIE[$cookie_name];
			$data['buyer_users_id']   = $_SESSION['users_id'];
			$data['products_id']   = $products_id;
			$data['commission']   = $affiliate_commission;
			$data['date_created']   = date("Y-m-d H:i:s");
			$info['data']     =  $data;
				 $db->insert($info);  
	     }
	}
}
?>
