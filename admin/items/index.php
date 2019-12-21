<?php
       session_start();
       include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login/");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
				$info['table']    = "items";
				$data['orders_id']   = $_REQUEST['orders_id'];
                $data['os0']   = $_REQUEST['os0'];
                $data['os1']   = $_REQUEST['os1'];
                $data['item_name']   = $_REQUEST['item_name'];
                $data['item_number']   = $_REQUEST['item_number'];
                $data['quantity']   = $_REQUEST['quantity'];
                $data['currency']   = $_REQUEST['currency'];
                $data['amount']   = $_REQUEST['amount'];
                
				
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
				
				include("items_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "items";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$orders_id    = $res[0]['orders_id'];
					$os0    = $res[0]['os0'];
					$os1    = $res[0]['os1'];
					$item_name    = $res[0]['item_name'];
					$item_number    = $res[0]['item_number'];
					$quantity    = $res[0]['quantity'];
					$currency    = $res[0]['currency'];
					$amount    = $res[0]['amount'];
					
				 }
						   
				include("items_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "items";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("items_list.php");						   
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
				include("items_list.php");
				break; 
        case "search_items":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("items_list.php");
				break;  								   
						
	     default :    
		       include("items_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'items'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
