<!DOCTYPE html>
<html>
<head>
<?php
   //debug($_SERVER);

  if($_SERVER['HTTP_HOST']=='localhost')
  {
   	$site_url = "http://".$_SERVER['HTTP_HOST']."/git_ecommerce";
  }
  else
  {
	if($_SERVER['HTTPS']=='on')
	{
		$site_url = "https://".$_SERVER['HTTP_HOST'];
	}
	else
	{
		$site_url = "http://".$_SERVER['HTTP_HOST'];
	}
  }
?>
<meta charset="UTF-8" />
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="<?=$site_url?>/image/favicon.png" rel="icon" />
<?php
  $b_name_file = $_SERVER['SCRIPT_FILENAME'];
  $doc_root    = $_SERVER['DOCUMENT_ROOT'];
  $b_name_path      = str_replace($doc_root,"",$b_name_file);
  
  /*$b_name_file = basename($_SERVER['SCRIPT_FILENAME']);
  $b_name_arr  = explode(".",$b_name_file);
  $b_name      = $b_name_arr[0];*/
  
  $b_name = str_replace("/"," ",$b_name_path);
  $b_name = str_replace(".php","",$b_name);
  $b_name = str_replace("index","",$b_name);
  $b_name = ucfirst(str_replace("_"," ",$b_name));
  
?>
<title><?=$b_name?></title>
<meta name="description" content="Responsive and clean html template design for any kind of ecommerce webshop">

<!-- CSS Part Start-->
<link rel="stylesheet" type="text/css" href="<?=$site_url?>/js/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/owl.transitions.css" />
<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/responsive.css" />
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans' type='text/css'>

<link rel="stylesheet" type="text/css" href="<?=$site_url?>/css/toastr.css" />
<!-- CSS Part End-->

