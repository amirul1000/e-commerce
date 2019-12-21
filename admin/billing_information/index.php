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
				
				include("billing_information_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "billing_information";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$first_name    = $res[0]['first_name'];
					$last_name    = $res[0]['last_name'];
					$country    = $res[0]['country'];
					$adress1    = $res[0]['adress1'];
					$adress2    = $res[0]['adress2'];
					$city    = $res[0]['city'];
					$state    = $res[0]['state'];
					$zip_code    = $res[0]['zip_code'];
					$contact_phone    = $res[0]['contact_phone'];
					
				 }
						   
				include("billing_information_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "billing_information";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("billing_information_list.php");						   
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
				include("billing_information_list.php");
				break; 
        case "search_billing_information":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("billing_information_list.php");
				break;  								   
						
	     default :    
		       include("billing_information_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'billing_information'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
