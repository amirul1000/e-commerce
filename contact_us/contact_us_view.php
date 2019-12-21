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
        <li><a href="contact-us.html">Contact Us</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <h1 class="title">Contact Us</h1>
          <h3 class="subtitle">Our Location</h3>
          <div class="row">
            <div class="col-sm-4">
              <div class="contact-info">
                <div class="contact-info-icon"><i class="fa fa-map-marker"></i></div>
                <div class="contact-detail">
                  <h4>Pata Corporation</h4>
                  <address>
                  Dhaka,<br />
                  amirrucst@gmail.com<br />                  
                  </address>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="contact-info">
                <div class="contact-info-icon"><i class="fa fa-phone"></i></div>
                <div class="contact-detail">
                  <h4>Telephone</h4>
                  Call: +1 989xxxxx898<br>
                  Fax: +1 98xxxxx9898 </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="contact-info">
                <div class="contact-info-icon"><i class="fa fa-clock-o"></i></div>
                <div class="contact-detail">
                  <h4>Opening Times</h4>
                  24X7 Customer Care </div>
              </div>
            </div>
          </div>
          <!--<form class="form-horizontal">-->
            <div id="error" style="color:#DF1B1F"></div>
            <fieldset>
              <h3 class="subtitle">Send us an Email</h3>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-name">Your Name</label>
                <div class="col-md-10 col-sm-9">
                  <input type="text" name="name" value="" id="input-name" placeholder="Your Name" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-email">E-Mail Address</label>
                <div class="col-md-10 col-sm-9">
                  <input type="text" name="email" value="" id="input-email" placeholder="E-Mail Address" class="form-control" />
                </div>
              </div>
              <div class="form-group required">
                <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">Enquiry</label>
                <div class="col-md-10 col-sm-9">
                  <textarea name="enquiry" rows="10" id="input-enquiry" placeholder="Write your message" class="form-control"></textarea>
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input class="btn btn-primary" type="submit" value="Submit"  onClick="ContactUs();" />
              </div>
            </div>
          <!--</form>-->
            <script language="javascript">
			function ContactUs()
			{
				  if($("#input-name").val()==="" || $("#input-email").val()===""  )
				   {
					   toastr.options.timeOut = 1500;
                       toastr.error("Name & email are required fields");	  	 
					   $("#error").html("Name & email are required fields");
					   return 0;
				   }
	   
			   name       =  $("#input-name").val();
			   email      =  $("#input-email").val();
			   enquiry    =  $("#input-enquiry").val();	 
			     
				$.ajax({
						url: '<?=$site_url?>/contact_us/',
						data: {
								cmd         : "contact",  
								name        : name, 
								email	    : email,
								enquiry	    : enquiry,
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
        <?php
			$info["table"] = "contact_us";
			$info["fields"] = array("contact_us.*"); 
			$info["where"]   = "1";
			$arr =  $db->select($info);
		    echo $arr[0]['content'];
		  ?>
        </div>
        <aside id="column-right" class="col-sm-3 hidden-xs">
          <div class="list-group">
            <h2 class="subtitle">Custom Content</h2>
            <p>This is a CMS block edited from admin. You can insert any content (HTML, Text, Images) Here. </p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
            <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
          </div>
          <div class="banner owl-carousel">
            <div class="item"> <a href="#"><img src="image/banner/small-banner1-265x350.jpg" alt="small banner" class="img-responsive" /></a> </div>
            <div class="item"> <a href="#"><img src="image/banner/small-banner-265x350.jpg" alt="small banner1" class="img-responsive" /></a> </div>
          </div>
        </aside>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php
   include("../template/footer.php");
?>
    