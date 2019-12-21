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
		case "contact":
				$subject = $_REQUEST['name'];
				$body = $_REQUEST['enquiry'];
				//send email
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: o2 <info@o2.com>' . "\r\n";
				
				mail($_REQUEST["email"], $subject, $body, $headers);
				$arr['status'] = "success";
				$arr['msg']    = "An email has been sent to your E-mail address";
				echo json_encode($arr);
		      break;
		default :
			include("contact_us_view.php");
	}
?>