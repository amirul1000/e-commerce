<?php
       session_start();
       include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
		  case 'add': 
		      if(empty($_REQUEST['email']))
			  {
				    $arr[0]['status'] = 'fail';
					$arr[0]['msg'] = "Email cant be empty";
					echo json_encode($arr); 
				    exit;    
			  }
		             unset($info);
		        $info["table"] = "subscription";
				$info["fields"] = array("subscription.*"); 
				$info["where"]   = "1  AND email='".$_REQUEST['email']."'";
				$arr =  $db->select($info);   
		        if(count($arr)==0)
				{
					$info['table']    = "subscription";
					$data['email']   = $_REQUEST['email'];
					$data['status']   = 'active';
					$data['date_subscribed']   = date("Y-m-d H:i:s");
					$info['data']     =  $data;
					 $status = 	 $db->insert($info);
					 unset($arr);
					 if($status ==true)
					 {
						 $arr[0]['status'] = 'success';
						 $arr[0]['msg'] = "Your subscription has been completed successfully";
					 }
				}
				else
				{
					$arr[0]['status'] = 'fail';
					$arr[0]['msg'] = "You are already a subscribed user";
				}				  
				echo json_encode($arr); 
				break;    
		/*case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "subscription";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$email    = $res[0]['email'];
					$status    = $res[0]['status'];
					$date_subscribed    = $res[0]['date_subscribed'];
					
				 }
						   
				include("subscription_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "subscription";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("subscription_list.php");						   
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
				include("subscription_list.php");
				break; 
        case "search_subscription":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("subscription_list.php");
				break;  								   
						
	     default :    
		       include("subscription_list.php");*/		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'subscription'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
