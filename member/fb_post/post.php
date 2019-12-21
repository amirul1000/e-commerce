<?php
	//session_destroy();
	//exit;
	error_reporting(0); 
	ini_set('display_errors', 1); 
	//require_once __DIR__ . '/../../facebook/graph-sdk/src/Facebook/Facebook.php';
	require_once '../../facebook/graph-sdk/src/Facebook/autoload.php';
	
	
	if(!session_id()){
		session_start();
	}
	
	
	
	// Include required libraries
	use Facebook\Facebook;
	use Facebook\Exceptions\FacebookResponseException;
	use Facebook\Exceptions\FacebookSDKException;
	
	/*
	 * Configuration and setup Facebook SDK
	 */
	$appId         = ''; //Facebook App ID
	$appSecret     = ''; //Facebook App Secret
	$redirectURL   = 'https://o2o.vharmonice.com/login/fb_login.php'; //Callback URL
	$fbPermissions = array('manage_pages,publish_pages');//	'manage_pages,publish_pages');   //Facebook permission
	
	$fb = new Facebook(array(
		'app_id' => $appId,
		'app_secret' => $appSecret,
		'default_graph_version' => 'v2.10',
	));
	
	// Get redirect login helper
	$helper = $fb->getRedirectLoginHelper();
	
	//echo $_SESSION['facebook_access_token'];
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
	
	echo $_SESSION['facebook_access_token'];
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
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
		
		//FB post content
		$message = 'Test message from CodexWorld.com website';
		$title = 'Post From Website';
		$link = 'http://www.codexworld.com/';
		$description = 'CodexWorld is a programming blog.';
		$picture = 'http://www.codexworld.com/wp-content/uploads/2015/12/www-codexworld-com-programming-blog.png';
				
		$attachment = array(
			'message' => $message,
			'name' => $title,
			'link' => $link,
			'description' => $description,
			'picture'=>$picture,
		);
		
		try{
			// Post to Facebook
			$fb->post('/702950819908152/feed', $attachment, $accessToken);
			
			// Display post submission status
			echo 'The post was published successfully to the Facebook timeline.';
		}catch(FacebookResponseException $e){
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		}catch(FacebookSDKException $e){
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
	}else{
		// Get Facebook login URL
		$fbLoginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
		
		// Redirect to Facebook login page
		echo '<a href="'.$fbLoginURL.'"><img src="fb-btn.png" /></a>';
	}
	
	//use Facebook\Facebook; 
	  /*$userAccessToken='EAAGKNkjG7hQBAP6kcYE6WJu2mFAiAErcqRBe14xEvF67aZBOR2cuIYC3dZBdIqUHcxGCyaa8Ndo7XSPmBnlECWTySO5cCXXPLPVzSZBdgfE5jOdrLx5kqZBCpsJOBntGZA5VJBLoyftm3htrK0VxkMeIXeOZBgcnwfzAHsH2JfrwZDZD';
	  $config['app_id']  = '433440730574356';
	  $config['app_secret'] = '5f3033a4fbbe390d8465c54f8c75cf08';
	  $config['default_access_token'] = '433440730574356|Xi8SubzLQfg3X8ubO_sczrg-O88';
	  $obj = new Facebook($config);*/
	 
	  /* echo "<pre>";
		print_r($obj->getDefaultAccessToken());
	  echo "</pre>";*/
	  
	  
	  ///////////////////////////////////////
		/*$appId  = '433440730574356';
		$appSecret = '5f3033a4fbbe390d8465c54f8c75cf08';
		
		$pageId="868328139873961";
		
		$fb = new Facebook([
			  'app_id' => '433440730574356',
			  'app_secret' => '5f3033a4fbbe390d8465c54f8c75cf08',
			  'default_graph_version' => 'v2.10',
			  ]);
			
			$helper = $fb->getCanvasHelper();
			
			try {
			  $accessToken = $helper->getAccessToken();
			} catch(Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}
			
			if (! isset($accessToken)) {
			  echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
			  exit;
			}
			
			// Logged in
			echo '<h3>Signed Request</h3>';
			var_dump($helper->getSignedRequest());
			
			echo '<h3>Access Token</h3>';
			var_dump($accessToken->getValue());*/
	  
?>