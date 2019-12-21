<?php
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
				
				$user1 = json_decode($response->getGraphUser());
				
				include("../common/lib.php");
				include("../lib/class.db.php");
				include("../common/config.php");
				
				
				$arr_name = explode(" ",$user1->name);
				$first_name = $arr_name[0];
				$last_name = $arr_name[1];
				$email = $user1->email;
				$password = rand(111111,99999999);
				
				
					unset($info);
					unset($data);
				$info["table"] = "users";
				$info["fields"] = array("users.*"); 
				$info["where"]   = "1 AND  email='".$email."'";
				$res =  $db->select($info);
				echo $email;
				
				if(count($res)==0)
				{
					   unset($info);
					   unset($data);
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
									
					$_SESSION["users_id"]   = $db->lastInsert($result);
					
					$_SESSION["email"]      = $res[0]["email"];
					$_SESSION["first_name"] = $first_name;
					$_SESSION["last_name"]  = $last_name;
					
					
				}
				else
				{
					   unset($info);
					   unset($data);
					$info["table"]     = "users";
					$info["fields"]   = array("*");
					$info["where"]    = " 1=1 AND email  LIKE BINARY '".$email."'";		
					$res  = $db->select($info);
					if(count($res)>0)
					{
						$_SESSION["users_id"]   = $res[0]["id"];
						$_SESSION["email"]      = $res[0]["email"];
						$_SESSION["first_name"] = $res[0]["first_name"];
						$_SESSION["last_name"]  = $res[0]["last_name"];
						$_SESSION["user_type"]  = $res[0]["user_type"];
					}
				}
				Header("Location:../member");
				
		}else{
			// Get Facebook login URL
			$fbLoginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
			
			// Redirect to Facebook login page
			echo '<a href="'.$fbLoginURL.'"><img src="fb-btn.png" /></a>';
		}
?>					