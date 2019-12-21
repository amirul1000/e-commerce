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
				
				include("shipping_address_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "shipping_address";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$ship_first_name    = $res[0]['ship_first_name'];
					$ship_last_name    = $res[0]['ship_last_name'];
					$ship_adress1    = $res[0]['ship_adress1'];
					$ship_adress2    = $res[0]['ship_adress2'];
					$ship_zip_code    = $res[0]['ship_zip_code'];
					$ship_city    = $res[0]['ship_city'];
					$ship_state    = $res[0]['ship_state'];
					$ship_country    = $res[0]['ship_country'];
					$ship_contact_phone    = $res[0]['ship_contact_phone'];
					
				 }
						   
				include("shipping_address_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "shipping_address";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("shipping_address_list.php");						   
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
				include("shipping_address_list.php");
				break; 
        case "search_shipping_address":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("shipping_address_list.php");
				break;  								   
						
	     default :    
		       include("shipping_address_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'shipping_address'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
