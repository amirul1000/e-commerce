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
	
		case "forget_pass":
		        $info["table"]     = "users";
				$info["fields"]   = array("*");
				$info["where"]    = " 1=1 AND email  LIKE BINARY '".$_REQUEST["email"]."'";
				$res  = $db->select($info);
				if(count($res)>0)
				{
					$first_name    = $res[0]["first_name"];
					$last_name     = $res[0]["last_name"];
					$email         = $res[0]["email"];
					$password      = $res[0]["password"];
					
					$subject = "Recovery Password from o2";
					
					$body = "Dear $first_name $last_name,<br>
							Your Login information is like below:<br> 
							 Email:$email<br> 
							 password:$password<br><br>
							 
							 Thanks,<br>
							 o2 Team";
					//send email
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: o2 <info@o2.com>' . "\r\n";
						
					mail($_REQUEST["email"], $subject, $body, $headers);
					$arr['status'] = "success";
				    $arr['msg']    = "An email has been sent to your E-mail address";	
				}
				else
				{
				   $arr['status'] = "fail";
				   $arr['msg']    = "No email is found with this address";
				}
				echo json_encode($arr);
				break;
		default :
			include("forget_password_view.php");
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