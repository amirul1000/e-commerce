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
				$info['table']    = "fb_post";
				$data['users_id']   = $_SESSION['users_id'];
                $data['message']   = $_REQUEST['message'];
                $data['title']   = $_REQUEST['title'];
                $data['link']   = $_REQUEST['link'];
                $data['description']   = $_REQUEST['description'];
                $data['picture']   = $_REQUEST['picture'];
                $data['last_post_date_time']   = '';// $_REQUEST['last_post_date_time'];
                $data['is_posted']   = 'no';//$_REQUEST['is_posted'];
                
				
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
				
				include("fb_post_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "fb_post";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$users_id    = $res[0]['users_id'];
					$message    = $res[0]['message'];
					$title    = $res[0]['title'];
					$link    = $res[0]['link'];
					$description    = $res[0]['description'];
					$picture    = $res[0]['picture'];
					$last_post_date_time    = $res[0]['last_post_date_time'];
					$is_posted    = $res[0]['is_posted'];
					
				 }
						   
				include("fb_post_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "fb_post";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("fb_post_list.php");						   
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
				include("fb_post_list.php");
				break; 
        case "search_fb_post":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("fb_post_list.php");
				break;  								   
						
	     default :    
		       include("fb_post_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'fb_post'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
