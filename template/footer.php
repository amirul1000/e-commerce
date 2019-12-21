<!--Footer Start-->
  <footer id="footer">
    <div class="fpart-first">
      <div class="container">
        <div class="row">
          <div class="contact col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <h5>Contact Details</h5>
            <ul>
              <li class="address"><i class="fa fa-map-marker"></i>Dhaka</li>
              <li class="mobile"><i class="fa fa-phone"></i>+1 8909xx1111</li>
              <li class="email"><i class="fa fa-envelope"></i>Send email via our <a href="<?=$site_url?>/contact_us">Contact Us</a>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>Information</h5>
            <ul>
              <li><a href="<?=$site_url?>/about_us">About Us</a></li>
              <li><a href="<?=$site_url?>/delivery_information">Delivery Information</a></li>
              <li><a href="<?=$site_url?>/privacy_policy">Privacy Policy</a></li>
              <li><a href="<?=$site_url?>/terms_condition">Terms &amp; Conditions</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>Customer Service</h5>
            <ul>
              <li><a href="<?=$site_url?>/contact_us">Contact Us</a></li>
              <li><a href="<?=$site_url?>/returns">Returns</a></li>
              <li><a href="<?=$site_url?>/sitemap">Site Map</a></li>
              <li>
                  <a href="javascript:void(0)" onclick="openForm()">
                     <i class="fa fa-comments-o fa-5" aria-hidden="true"></i>
                  </a>
              </li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5>Extras</h5>
            <ul>
              <li><a href="<?=$site_url?>/manufacturer">Brands</a></li>
              <li><a href="<?=$site_url?>/gift_voucher">Gift Vouchers</a></li>
              <li><a href="<?=$site_url?>/affiliate">Affiliates</a></li>
            </ul>
          </div>
          <div class="column col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <h5>Newsletter</h5>
            <div class="form-group">
            <label class="control-label" for="subscribe">Sign up to receive latest news and updates.</label>
            <input   id="email" type="email" required="" placeholder="Email address" name="email" class="form-control">
            </div>
            <input type="submit" value="Subscribe" onClick="subcribe();" class="btn btn-primary">
          </div>
          <script>
			  function subcribe()
				{
					if($("#email").val()=="")
					{
						toastr.options.timeOut = 3000;
						toastr.error("Email is a required field");
						return;
					}
					
					if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())))
					  {
						toastr.options.timeOut = 3000;
						toastr.error("You have entered an invalid email address!");
						return;
					  }
					

					  $.ajax({
							  headers: {
								   "Access-Control-Allow-Origin": "*",
								   "Access-Control-Allow-Methods": "GET, POST, PUT",
								   "Access-Control-Allow-Headers": "Content-Type",
							   },
							  method: "POST",
							  url: "<?=$site_url?>/subscription/",
							  data:{
										cmd             : 'add',
										email           : $("#email").val()
								   },
							  dataType: 'json',
							  timeout: 10000,
							  async : true,
							  success: function (data) {
									   obj = eval(data);
									   if(obj[0].status == "success")
										 {
											toastr.options.timeOut = 3000;
											toastr.success(obj[0].msg);
										 }
										 else if(obj[0].status == "fail")
										 {
											 toastr.options.timeOut = 3000;
											 toastr.error(obj[0].msg);
										 }
						  },
						  error: function (jqXHR, exception) { 
								  if(jqXHR.status==0)
								  {
									alert(JSON.stringify(jqXHR));
								  }
							  }
					   });
				}
			</script>
        </div>
      </div>
    </div>
    <div class="fpart-second">
      <div class="container">
        <div id="powered" class="clearfix">
          <div class="powered_text pull-left flip">
            <p>Pata Corporation.all right reserved @2019</p>
          </div>
          <!--<div class="social pull-right flip"> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/socialicons/facebook.png" alt="Facebook" title="Facebook"></a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/socialicons/twitter.png" alt="Twitter" title="Twitter"> </a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/socialicons/google_plus.png" alt="Google+" title="Google+"> </a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/socialicons/pinterest.png" alt="Pinterest" title="Pinterest"> </a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/socialicons/rss.png" alt="RSS" title="RSS"> </a> </div>-->
        </div>
        <!--
        <div class="bottom-row">
          <div class="custom-text text-center">
            <p>This is a CMS block. You can insert any content (HTML, Text, Images) Here. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
          </div>
          <div class="payments_types"> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/payment/payment_paypal.png" alt="paypal" title="PayPal"></a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/payment/payment_american.png" alt="american-express" title="American Express"></a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/payment/payment_2checkout.png" alt="2checkout" title="2checkout"></a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/payment/payment_maestro.png" alt="maestro" title="Maestro"></a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/payment/payment_discover.png" alt="discover" title="Discover"></a> <a href="<?=$site_url?>/#" target="_blank"> <img data-toggle="tooltip" src="<?=$site_url?>/image/payment/payment_mastercard.png" alt="mastercard" title="MasterCard"></a> </div>
        </div>
        -->        
      </div>
    </div>
    
    <div id="back-top"><a data-toggle="tooltip" title="Back to Top" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
  </footer>
  <!--Footer End-->
  <!-- Facebook Side Block Start -->
  <!--<div id="facebook" class="fb-left sort-order-1">
    <div class="facebook_icon"><i class="fa fa-facebook"></i></div>
    <div class="fb-page" data-href="<?=$site_url?>/https://www.facebook.com/harnishdesign/" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true" data-show-posts="false">
      <div class="fb-xfbml-parse-ignore">
        <blockquote cite="https://www.facebook.com/harnishdesign/"><a href="<?=$site_url?>/https://www.facebook.com/harnishdesign/">Harnish Design</a></blockquote>
      </div>
    </div>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  </div>-->
  <!-- Facebook Side Block End -->
  <!-- Twitter Side Block Start -->
  <!--<div id="twitter_footer" class="twit-left sort-order-2">
    <div class="twitter_icon"><i class="fa fa-twitter"></i></div>
    <a class="twitter-timeline" href="<?=$site_url?>/https://twitter.com/" data-chrome="nofooter noscrollbar transparent" data-theme="light" data-tweet-limit="2" data-related="twitterapi,twitter" data-aria-polite="assertive" data-widget-id="347621595801608192">Tweets by @</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  </div>-->
  <!-- Twitter Side Block End -->
  <!-- Video Side Block Start -->
  <!--<div id="video_box" class="vb-left sort-order-3">
    <div id="video_box_icon"><i class="fa fa-play"></i></div>
    <p>
      <iframe allowfullscreen="" src="<?=$site_url?>///www.youtube.com/embed/SZEflIVnhH8" height="315" width="560"></iframe>
    </p>
  </div>-->
  <!-- Video Side Block End -->
  <!-- Custom Side Block Start -->
  <!--<div id="custom_side_block" class="custom_side_block_left sort-order-4">
    <div class="custom_side_block_icon"> <i class="fa fa-chevron-right"></i> </div>
    <table>
      <tbody>
        <tr>
          <td><h2>CMS Blocks</h2></td>
        </tr>
        <tr>
          <td><img alt="" src="<?=$site_url?>/image/banner/cms-block.jpg"></td>
        </tr>
        <tr>
          <td><p>This is a CMS block. You can insert any content (HTML, Text, Images) Here.</p></td>
        </tr>
        <tr>
          <td><strong><a href="<?=$site_url?>/#" class="btn btn-sm btn-primary">Read More</a></strong></td>
        </tr>
      </tbody>
    </table>
  </div>-->
  <!-- Custom Side Block End -->
