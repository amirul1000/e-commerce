<?php
       session_start();
       include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   include("../../common_lib/common_lib.php");
	   
	   if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login/");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
				$info['table']    = "orders";
				$data['users_id']   = $_REQUEST['users_id'];
                $data['shipping_address_id']   = $_REQUEST['shipping_address_id'];
                $data['billing_information_id']   = $_REQUEST['billing_information_id'];
                $data['shipping_cost']   = $_REQUEST['shipping_cost'];
                $data['total_amount']   = $_REQUEST['total_amount'];
                $data['date_created']   = $_REQUEST['date_created'];
                $data['delivery_status']   = $_REQUEST['delivery_status'];
                
				
				$info['data']     =  $data;
				
				if(empty($_REQUEST['id']))
				{
					 $db->insert($info);
				}
				else
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id=".$Id;
					
					$db->update($info);
				}
				
				include("orders_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "orders";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$users_id    = $res[0]['users_id'];
					$shipping_address_id    = $res[0]['shipping_address_id'];
					$billing_information_id    = $res[0]['billing_information_id'];
					$shipping_cost    = $res[0]['shipping_cost'];
					$total_amount    = $res[0]['total_amount'];
					$date_created    = $res[0]['date_created'];
					$delivery_status    = $res[0]['delivery_status'];
					
				 }
						   
				include("orders_editor.php");						  
				break;  
        case 'delete': 
			   //get order info		
				$info["table"] = "orders";
				$info["fields"] = array("orders.*"); 
				$info["where"]   = "1  AND id='".$_REQUEST['id']."'";
				$arr =  $db->select($info);
		        //delete order
				$Id               = $_REQUEST['id'];
				$info['table']    = "orders";
				$info['where']    = "id='$Id'";
				$db->delete($info);
				//delete billing info
				$info['table']    = "billing_information";
				$info['where']    = "id='".$arr[0]['billing_information_id']."'";
				$db->delete($info);
				//delete shipping info
				$info['table']    = "shipping_address";
				$info['where']    = "id='".$arr[0]['shipping_address_id']."'";
				$db->delete($info);
				//delete items
				$info['table']    = "items";
				$info['where']    = "orders_id='$Id'";
				$db->delete($info);
				include("orders_list.php");						   
				break; 
		 case "change_delivery_status":
		        $info['table']    = "orders";
                $data['delivery_status']   = $_REQUEST['delivery_status'];
				$info['data']     =  $data;
				if(!empty($_REQUEST['id']))
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id=".$Id;
					$db->update($info);
					//////////////////////////////////////////////////
					//////////////////////////////////////////////////
					if($_REQUEST['delivery_status']=='completed')
					{
						  unset($info);
						$info["table"] = "orders";
						$info["fields"] = array("orders.*,orders.users_id as buyer_users_id"); 
						$info["where"]   = "1 AND orders.id='".$_REQUEST['id']."'";
						$arrorders =  $db->select($info);
						
						
						  unset($info2);
						$info2["table"] = "items LEFT JOIN products ON(items.products_id=products.id)";
						$info2["fields"] = array("products.users_id"); 
						$info2["where"]   = "1 AND items.orders_id='".$arrorders[0]['id']."' ORDER BY items.id ASC";
						$res2 =  $db->select($info2); 
						$arrorders[0]['seller_users_id'] = $res2[0]['users_id'];    
						
						
						$buyer   = get_users_info($db,$arrorders[0]['buyer_users_id']);
						$seller  = get_users_info($db,$arrorders[0]['seller_users_id']);
						
						
						 unset($arr);
						$arr['users_id']= $seller[0]['id'];
						$arr['subject']= 'Product Sold';
						$arr['description']= $buyer[0]['first_name'].' '.$buyer[0]['last_name'];
						$arr['currency']= $arrorders[0]['currency'];
						$arr['debit'] = 0.0;
						$arr['credit'] = $arrorders[0]['total_amount'];
						$arr['refference']= $buyer[0]['first_name'].' '.$buyer[0]['last_name'];
						$arr['date_time_created']   = date("Y-m-d H:i:s");
						$info['debug']     = true;
						add_transaction($db,$arr);
						
						
					}	
					
					if($_REQUEST['delivery_status']=='return')
					{
						unset($info);
						$info["table"] = "orders";
						$info["fields"] = array("orders.*,orders.users_id as buyer_users_id"); 
						$info["where"]   = "1 AND orders.id='".$_REQUEST['id']."'";
						$arrorders =  $db->select($info);
						
						
						  unset($info2);
						$info2["table"] = "items LEFT JOIN products ON(items.products_id=products.id)";
						$info2["fields"] = array("products.users_id"); 
						$info2["where"]   = "1 AND items.orders_id='".$arrorders[0]['id']."' ORDER BY items.id ASC";
						$res2 =  $db->select($info2); 
						$arrorders[0]['seller_users_id'] = $res2[0]['users_id'];    
						
						
						$buyer   = get_users_info($db,$arrorders[0]['buyer_users_id']);
						$seller  = get_users_info($db,$arrorders[0]['seller_users_id']);
						
						
						 unset($arr);
						$arr['users_id']= $buyer[0]['id'];
						$arr['subject']= 'Return';
						$arr['description']= $seller[0]['first_name'].' '.$seller[0]['last_name'];
						$arr['currency']= $arrorders[0]['currency'];
						$arr['debit'] = 0.0;
						$arr['credit'] = $arrorders[0]['total_amount'];
						$arr['refference']= $seller[0]['first_name'].' '.$seller[0]['last_name'];
						$arr['date_time_created']   = date("Y-m-d H:i:s");
						//$info['debug']     = true;
						add_transaction($db,$arr);							
					}
					$msg = '"'.$_REQUEST['delivery_status'].'" has been completed successfully';									
				}
				include("orders_list.php");						   
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
				include("orders_list.php");
				break; 
        case "search_orders":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("orders_list.php");
				break;  								   
						
	     default :    
		       include("orders_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "orders";
	   $info['fields']   = array("max(id) as maxid");   	   
	   $info['where']    =  "1=1";
	  
	   $resmax  =  $db->select($info);
	   if(count($resmax)>0)
	   {
		 $max = $resmax[0]['maxid']+1;
	   }
	   else
	   {
		$max=0;
	   }	  
	   return $max;
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
?>
