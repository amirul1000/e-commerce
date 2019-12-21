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
	     case "load":
				$info["table"] = "news_letter";
				$info["fields"] = array("news_letter.*"); 
				$info["where"]   = "1 AND id='".$_REQUEST['news_letter']."'";
				$arr =  $db->select($info);
				$content = $arr[0]['content'];
		    include("send_newsletter_view.php");		         
			break;			
		 case "send":
		    $info["table"] = "subscription";
			$info["fields"] = array("subscription.*"); 
			$info["where"]   = "1";
			$arr =  $db->select($info);
			for($i=0;$i<count($arr);$i++)
			{
				$email = $arr[$i]['email'];
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				// Additional headers
				//$headers .= 'To: '.$data['email'].'' . "\r\n";
				$headers .= 'From: Picdlocal <news@picdlocal.com>' . "\r\n";
				//$headers .= 'Cc: Casey@picdlocal.com' . "\r\n";
				//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
				
				// Mail it
				$subject = "Picdlocal";
				
				
				$message_body  = $_REQUEST['content'];					
				$staus = mail($email, $subject, $message_body, $headers);
				
								
			}
			$msg = "News letter has been sent successfully";
		 	include("send_newsletter_view.php");		         
			break;
	     default :    
		       include("send_newsletter_view.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {	  
   $sql    = "SHOW TABLE STATUS LIKE 'news_letter'";
	$result = $db->execQuery($sql);
	$row    = $db->resultArray();
	return $row[0]['Auto_increment'];	   
 } 	 
?>