<script>
	  function formSubmit(frm)
		{
			var form = $("#"+frm.toString());
			var myForm = document.getElementById(frm.toString());
            formData = new FormData(myForm);
			
			var result = {};
			for (var entry of formData.entries())
			{
				result[entry[0]] = entry[1];
			}
			
			
			$("#item").html(parseInt($("#item").html())+1);
			$("#price").html(parseFloat($("#price").html())+parseFloat(result['amount']));
			
			  $.ajax({
					  headers: {
						   "Access-Control-Allow-Origin": "*",
						   "Access-Control-Allow-Methods": "GET, POST, PUT",
						   "Access-Control-Allow-Headers": "Content-Type",
					   },
					  method: "POST",
					  url: "<?=$site_url?>/member/cart/add_to_cart.php",
					  data:{
								cmd             : result['cmd'],
								quantity        : result['quantity'],     
								os0             : result['os0'],
								currency        : result['currency'], 
								amount          : result['amount'], 
								shipping_charge : result['shipping_charge'], 
								item_name       : result['item_name'], 
								item_number     : result['item_number'],
								products_id     : result['products_id']
							   
					       },
					  dataType: 'json',
					  timeout: 10000,
					  async : true,
					  success: function (data) {
							   obj = eval(data);
							   if(obj[0]['status'] == "success")
								 {
									toastr.options.timeOut = 3000;
									toastr.success(obj[0].msg);
									
									$(".item_count").html(parseInt($(".item_count").html())+1);
								 }
								 else if(obj[0]['status'] == "fail")
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

</head>
<body>
<div class="wrapper-wide">
  <div id="header">
    <!-- Top Bar Start-->
    <nav id="top" class="htop">
      <div class="container">
        <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
          <div class="pull-left flip left-top">
            <div class="links">
              <ul>
                <li class="mobile"><i class="fa fa-phone"></i>+91 9898777656</li>
                <li class="email"><a href="mailto:info@marketshop.com"><i class="fa fa-envelope"></i>info@marketshop.com</a></li>
                <li class="wrap_custom_block hidden-sm hidden-xs"><a>Custom Block<b></b></a>
                  <div class="dropdown-menu custom_block">
                    <ul>
                      <li>
                        <table>
                          <tbody>
                            <tr>
                              <td><img alt="" src="<?=$site_url?>/image/banner/cms-block.jpg"></td>
                              <td><img alt="" src="<?=$site_url?>/image/banner/responsive.jpg"></td>
                            </tr>
                            <tr>
                              <td><h4>CMS Blocks</h4></td>
                              <td><h4>Responsive Template</h4></td>
                            </tr>
                            <tr>
                              <td>This is a CMS block. You can insert any content (HTML, Text, Images) Here.</td>
                              <td>This is a CMS block. You can insert any content (HTML, Text, Images) Here.</td>
                            </tr>
                            <tr>
                              <td><strong><a class="btn btn-default btn-sm" href="<?=$site_url?>/#">Read More</a></strong></td>
                              <td><strong><a class="btn btn-default btn-sm" href="<?=$site_url?>/#">Read More</a></strong></td>
                            </tr>
                          </tbody>
                        </table>
                      </li>
                    </ul>
                  </div>
                </li>
                <li><a href="<?=$site_url?>/#">Wish List (0)</a></li>
                <li><a href="<?=$site_url?>/checkout.html">Checkout</a></li>
              </ul>
            </div>
            <div id="language" class="btn-group">
              <button class="btn-link dropdown-toggle" data-toggle="dropdown"> <span> <img src="<?=$site_url?>/image/flags/gb.png" alt="English" title="English">English <i class="fa fa-caret-down"></i></span></button>
              <ul class="dropdown-menu">
                <li>
                  <button class="btn btn-link btn-block language-select" type="button" name="GB"><img src="<?=$site_url?>/image/flags/gb.png" alt="English" title="English" /> English</button>
                </li>
                <li>
                  <button class="btn btn-link btn-block language-select" type="button" name="GB"><img src="<?=$site_url?>/image/flags/ar.png" alt="Arabic" title="Arabic" /> Arabic</button>
                </li>
              </ul>
            </div>
            <div id="currency" class="btn-group">
              <button class="btn-link dropdown-toggle" data-toggle="dropdown"> <span> $ USD <i class="fa fa-caret-down"></i></span></button>
              <ul class="dropdown-menu">
                <li>
                  <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro</button>
                </li>
                <li>
                  <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound Sterling</button>
                </li>
                <li>
                  <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US Dollar</button>
                </li>
              </ul>
            </div>
          </div>
          <div id="top-links" class="nav pull-right flip">
            <ul>
              <?php
			    if(empty($_SESSION["users_id"]))
				{
			  ?>
              <li><a href="<?=$site_url?>/login">Login</a></li>
              <li><a href="<?=$site_url?>/register">Register</a></li>
              <?php
				}
				else
				{
			  ?>
              <li><a href="<?=$site_url?>/login?cmd=logout">Logout</a></li>
              <li><a href="<?=$site_url?>/member">Member area</a></li>
              <?php		
				}
			  ?>	
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- Top Bar End-->
    <!-- Header Start-->
    <header class="header-row">
      <div class="container">
        <div class="table-container">
          <!-- Logo Start -->
          <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
            <div id="logo"><a href="<?=$site_url?>/"><img class="img-responsive" src="<?=$site_url?>/image/logo.png" title="MarketShop" alt="MarketShop" /></a></div>
          </div>
          <!-- Logo End -->
          <!-- Mini Cart Start-->
          <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div id="cart">
              <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle">
              <span class="cart-icon pull-left flip"></span>
              <span id="cart-total"> <span id="item"><?=count($_SESSION['cart'])?></span> item(s)
                                      - $<span id="price">
                                        <?php
										  for($i=0;$i<count($_SESSION['cart']);$i++)
										  {
											  $total =  $total + $_SESSION['cart'][$i]['amount'];
										  }
										  echo $total;
										?>
                                        </span></span></button>
              <ul class="dropdown-menu">
                <li>
                  <table class="table">
                    <tbody>
                      <!--<tr>
                        <td class="text-center"><a href="<?=$site_url?>/product.html"><img class="img-thumbnail" title="Xitefun Causal Wear Fancy Shoes" alt="Xitefun Causal Wear Fancy Shoes" src="<?=$site_url?>/image/product/sony_vaio_1-50x50.jpg"></a></td>
                        <td class="text-left"><a href="<?=$site_url?>/product.html">Xitefun Causal Wear Fancy Shoes</a></td>
                        <td class="text-right">x 1</td>
                        <td class="text-right">$902.00</td>
                        <td class="text-center"><button class="btn btn-danger btn-xs remove" title="Remove" onClick="" type="button"><i class="fa fa-times"></i></button></td>
                      </tr>
                      <tr>
                        <td class="text-center"><a href="<?=$site_url?>/product.html"><img class="img-thumbnail" title="Aspire Ultrabook Laptop" alt="Aspire Ultrabook Laptop" src="<?=$site_url?>/image/product/samsung_tab_1-50x50.jpg"></a></td>
                        <td class="text-left"><a href="<?=$site_url?>/product.html">Aspire Ultrabook Laptop</a></td>
                        <td class="text-right">x 1</td>
                        <td class="text-right">$230.00</td>
                        <td class="text-center"><button class="btn btn-danger btn-xs remove" title="Remove" onClick="" type="button"><i class="fa fa-times"></i></button></td>
                      </tr>-->
                    </tbody>
                  </table>
                </li>
                <li>
                  <div>
                    <!--<table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td class="text-right"><strong>Sub-Total</strong></td>
                          <td class="text-right">$940.00</td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
                          <td class="text-right">$4.00</td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>VAT (20%)</strong></td>
                          <td class="text-right">$188.00</td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>Total</strong></td>
                          <td class="text-right">$1,132.00</td>
                        </tr>
                      </tbody>
                    </table>-->
                    <p class="checkout"><a href="<?=$site_url?>/member/cart" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> View Cart</a>&nbsp;&nbsp;&nbsp;<a href="<?=$site_url?>/member/cart" class="btn btn-primary"><i class="fa fa-share"></i> Checkout</a></p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <!-- Mini Cart End-->
          <!-- Search Start-->
          <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12 inner">
            <div id="search" class="input-group">
                <style>
				//.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
				#data-list{
					float:left;
					list-style:none;
					//margin-top:-3px;
					padding-top:20px !important;
					width:190px;
					position: absolute;
					z-index:9999;
					}
				#data-list li{
					padding: 10px; 
					background: #f0f0f0;
					border-bottom: #bbb9b9 1px solid;
					 }
				#data-list li:hover{
					background:#ece3d2;
					cursor: pointer;
					}
				#search-box{
					padding: 10px;
					border: #a8d4b1 1px solid;
					border-radius:4px;
				}
				#suggesstion-box{
					  padding-top:20px;
					}
				</style>
                <div class="frmSearch">
                    <input type="text" id="search-box" name="search-key"  placeholder="Search" class="form-control input-lg"  />
                    <button type="button" class="button-search" onClick="searchProducts();"><i class="fa fa-search"></i></button>
                <div id="suggesstion-box"></div>
                </div>
              <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
			  <script>
                $(document).ready(function(){
                    $("#search-box").keyup(function(){
                        $.ajax({
                        type: "POST",
                        url: "<?=$site_url?>/search/index.php?cmd=product_autocomplete",
                        data:'q='+$(this).val(),
                        beforeSend: function(){
                            $("#search-box").css("background","#FFF url('<?=$site_url?>/jquery-autocomplete-r3.2.2/LoaderIcon.gif') no-repeat 165px");
                        },
                        success: function(data){
                            $("#suggesstion-box").show();
                            $("#suggesstion-box").html(data);
                            $("#search-box").css("background","#FFF");
                        }
                        });
                    });
                });
                
                function selectData(val) {
                $("#search-box").val(val);
                $("#suggesstion-box").hide();
                }
				
				function searchProducts()
				{
					window.location.href = "<?=$site_url?>/search/?search-key="+$("#search-box").val();
				}
                </script>
              <!--<form>
              <input  type="text" id="ac1" name="search_key"  value="<?=$_SESSION['search_key']?>" placeholder="Search" class="form-control input-lg" />
              <button type="button" class="button-search"><i class="fa fa-search"></i></button>
              </form>

			   <script type="text/javascript" src="<?=$site_url?>/js/jquery-2.1.1.min.js"></script>	   
			   <script type="text/javascript" src="<?=$site_url?>/jquery-autocomplete-r3.2.2/jquery.autocomplete.js"></script>
               <link rel="stylesheet" type="text/css" href="<?=$site_url?>/jquery-autocomplete-r3.2.2/jquery.autocomplete.css">
				 <script type="text/javascript">    
                // $.noConflict();
                 jQuery(document).ready(function($){
                                  $("#ac1").autocomplete('<?=$site_url?>/search/index.php?cmd=product_autocomplete');
                              
                                  $("#flush").click(function() {
                                      var ac = $("#ac1").data('autocompleter');
                                      if (ac && $.isFunction(ac.cacheFlush)) {
                                          ac.cacheFlush();
                                      } else {
                                          alert('Error flushing cache');
                                      }
                                  });
                                  
                                  $("#toggle").click(function() {
                                      $("#hide").toggle(); // To test repositioning
                                  });
                      });
                 </script>  
               
                 -->
              
            </div>
          </div>
          <!-- Search End-->
        </div>
      </div>
    </header>
    <!-- Header End-->