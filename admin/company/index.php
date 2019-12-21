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
				$info['table']    = "company";
				$data['users_id']   = $_REQUEST['users_id'];
                $data['company_name']   = $_REQUEST['company_name'];
                $data['description']   = $_REQUEST['description'];
                     
				if(strlen($_FILES['file_logo']['name'])>0 && $_FILES['file_logo']['size']>0)
				{
					
					if(!file_exists("../../company_images"))
					{ 
					   mkdir("../../company_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_FILES['file_logo']['name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_FILES['file_logo']['name'])));
					}
					$filePath="../../company_images/".$file;
					move_uploaded_file($_FILES['file_logo']['tmp_name'],$filePath);
					$data['file_logo']="company_images/".trim($file);
				}
                $data['business_type']   = $_REQUEST['business_type'];
                $data['main_products']   = $_REQUEST['main_products'];
                $data['total_annual_revenue']   = $_REQUEST['total_annual_revenue'];
                $data['total_employees']   = $_REQUEST['total_employees'];
                $data['year_established']   = $_REQUEST['year_established'];
                $data['social_link']   = $_REQUEST['social_link'];
                $data['email']   = $_REQUEST['email'];
                $data['cell_phone']   = $_REQUEST['cell_phone'];
                $data['land_phone']   = $_REQUEST['land_phone'];
                $data['country_id']   = $_REQUEST['country_id'];
                $data['country_txt']   = $_REQUEST['country_txt'];
                $data['state']   = $_REQUEST['state'];
                $data['city_town']   = $_REQUEST['city_town'];
                $data['area']   = $_REQUEST['area'];
                $data['zip_code']   = $_REQUEST['zip_code'];
                $data['address']   = $_REQUEST['address'];
                $data['latitude']   = $_REQUEST['latitude'];
                $data['longitude']   = $_REQUEST['longitude'];
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
				
				include("company_list.php");						   
				break;    
		case "edit":      
				$Id               = $_REQUEST['id'];
				if( !empty($Id ))
				{
					$info['table']    = "company";
					$info['fields']   = array("*");   	   
					$info['where']    =  "id=".$Id;
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$users_id    = $res[0]['users_id'];
					$company_name    = $res[0]['company_name'];
					$description    = $res[0]['description'];
					$file_logo    = $res[0]['file_logo'];
					$business_type    = $res[0]['business_type'];
					$main_products    = $res[0]['main_products'];
					$total_annual_revenue    = $res[0]['total_annual_revenue'];
					$total_employees    = $res[0]['total_employees'];
					$year_established    = $res[0]['year_established'];
					$social_link    = $res[0]['social_link'];
					$email    = $res[0]['email'];
					$cell_phone    = $res[0]['cell_phone'];
					$land_phone    = $res[0]['land_phone'];
					$country_id    = $res[0]['country_id'];
					$country_txt    = $res[0]['country_txt'];
					$state    = $res[0]['state'];
					$city_town    = $res[0]['city_town'];
					$area    = $res[0]['area'];
					$zip_code    = $res[0]['zip_code'];
					$address    = $res[0]['address'];
					$latitude    = $res[0]['latitude'];
					$longitude    = $res[0]['longitude'];
					$status    = $res[0]['status'];
					
				 }
						   
				include("company_editor.php");						  
				break;
						   
         case 'delete': 
				$Id               = $_REQUEST['id'];
				
				$info['table']    = "company";
				$info['where']    = "id='$Id'";
				
				if($Id)
				{
					$db->delete($info);
				}
				include("company_list.php");						   
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
				include("company_list.php");
				break; 
        case "search_company":
				$_REQUEST['page'] = 1;  
				$_SESSION["search"]="yes";
				$_SESSION['field_name'] = $_REQUEST['field_name'];
				$_SESSION["field_value"] = $_REQUEST['field_value'];
				include("company_list.php");
				break;  								   
						
	     default :    
		       include("company_list.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'company'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
