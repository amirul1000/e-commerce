<?php
   include("../template/header.php");
   include("../template/top_menu.php");
?>
   
  </div>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="login.html">Account</a></li>
        <li><a href="register.html">Register</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
          <h1 class="title">Register Account</h1>
          <p>If you already have an account with us, please login at the <a href="<?=$site_url?>/login">Login Page</a>.</p>
          <!--<form class="form-horizontal">-->
            <div id="error" style="color:#DF1B1F"></div>
            <fieldset id="account">
              <legend>Your Personal Details</legend>
              <div style="display: none;" class="form-group required">
                <label class="col-sm-2 control-label">Customer Group</label>
                <div class="col-sm-10">
                  <div class="radio">
                    <label>
                      <input type="radio" checked="checked" value="1" name="customer_group_id">
                      Default</label>
                  </div>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="" name="firstname">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="" name="lastname">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="" name="email">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="input-telephone" placeholder="Telephone" value="" name="telephone">
                </div>
              </div>
            </fieldset>
            <fieldset id="address">
              <legend>Your Address</legend>
              <div class="form-group">
                <label for="input-company" class="col-sm-2 control-label">Company</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-company" placeholder="Company" value="" name="company">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-address-1" class="col-sm-2 control-label">Address 1</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-address-1" placeholder="Address 1" value="" name="address_1">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-city" placeholder="City" value="" name="city">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-postcode" class="col-sm-2 control-label">Post Code</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-postcode" placeholder="Post Code" value="" name="postcode">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-zone" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                  <?php
					$info['table']    = "country";
					$info['fields']   = array("*");   	   
					$info['where']    =  "1=1 ORDER BY id ASC";
					$rescountry  =  $db->select($info);
				 ?>
				<select  name="country_id" id="country_id"   class="form-control">
					<option value="">--Select--</option>
					<?php
					   foreach($rescountry as $key=>$each)
					   { 
					?>
					  <option value="<?=$rescountry[$key]['id']?>" <?php if($rescountry[$key]['id']==$country_id){ echo "selected"; }?>><?=$rescountry[$key]['country']?></option>
					<?php
					 }
					?> 
				</select>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Your Password</legend>
              <div class="form-group required">
                <label for="input-password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password">
                </div>
              </div>
              <div class="form-group required">
                <label for="input-confirm" class="col-sm-2 control-label">Password Confirm</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="input-confirm" placeholder="Password Confirm" value="" name="confirm">
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Newsletter</legend>
              <div class="form-group">
                <label class="col-sm-2 control-label">Subscribe</label>
                <div class="col-sm-10">
                  <label class="radio-inline">
                    <input type="radio" value="1" name="newsletter">
                    Yes</label>
                  <label class="radio-inline">
                    <input type="radio" checked="checked" value="0" name="newsletter">
                    No</label>
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input type="checkbox" value="1" name="agree">
                &nbsp;I have read and agree to the <a class="agree" href="#"><b>Privacy Policy</b></a> &nbsp;
                <input type="submit" class="btn btn-primary" onClick="SignUp()" value="Continue">
              </div>
            </div>
          <!--</form>-->
          <script language="javascript">
			function SignUp()
			{
				
				if($("#input-email").val()===""   )
				   {
					   toastr.options.timeOut = 1500;
                       toastr.error("Email is required fields");	  	 
					   $("#error").html("Email is required fields");
					   return 0;
				   }
				   
				   if($("#input-firstname").val()===""   )
				   {
					   toastr.options.timeOut = 1500;
                       toastr.error("Firstname is required fields");	  	 
					   $("#error").html("Firstname is required fields");
					   return 0;
				   }
				   if($("#input-lastname").val()===""   )
				   {
					   toastr.options.timeOut = 1500;
                       toastr.error("Lastname is required fields");	  	 
					   $("#error").html("Lastname is required fields");
					   return 0;
				   }
				   if($("#input-password").val()===""   )
				   {
					   toastr.options.timeOut = 1500;
                       toastr.error("Password is required fields");	  	 
					   $("#error").html("Password is required fields");
					   return 0;
				   }
				   if($("#input-confirm").val()===""   )
				   {
					   toastr.options.timeOut = 1500;
                       toastr.error("Confirm is required fields");	  	 
					   $("#error").html("Confirm is required fields");
					   return 0;
				   }
				   
				
				
				email         =  $("#input-email").val();
				first_name    =  $("#input-firstname").val();
				last_name     =  $("#input-lastname").val();
				company       =  $("#input-company").val();
                address       =  $("#input-address-1").val();
                city          =  $("#input-city").val();
                zip           =  $("#input-postcode").val();
                country_id    =  $("#country_id").val();
                user_type     = 'client';
				password      =  $("#input-password").val();
				rpassword     =  $("#input-confirm").val();
				
				$.ajax({
						url: '<?=$site_url?>/register/',
						data: {
								cmd           : "register",  
								email         :  email,
								first_name    :  first_name,
								last_name     :  last_name,
								company       :  company,
								address       :  address,
								city          :  city,
								zip           :  zip,
								country_id    :  country_id,
								user_type     : 'client',
								password      :  password,
								rpassword     :  rpassword
							  },
						success: function(data) {
							    Arr = JSON.parse(data);
								if (Arr['status'] === "success")
								{
									toastr.options.timeOut = 1500;
                                    toastr.success(Arr['msg']);	  	
									$("#error").html(Arr['msg']);	
									setTimeout(function(){
									 	window.location.href = '<?=$site_url?>/login/';	
									},5000);
									
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
              <li><a href="login.html">Login</a></li>
              <li><a href="register.html">Register</a></li>
              <li><a href="#">Forgotten Password</a></li>
              <li><a href="#">My Account</a></li>
              <li><a href="#">Address Books</a></li>
              <li><a href="wishlist.html">Wish List</a></li>
              <li><a href="#">Order History</a></li>
              <li><a href="#">Downloads</a></li>
              <li><a href="#">Reward Points</a></li>
              <li><a href="#">Returns</a></li>
              <li><a href="#">Transactions</a></li>
              <li><a href="#">Newsletter</a></li>
              <li><a href="#">Recurring payments</a></li>
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