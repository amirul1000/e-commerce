<?php
	session_start();
	ob_start();
	include("../common/lib.php");
	include("../lib/class.db.php");
	include("../common/config.php");
	include("../lib_cat/lib.php");
	include("../lib_products/lib.php");
	
	$cmd = $_REQUEST['cmd'];
	
	switch($cmd)
	{
	
		case "register":	
				$first_name = trim($_REQUEST["first_name"]);
				$last_name = trim($_REQUEST["last_name"]);
				$email = trim($_REQUEST["email"]);
				$password = trim($_REQUEST["password"]);
				$user_type = trim($_REQUEST["user_type"]);
				
					unset($info);
					unset($data);
				$info["table"] = "users";
				$info["fields"] = array("users.*"); 
				$info["where"]   = "1 AND  email='".$email."'";	
				$res =  $db->select($info);
				
				if(count($res)==0)
				{
					   $info['table']    = "users";
					$data['first_name']   = $first_name;
					$data['last_name']   = $last_name;
					$data['email']   = $email;
					$data['password']   = $password;
					 $data['company']   = $_REQUEST['company'];
					$data['address']   = $_REQUEST['address'];
					$data['city']   = $_REQUEST['city'];
					$data['state']   = $_REQUEST['state'];
					$data['zip']   = $_REQUEST['zip'];
					$data['country_id']   = $_REQUEST['country_id'];
					$data['user_type']   = $user_type;
					$data['created_at']   = date("Y-m-d H:i:s");
					$info['data']     =  $data;
					 $db->insert($info);
					 
					$arr['status'] = "success";
				    $arr['msg']    = "Registration has been completed successfully";
				}
				else
				{
					$arr['status'] = "fail";
				    $arr['msg']    = "Error-Duplicate username";
				}	
		       echo json_encode($arr);
			break;
		default :
			include("register_view.php");
	}
	/*
	  check user plan exits
	*/
	function clean($db,$str) {
				$str = @trim($str);
				if(get_magic_quotes_gpc()) {
					$str = stripslashes($str);
				}
				$str = stripslashes($str);
				$str = str_replace("'","",$str);
				$str = str_replace('"',"",$str);
				//$str = str_replace("-","",$str);
				$str = str_replace(";","",$str);
				$str = str_replace("or 1","",$str);
				$str = str_replace("drop","",$str);
				
				return mysqli_real_escape_string($db->linkid,$str);
		}		
?>