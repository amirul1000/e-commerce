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
          <h1 class="title">Forget password</h1>
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
                  <br />
                  <a href="<?=$site_url?>/login">Login</a></div>
                <input type="submit" value="Retrive Password" onClick="ForgetPassword();" class="btn btn-primary" />
            </div>
          </div>
          <script language="javascript">
			function ForgetPassword()
			{
				  if($("#input-email").val()===""  )
				   {
					   toastr.options.timeOut = 1500;
                       toastr.error("Email is required field");	  	 
					   $("#error").html("Email is required field");
					   return 0;
				   }
	   
			   email     =  $("#input-email").val();
					   
				$.ajax({
						url: '<?=$site_url?>/forget_password/',
						data: {
								cmd         : "forget_pass",  
								email       : email
							  },
						success: function(data) {
								Arr = JSON.parse(data);
								if (Arr['status'] === "success")
								{
									toastr.options.timeOut = 1500;
                                    toastr.success(Arr['msg']);	  	
									$("#error").html(Arr['msg']);
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