</div>
<!-- JS Part Start-->
<script type="text/javascript" src="<?=$site_url?>/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/jquery.dcjqaccordion.min.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/custom.js"></script>
<script type="text/javascript" src="<?=$site_url?>/js/toastr.js"></script>


<!--Chatbot--->
<style>

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 8px 10px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 0px;
  right: 60px;
  width: 100px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9999999 !important;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  //min-height: 400px;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 100px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.chatmsg{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 100px;
}

.chatlabel{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #2ED046;
  resize: none;
}
</style>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->

<button class="open-button" onclick="openForm()"><i class="fa fa-comments-o fa-5" aria-hidden="true"></i> Chat</button>

<div class="chat-popup" id="myForm" style="z-index: 99999 !important;background:#fff;">
  
  <h3 class="chatlabel">Chat</h3>
  <div id="chatmsg" class="chatmsg"  style="z-index: 99999 !important;"></div>
  <form action="javascript:void();" class="form-container"  style="z-index: 99999 !important;">
    
    <label for="msg"><b>Message</b></label>
    <textarea placeholder="Type message.." name="msg" id="msg" required></textarea>

    <button type="submit" class="btn">Send</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
  
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

$(document).ready(function() {

	$(".btn").on('click',function(e){
		if($("#msg").val()=="")
		{
			return;
		}
	   $("#chatmsg").append("You:"+$("#msg").val()+"<br>");
	   sendReceive($("#msg").val());
	   $("#msg").val("");
	});
});

function sendReceive(msg)
{
	$.post( "<?=$site_url?>/chatbot/index.php", { msg: msg })
	  .done(function( data ) {
		//alert( "Data Loaded: " + data );
		var len = $("#chatmsg").html().length;
		if(len>400)
		{
		   $("#chatmsg").html( $("#chatmsg").html().substring(len-200, len-1));
		}
		$("#chatmsg").append(data+"<br>");
	  }).fail(function( data ) {
		alert( "Data Loaded Fail");
	  });
}
</script>
<!--Chatbot-->
</body>
</html>