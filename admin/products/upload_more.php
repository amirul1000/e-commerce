<?php
 session_start();
include("../../common/lib.php");
include("../../lib/class.db.php");
include("../../common/config.php");

  /* if(!empty($_REQUEST['id']))
	{
     $_SESSION['products_id']  = $_REQUEST['id'];
   }  
 else if(empty($_SESSION['products_id']))
	{
		$_SESSION['products_id'] = get_auto_increment($db);
		
	}
	
	
	   unset($info); 
		$info["table"] = "products";
		$info["fields"] = array("products.*"); 
		$info["where"]   = "1 AND products.id='".$_SESSION['products_id']."'";
		$arr =  $db->select($info);
	    if(count($arr)==0)
	    {
				  unset($info);
				$info['table']    = "products";
				$data['users_id'] = $_SESSION['users_id'];
				$info['data']     =  $data;
				$db->insert($info);
	    }*/
	
	
	 if(check_file_extension($_FILES)==false)
	{
	  exit(json_encode(array('success' => false, 'msg' =>'Error:  .'.$_SESSION['extension'].' is not a supported file'))); 
	}
	
if(!empty($_FILES)){
	
	//database configuration
	/*$dbHost = 'localhost';
	$dbUsername = 'root';
	$dbPassword = 'secret';
	$dbName = 'codexworld';
	//connect with the database
	$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	if($mysqli->connect_errno){
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	*/
	
	
	if(strlen($_FILES['file']['name'])>0 && $_FILES['file']['size']>0)
	{
		$time = time().rand(0,100).rand(0,100);   
		$_SESSION['file_tmp_name_'.$time] = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
		$_SESSION['file_file_'.$time]     = $_FILES['file']['name'];
		
	   echo json_encode(array('success' => true)); 	
	   exit;
	}
	
	
	
	
	//if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){



 ////////////////////////Resize Image///////////////////////////
   //require_once('../../image_lib/image_lib_class.php');

 	 /*	Purpose: Open image
     *	Usage:	 resize('filename.type')
     * 	Params:	 filename.type - the filename to open
     */
	//$imageLibObj = new imageLib($targetFile);


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
	//$imageLibObj -> resizeImage(300, 300, 'auto', true);


	/*	Purpose: Save image
     *	Usage:	 saveImage('[filename.type]', [quality])
     * 	Params:	 filename.type - the filename and file type to save as
 	 * 			 quality - (optional) 0-100 (100 being the highest (default))
     *				Only applies to jpg & png only
     */
    // $new_folder = $targetDir.$_SESSION['users_id'];
     		
	//	if(!file_exists($new_folder))
		//{ 
		  // mkdir($new_folder,0777);	
		//}	
    // $new_file = $new_folder.'/'.$fileName;
     
	//$imageLibObj -> saveImage($new_file, 100);
	
	 //  unlink($targetFile);

//////////////////////Resize Image//////////////////////////////////
		//	unset($info);
		//	unset($data);
		//$info['table']         = "products_images";
		//$data['users_id']      = $_SESSION['users_id'];
		//$data['products_id']   = $_SESSION['products_id'];
		//$data['file_name']     = str_replace("../../","",$new_file);
		//$data['order_no']      = get_order_no($db);
		//$data['uploaded']      = date("Y-m-d H:i:s");
		//$info['data']          =  $data;
		//$db->insert($info);
	//}
	
}


function check_file_extension($_files)
	{
	  foreach($_files as $key=>$name)
	  {
		 if(strlen($_files[$key]['name'])>0 && $_files[$key]['size']>0)
		 {
				 unset($arr);			
				 $arr = explode(".",$_files[$key]['name']);			
				 $extension = strtolower($arr[count($arr)-1]);			
				 if(!(  $extension == "png"  || $extension == "jpg" || $extension == "jpeg" || $extension == "gif"  ))
				 {
					 $_SESSION['extension'] = $extension;
					// echo '<font color="red"><h3>Error:'.$extension .' is not supported file</h3></font>';
					 return false;
				 }
		 }
		// echo $arr[count($arr)-1];
	  } 
	  return true;
	}
//Protect same image name
 function get_auto_increment($db)
	{
		$sql    = "SHOW TABLE STATUS LIKE 'products'";
		$result = $db->execQuery($sql);
		$row    = $db->resultArray();
		return $row[0]['Auto_increment'];	
	}
?>
