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
	
		case "login":
			$info["table"]     = "users";
			$info["fields"]   = array("*");
			$info["where"]    = " 1=1 AND email  LIKE BINARY '".clean($db,$_REQUEST["email"])."' AND password  LIKE BINARY '".clean($db,$_REQUEST["password"])."'";			
			$res  = $db->select($info);
			if(count($res)>0)
			{
				$_SESSION["users_id"]   = $res[0]["id"];
				$_SESSION["email"]      = $res[0]["email"];
				$_SESSION["first_name"] = $res[0]["first_name"];
				$_SESSION["last_name"]  = $res[0]["last_name"];
				$_SESSION["user_type"]       = $res[0]["user_type"];
				
				//Header("Location: ../index.php");
				$arr['status'] = "success";
				$arr['msg']    = "Login sucessfully";
			}
			else
			{
				$arr['status'] = "fail";
				$arr['msg']    = "Login fail,Please verify your userid or password";
			}
			echo json_encode($arr);
			break;
	    /*case "fb_login":
					//session_destroy();
					//exit;
					error_reporting(E_ALL); 
					ini_set('display_errors', 1); 
					//require_once __DIR__ . '/../../facebook/graph-sdk/src/Facebook/Facebook.php';
					require_once '../facebook/graph-sdk/src/Facebook/autoload.php';
					
					
					if(!session_id()){
						session_start();
					}
					
					
					
					// Include required libraries
					use Facebook\Facebook;
					use Facebook\Exceptions\FacebookResponseException;
					use Facebook\Exceptions\FacebookSDKException;

					
					$appId         = '433440730574356'; //Facebook App ID
					$appSecret     = '5f3033a4fbbe390d8465c54f8c75cf08'; //Facebook App Secret
					$redirectURL   = 'https://o2o.vharmonice.com/login/fb_login.php'; //Callback URL
					$fbPermissions = array('email');//	'manage_pages,publish_pages');   //Facebook permission
					
					$fb = new Facebook(array(
						'app_id' => $appId,
						'app_secret' => $appSecret,
						'default_graph_version' => 'v2.10',
					));
			   
			        $helper = $fb->getRedirectLoginHelper();
					//echo "<br>";
					// Try to get access token
					try {
						if(isset($_SESSION['facebook_access_token'])){
							$accessToken = $_SESSION['facebook_access_token'];
						}else{
							$accessToken = $helper->getAccessToken();
						}
					} catch(FacebookResponseException $e) {
						 echo 'Graph returned an error: ' . $e->getMessage();
						  exit;
					} catch(FacebookSDKException $e) {
						echo 'Facebook SDK returned an error: ' . $e->getMessage();
						  exit;
					}
					
					if(isset($accessToken)){
						if(isset($_SESSION['facebook_access_token'])){
							$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
						}else{
							// Put short-lived access token in session
							$_SESSION['facebook_access_token'] = (string) $accessToken;
							
							// OAuth 2.0 client handler helps to manage access tokens
							$oAuth2Client = $fb->getOAuth2Client();
							
							// Exchanges a short-lived access token for a long-lived one
							$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
							$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
							
							// Set default access token to be used in script
							$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
						}
    
  
    
					  try {
							  // Returns a `Facebook\FacebookResponse` object
							  $response = $fb->get('/me?fields=id,name,email', $_SESSION['facebook_access_token']);
							} catch(Facebook\Exceptions\FacebookResponseException $e) {
							  echo 'Graph returned an error: ' . $e->getMessage();
							  exit;
							} catch(Facebook\Exceptions\FacebookSDKException $e) {
							  echo 'Facebook SDK returned an error: ' . $e->getMessage();
							  exit;
							}
							
							$user = $response->getGraphUser();
							
							echo 'Name: ' . $user['name'];  
						  //echo $_SESSION['facebook_access_token'];
					}else{
						// Get Facebook login URL
						$fbLoginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
						
						// Redirect to Facebook login page
						echo '<a href="'.$fbLoginURL.'"><img src="fb-btn.png" /></a>';
					}
		      break;*/		
		case "logout":
			session_destroy();
			unset($_SESSION["users_id"]);
			unset($_SESSION["email"]);
			unset($_SESSION["first_name"]);
			unset($_SESSION["last_name"]);
			unset($_SESSION["user_type"]);
	
			include("login_view.php");
			break;
		default :
			include("login_view.php");
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