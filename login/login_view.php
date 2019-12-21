<?php
   include("../template/header.php");
   include("../template/top_menu.php");
?>
   
  </div>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="<?=$site_url?>/index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="<?=$site_url?>/login">Account</a></li>
        <li><a href="<?=$site_url?>/login">Login</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <h1 class="title">Account Login</h1>
          <div class="row">
            <div class="col-sm-6">
              <h2 class="subtitle">New Customer</h2>
              <p><strong>Register Account</strong></p>
              <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
              <a href="<?=$site_url?>/register" class="btn btn-primary">Continue</a> </div>
            <div class="col-sm-6">
              <h2 class="subtitle">Returning Customer</h2>
              <p><strong>I am a returning customer</strong></p>
                <div id="error" style="color:#DF1B1F"></div>
                <div class="form-group">
                  <label class="control-label" for="input-email">E-Mail Address</label>
                  <input type="text" name="email" id="input-email" value="" placeholder="E-Mail Address"  class="form-control" />
                </div>
                <div class="form-group">
                  <label class="control-label" for="input-password">Password</label>
                  <input type="password" name="password" id="input-password" value="" placeholder="Password"  class="form-control" />
                  <br />
                  <a href="<?=$site_url?>/forget_password">Forgotten Password</a>
                <input type="submit" value="Login" onClick="Login();" class="btn btn-primary" />
                <script language="javascript">
			function Login()
			{
				  if($("#input-email").val()==="" || $("#input-password").val()===""  )
				   {
					   toastr.options.timeOut = 1500;
                       toastr.error("Email & Password are required fields");	  	 
					   $("#error").html("Email & Password are required fields");
					   return 0;
				   }
	   
			   email     =  $("#input-email").val();
			   password  =  $("#input-password").val();
			   
				$.ajax({
						url: '<?=$site_url?>/login/',
						data: {
								cmd         : "login",  
								email       : email, 
								password	: password
							  },
						success: function(data) {
								Arr = JSON.parse(data);
								if (Arr['status'] === "success")
								{
									toastr.options.timeOut = 1500;
                                    toastr.success(Arr['msg']);	  	
									$("#error").html(Arr['msg']);
									<?php
									 if(count($_SESSION['cart'])>0)
										{
									?>
									  window.location.href = '<?=$site_url?>/member/cart';	
									<?php		
										}
									?>
									window.location.href = '<?=$site_url?>/';	
								}else
								{
									 toastr.options.timeOut = 1500;
                                     toastr.error(Arr['msg']);	  	
									 $("#error").html(Arr['msg']);
								}
						}
					});   
			   
			}
		</script>
                </div>
                <div class="form-group">
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

                    $permissions = ['email']; // Optional permissions
					$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);

                    echo '<a href="' . htmlspecialchars($loginUrl) . '"><img src="fb-btn.png" style="width:200px;" /></a>';
					
				?>
                </div>
            </div>
          </div>
           
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->
        <aside id="column-right" class="col-sm-3 hidden-xs">
          <h3 class="subtitle">Account</h3>
          <div class="list-group">
            <ul class="list-item">
              <li><a href="<?=$site_url?>/login.html">Login</a></li>
              <li><a href="<?=$site_url?>/register.html">Register</a></li>
              <li><a href="<?=$site_url?>/#">Forgotten Password</a></li>
              <li><a href="<?=$site_url?>/#">My Account</a></li>
              <li><a href="<?=$site_url?>/#">Address Books</a></li>
              <li><a href="<?=$site_url?>/wishlist.html">Wish List</a></li>
              <li><a href="<?=$site_url?>/#">Order History</a></li>
              <li><a href="<?=$site_url?>/#">Downloads</a></li>
              <li><a href="<?=$site_url?>/#">Reward Points</a></li>
              <li><a href="<?=$site_url?>/#">Returns</a></li>
              <li><a href="<?=$site_url?>/#">Transactions</a></li>
              <li><a href="<?=$site_url?>/#">Newsletter</a></li>
              <li><a href="<?=$site_url?>/#">Recurring payments</a></li>
            </ul>
          </div>
        </aside>
        <!--Right Part End -->
      </div>
    </div>
  </div>

<?php
   include("../template/footer.php");
?>