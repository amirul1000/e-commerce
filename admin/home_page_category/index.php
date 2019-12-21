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
				 foreach($_REQUEST as $key=>$value)
				 {
				   if(substr($key,0,strlen("category_id_"))=="category_id_")
					 {
					   if($_REQUEST[$key]!="")
					   {
						$seelcted_category_arr[]  = $value;
						$seelcted_category_name[] = get_cat_name($db,$value);
					   }    
					 }
				 }
				$parent_category_id = $seelcted_category_arr[count($seelcted_category_arr)-1]; 		 
				if(count($seelcted_category_arr)>0)
				{  		 
				  $seelcted_category = implode(",",$seelcted_category_arr); 
				} 	  
				$info['table']    = "home_page_category";
				$data['category_id']   = $seelcted_category_arr[count($seelcted_category_arr)-1];
				$data['parent_category_txt']   = implode(";",$seelcted_category_name);
				$data['category_txt']   = $seelcted_category_name[count($seelcted_category_name)-1];
				
                $data['display_position']   = $_REQUEST['display_position'];
                $data['products_id']   = $_REQUEST['products_id'];
                $data['status']   = $_REQUEST['status'];
                
				
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
				
				include("home_page_category_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "home_page_category";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$category_id    = $res[0]['category_id'];
					$parent_category_txt    = $res[0]['parent_category_txt'];
					$category_txt    = $res[0]['category_txt'];
					$display_position    = $res[0]['display_position'];
					$products_id    = $res[0]['products_id'];
					$status    = $res[0]['status'];
					
				 }
						   
				include("home_page_category_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "home_page_category";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("home_page_category_list.php");						   
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
				include("home_page_category_list.php");
				break; 
        case "search_home_page_category":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("home_page_category_list.php");
				break;  								   
						
	     default :    
		       include("home_page_category_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'home_page_category'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
 
 function get_cat_name($db,$id)
{
   	unset($info);		  
	 $info["table"] = "category";
    $info["fields"] = array("category.*"); 
	 $info["where"]   = "1 AND id='".$id."'";
	 $arr =  $db->select($info);
	 
	 return $arr[0]['cat_name'];
} 
?>
