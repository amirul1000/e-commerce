<?php
       session_start();
       include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   require_once('../../image_lib/image_lib_class.php');
	   
	   
	   //error_reporting(E_ALL);
	   //ini_set('display_errors', 1); 
	   
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
				$info['table']    = "products";
				$data['category_id']   = $seelcted_category_arr[count($seelcted_category_arr)-1];
				$data['parent_category_txt']   = implode(";",$seelcted_category_name);
				$data['category_txt']   = $seelcted_category_name[count($seelcted_category_name)-1];
                $data['product_name']   = $_REQUEST['product_name'];
                $data['product_title']   = $_REQUEST['product_title'];
                $data['brand']   = $_REQUEST['brand'];
                $data['model']   = $_REQUEST['model'];
                $data['sku']   = $_REQUEST['sku'];
                $data['description']   = $_REQUEST['description'];
                $data['product_condition']   = $_REQUEST['product_condition'];
                $data['sticker']   = $_REQUEST['sticker'];
                $data['gender_for']   = $_REQUEST['gender_for'];
                $data['age_for']   = $_REQUEST['age_for'];
                $data['occasions']   = $_REQUEST['occasions'];
                $data['material_used']   = $_REQUEST['material_used'];
                $data['size']   = $_REQUEST['size'];
                $data['color']   = $_REQUEST['color'];
                $data['width']   = $_REQUEST['width'];
                $data['height']   = $_REQUEST['height'];
                $data['length']   = $_REQUEST['length'];
                $data['width_height_length_unit']   = $_REQUEST['width_height_length_unit'];
                $data['weight']   = $_REQUEST['weight'];
                $data['weight_unit']   = $_REQUEST['weight_unit'];
                $data['price']   = $_REQUEST['price'];
                $data['discount']   = $_REQUEST['discount'];
                $data['net_price']   = $_REQUEST['net_price'];
                $data['currency']   = $_REQUEST['currency'];
                $data['affiliate_commission']   = $_REQUEST['affiliate_commission'];   
				if(strlen($_FILES['file_products']['name'])>0 && $_FILES['file_products']['size']>0)
				{
					
					if(!file_exists("../../products_images"))
					{ 
					   mkdir("../../products_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_products']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_products']['name'])));
					}
					$filePath="../../products_images/".$file;
					move_uploaded_file($_FILES['file_products']['tmp_name'],$filePath);
					$data['file_products']="products_images/".trim($file);
				}
                $data['term_condition']   = $_REQUEST['term_condition'];
                $data['delivery_info']   = $_REQUEST['delivery_info'];
                $data['damage_return']   = $_REQUEST['damage_return'];
				$data['product_display_position'] = $_REQUEST['product_display_position'];
				if(empty($_REQUEST['id']))
				{
                	$data['created_at']   = date("Y-m-d H:i:s");
				}
				else
				{
                	$data['updated_at']   = date("Y-m-d H:i:s");
				}
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
				add_more_images($db,$Id);
				include("products_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "products";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$category_id    = $res[0]['category_id'];
					$parent_category_txt    = $res[0]['parent_category_txt'];
					$category_txt    = $res[0]['category_txt'];
					$product_name    = $res[0]['product_name'];
					$product_title    = $res[0]['product_title'];
					$brand    = $res[0]['brand'];
					$model    = $res[0]['model'];
					$sku    = $res[0]['sku'];
					$description    = $res[0]['description'];
					$product_condition    = $res[0]['product_condition'];
					$sticker    = $res[0]['sticker'];
					$gender_for    = $res[0]['gender_for'];
					$age_for    = $res[0]['age_for'];
					$occasions    = $res[0]['occasions'];
					$material_used    = $res[0]['material_used'];
					$size    = $res[0]['size'];
					$color    = $res[0]['color'];
					$width    = $res[0]['width'];
					$height    = $res[0]['height'];
					$length    = $res[0]['length'];
					$width_height_length_unit    = $res[0]['width_height_length_unit'];
					$weight    = $res[0]['weight'];
					$weight_unit    = $res[0]['weight_unit'];
					$price    = $res[0]['price'];
					$discount    = $res[0]['discount'];
					$net_price    = $res[0]['net_price'];
					$currency    = $res[0]['currency'];
					$affiliate_commission= $res[0]['affiliate_commission'];
					$file_products    = $res[0]['file_products'];
					$term_condition    = $res[0]['term_condition'];
					$delivery_info    = $res[0]['delivery_info'];
					$damage_return    = $res[0]['damage_return'];
					$product_display_position = $res[0]['product_display_position'];
					$created_at    = $res[0]['created_at'];
					$updated_at    = $res[0]['updated_at'];
					$status    = $res[0]['status'];
					
				 }
						   
				include("products_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];				
				
			     unset($info);
				$info['table']    = "products";
				$info['fields']   = array("*");   	   
				$info['where']    = "id='$Id'";
				$res  =  $db->select($info);
				
				
				 unset($info);
				$info['table']    = "products";
				$info['where']    = "id='$Id'";
				
				if($Id&&count($res)>0)
				{
					$db->delete($info);
					
					$file_products  = "../../".$res[0]['file_products'];
					chmod($file_products, 0777);
					unlink($file_products);
					
					 unset($info);
					$info['table']    = "products_images";
					$info['fields']   = array("*");   	   
					$info['where']    = "products_id='$Id'";
					$res  =  $db->select($info);
					
					 unset($info);
					$info['table']    = "products_images";
					$info['where']    = "products_id='$Id'";
					$db->delete($info);
					
					for($i=0;$i<count($res);$i++)
					{
						  $file_name  = "../../".$res[$i]['file_name']; 
						  chmod($file_name, 0777);
					     unlink($file_name);
					}
				}
				include("products_list.php");						   
				break; 
		 case "delete_dropzone_file":
		       $name = $_REQUEST['name'];
		       $folder = "products_more_images";
		       $file_more_images = $folder."/".$name;
		  		 
		  		 $info["table"] = "products_images";	
		  		 $info['fields']   = array("*");   			
				 $info["where"]   = "1  AND file_name='".$file_more_images."'";
				 $arr =  $db->select($info);
		  		
		  		 if(count($arr)) {
			  		 $info["table"] = "products_images";			
					 $info["where"]   = "1  AND file_name='".$file_more_images."'";
					 $arr =  $db->delete($info);	
					 
					 $file = "../../".$file_more_images;
					 chmod($file,0777);
					 unlink("../../".$file_more_images);
				 }
				break;
		case "delete_more":
					$Id               = $_REQUEST['id'];		
					
						unset($info);
					$info['table']    = "products_images";
					$info['fields']   = array("*");   	   
					$info['where']    = "id='$Id'";
					$res  =  $db->select($info);
					if($Id && count($res)>0)
				    {
							unset($info);
						 unset($info);
						$info['table']    = "products_images";
						$info['where']    = "id='$Id'";
						$db->delete($info);
						
						$file_name  = "../../".$res[0]['file_name']; 
						chmod($file_name, 0777);
						unlink($file_name);
					}
			       include("products_list.php");						   
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
				include("products_list.php");
				break; 
        case "search_products":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("products_list.php");
				break;  								   
						
	     default :    
		       include("products_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'products'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	
function getMaxId2($db)
 {
	  $sql    = "SHOW TABLE STATUS LIKE 'products_images'";
	  $result = $db->execQuery($sql);
	  $row    = $db->resultArray();
	  return $row[0]['Auto_increment'];	
 }  
function get_order_no($db,$Id)
{
    $info["table"] = "products_images";
	$info["fields"] = array("products_images.*"); 
	$info["where"]   = "1  AND  products_id='".$Id."'";
	$arr =  $db->select($info);
	
   $order_no = $arr[0]['order_no'];
   
   if( empty($order_no) || $order_no ==0 )
   {
   	$order_no = 1;  
   }
   else 
   {
   	  $order_no = $order_no + 1;
   }
   
  return $order_no; 
}

function add_more_images($db,$products_id){	
	
	foreach($_SESSION as $key=>$value)
		{
		  if(substr($key,0,strlen("file_tmp_name"))=="file_tmp_name")
		  {			  			  
			  $time = substr($key,strlen("file_tmp_name_"),strlen($key));
			  
			  $file_tmp_name = base64_decode($_SESSION["file_tmp_name_".$time]);
			  $file_file     = $_SESSION["file_file_".$time];
			  
			
			if(!file_exists("../../products_more_images"))
			{ 
			   mkdir("../../products_more_images",0755);	
			}
			if(empty($Id))
			{
			  $file=getMaxId2($db)."_".str_replace(" ","_",strtolower($file_file));
			}
			else
			{
			  $file=trim($Id)."_".str_replace(" ","_",strtolower($file_file));
			}
			$filePath="../../products_more_images/".$file;
			$filePath2="../../products_more_images/_".$file;
			
			//move_uploaded_file($_SESSION['file_products_tmp_name'],$filePath);
			
			$fp=fopen($filePath,"w");
			
			fwrite($fp,$file_tmp_name);
			
			//$data['file_products']="products_images/".trim($file);
			
			unset($_SESSION["file_tmp_name_".$time]);
			unset($_SESSION["file_file_".$time]);
			
			
			  
			  ////////////////////////Resize Image///////////////////////////
	 
	
		 /*	Purpose: Open image
		 *	Usage:	 resize('filename.type')
		 * 	Params:	 filename.type - the filename to open
		 */
		$imageLibObj = new imageLib($filePath);						
	
		/*	Purpose: Resize image
		 *	Usage:	 resizeImage([width], [height], [resize type], [sharpen])
		 * 	Params:	 width - the new width to resize to
		 *			 height - the new height to resize to
		 *			 resize type - choose from the below options
		 *
		 *      exact = The exact height and width dimensions you set. (Default)
		 *      portrait = Whatever height is passed in will be the height that
		 *          is set. The width will be calculated and set automatically 
		 *          to a the value that keeps the original aspect ratio. 
		 *      landscape = The same but based on the width. We try make the image 
		 *         the biggest size we can while stil fitting inside the box size
		 *      auto = Depending whether the image is landscape or portrait, this
		 *          will automatically determine whether to resize via 
		 *          dimension 1,2 or 0
		 *      crop = Will resize and then crop the image for best fit
		 *	
		 *			 sharpen - set as true if you would like shapening applied to 
		 *				to your resized image    
		 */	
		$imageLibObj -> resizeImage(300, 300, 'auto', true);						
	
		/*	Purpose: Save image
		 *	Usage:	 saveImage('[filename.type]', [quality])
		 * 	Params:	 filename.type - the filename and file type to save as
		 * 			 quality - (optional) 0-100 (100 being the highest (default))
		 *				Only applies to jpg & png only
		 */
		$imageLibObj -> saveImage($filePath2, 100);
		
		unlink($filePath);				
	//////////////////////Resize Image//////////////////////////////////
			
					unset($info);
					unset($data);
				$info['table']         = "products_images";
				$data['users_id']      = $_SESSION['users_id'];
				$data['products_id']   = $products_id;
				$data['file_name']     = "products_more_images/_".trim($file);
				$data['order_no']      = get_order_no($db,$products_id);
				$data['uploaded']      = date("Y-m-d H:i:s");
				$info['data']          =  $data;
				$db->insert($info);
				//$Id = $db->lastInsert($result);
			}
	  }
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
