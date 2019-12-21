<?php
       session_start();
      include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   include("../../lib_cat/lib.php");
	   
	   //ini_set('display_errors', 1); 
	   //error_reporting(E_ALL&~E_NOTICE);
	   
	   /*if(empty($_SESSION['admin_users_id']) && $_SESSION["user_type"]!='super') 
	   {
	     Header("Location: ../login/login.php");
	   }*/
	   if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../login/");
	   }
	  
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'add': 
				$info['table']    = "category";
				if(strlen($_FILES['file_icon']['name'])>0 && $_FILES['file_icon']['size']>0)
				{
					
					if(!file_exists("../../category_images"))
					{ 
					   mkdir("../../category_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_icon']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_icon']['name'])));
					}
					$filePath="../../category_images/".$file;
					move_uploaded_file($_FILES['file_icon']['tmp_name'],$filePath);
					$data['file_icon']="category_images/".trim($file);
				}
				if(empty($_REQUEST['parent_category_id']))
				{
					$data['parent_category_id']   = '0';
				}
				else
				{
					$data['parent_category_id']   = $_REQUEST['parent_category_id'];
				}
                $data['cat_name']   = $_REQUEST['cat_name'];
                
				
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
				
				include("category_editor.php");						   
				break;    
		 case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "category";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$file_icon    = $res[0]['file_icon'];
					$parent_category_id    = $res[0]['parent_category_id'];
					$cat_name    = $res[0]['cat_name'];
					
				 }
						   
				include("category_editor.php");						  
				break;
						   
       case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "category";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("category_list.php");						   
				break;
		 case "view_tree":
				//Current node
				$category_id = $_REQUEST['id'];
				$tree=get_tree($category_id,$db);
				echo "<b>Node Structure</b><br>";
				$tree = parseTree($tree,null);
				printTree($tree);				
				//Current tree
				unset($tree);
				//$category_id = $_REQUEST['id'];
				global $arrParent;
				get_last_category($category_id,'',$db);		
				if(!empty($arrParent) && count($arrParent)>0)
				{
				  $category_id = $arrParent[count($arrParent)-1];
				}
				else
				{
				   $category_id = $_REQUEST['id'];
				}
				$tree = get_tree($category_id,$db);
				echo "<b>Tree Structure</b><br>";				
				$tree = parseTree($tree,null);
				printTree($tree);
				//Full tree structure
				/*$category_id = 0;
				$tree = get_tree($category_id,$db);
				echo "<b>Full Tree Structure</b><br>";				
				$tree = parseTree($tree,null);
				printTree($tree);*/
		        break;	
		case "view_full_tree":
				//Full tree structure
				$category_id = 0;
				$tree = get_tree($category_id,$db);
				echo "<b>Full Tree Structure</b><br>";				
				$tree = parseTree($tree,null);
				printTree($tree);	
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
				include("category_list.php");
				break; 
       case "search_category":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("category_list.php");
				break;  								   
						
	     default :    
		       include("category_list.php");	         

	   }
?>
