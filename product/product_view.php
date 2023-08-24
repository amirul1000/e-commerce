<?php
   include("../template/header.php");
   include("../template/top_menu.php");
?>
<link rel="stylesheet" type="text/css" href="<?=$site_url?>/js/swipebox/src/css/swipebox.min.css">

  </div>
  <div id="container">
    <div class="container">
       <?php
			unset($info);
		   unset($data);
		$info["table"] = "products";
		$info["fields"] = array("products.*"); 
		$info["where"]   = "1  AND id='".$_REQUEST['id']."'";
		$product =  $db->select($info);
		$arrcategory = explode(";",$product[0]['parent_category_txt']);
		?>
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li itemscope itemtype="<?=$site_url?>"><a href="<?=$site_url?>" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
        <?php
		  for($i=0;$i<count($arrcategory);$i++)
		  {
		?>
             <li itemscope itemtype="<?=$site_url?>/search/?search-key=<?=urlencode($arrcategory[$i])?>">
                <a href="<?=$site_url?>/search/?search-key=<?=urlencode($arrcategory[$i])?>" itemprop="url"><span itemprop="title"><?=$arrcategory[$i]?></span></a>
             </li>
        <?php
		  }
		?>
        <!--<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?=$site_url?>/product.php" itemprop="url"><span itemprop="title">Laptop Silver black</span></a></li>-->
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <div itemscope itemtype="http://schema.org/Product">
           
            <h1 class="title" itemprop="name"><?=$product[0]['product_name']?></h1>
            <div class="row product-info">
              <div class="col-sm-6">
                <div class="image"><img class="img-responsive" itemprop="image" id="zoom_01" src="<?=$site_url?>/<?=$product[0]['file_products']?>"  alt="<?=$product[0]['product_name']?>" title="<?=$product[0]['product_title']?>"  data-zoom-image="<?=$site_url?>/<?=$product[0]['file_products']?>"  style="width:350px;height:350px;"/> </div>
                <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> Click image for Gallery</span></div>
                <div class="image-additional" id="gallery_01"> 
                   <?php
							unset($info);
						$info['table']    = "products_images";
						$info['fields']   = array("*");   	   
						$info['where']    = "products_id='".$_REQUEST['id']."'";
						$res  =  $db->select($info);
						for($i=0;$i<count($res);$i++)
						{
					?>
                    <a class="thumbnail" href="#" data-zoom-image="<?=$site_url?>/<?=$res[$i]['file_name']?>" data-image="<?=$site_url?>/<?=$res[$i]['file_name']?>" title="Laptop Silver black"> 
                        <img src="<?=$site_url?>/<?=$res[$i]['file_name']?>" style="width:66px;height:66px;"/>
                    </a>
                   <?php
						}
				   ?> 
                    <!--
                    <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_4-500x500.jpg" data-image="image/product/macbook_air_4-350x350.jpg" title="Laptop Silver black"><img src="<?=$site_url?>/image/product/macbook_air_4-66x66.jpg" title="Laptop Silver black" alt="Laptop Silver black" /></a>
                    <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_2-500x500.jpg" data-image="image/product/macbook_air_2-350x350.jpg" title="Laptop Silver black"><img src="<?=$site_url?>/image/product/macbook_air_2-66x66.jpg" title="Laptop Silver black" alt="Laptop Silver black" /></a>
                    <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_3-500x500.jpg" data-image="image/product/macbook_air_3-350x350.jpg" title="Laptop Silver black"><img src="<?=$site_url?>/<?=$product[0]['file_products']?>" title="Laptop Silver black" alt="Laptop Silver black" /></a> 
                    -->
                  </div>                 
              </div>
              <div class="col-sm-6">
                <ul class="list-unstyled description">
                  <li><b>Brand:</b> <a href="#"><span itemprop="brand"><?=$product[0]['brand']?></span></a></li>
                  <li><b>Product Code:</b> <span itemprop="mpn"><?=$product[0]['brand']?></span></li>
                  <li><b>Reward Points:</b> 700</li>
                  <li><b>Availability:</b> <span class="instock">In Stock</span></li>
                </ul>
                <ul class="price-box">
                  <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span class="price-old">$<?=$product[0]['price']?></span> <span itemprop="price">$<?=$product[0]['net_price']?><span itemprop="availability" content="In Stock"></span></span></li>
                  <li></li>
                  <li>Ex Tax: $950.00</li>
                </ul>
                <div id="product">
                  <h3 class="subtitle">Available Options</h3>
                  <div class="form-group required">
                    <label class="control-label">Color</label>
                    <select class="form-control" id="input-option200" name="option[200]">
                      <option value=""> --- Please Select --- </option>
                      <option value="4">Black </option>
                      <option value="3">Silver </option>
                      <option value="1">Green </option>
                      <option value="2">Blue </option>
                    </select>
                  </div>
                  <div class="cart">
                    <div>
                      <div class="qty">
                        <label class="control-label" for="input-quantity">Qty</label>
                        <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
                        <a class="qtyBtn plus" href="javascript:void(0);">+</a><br />
                        <a class="qtyBtn mines" href="javascript:void(0);">-</a>
                        <div class="clear"></div>
                      </div>
                       <form name="frm_product_0" id="frm_product_0" action="" method="post">
                           <input type="hidden" name="cmd" value="add_to_cart">
                           <input type="hidden" name="quantity"  value="1">               
                           <input type="hidden" name="os0" value="<?=strip_tags($product[0]['description'])?>">
                           <input type="hidden" name="currency" value="<?=$product[0]['currency']?>">
                           <input type="hidden" name="amount" value="<?=$product[0]['net_price']?>">
                           <input type="hidden" name="shipping_charge" value="<?=$product[0]['shipping_cost']?>">
                           <input type="hidden" name="item_name" value="<?=$product[0]['product_name']?>">
                           <input type="hidden" name="item_number" value="<?=$product[0]['model']?> <?=$product[0]['sku']?>">
                           <input type="hidden" name="products_id" value="<?=$product[0]['id']?>">
                            <button class="btn-primary" type="button" onClick="formSubmit('frm_product_0');"><span>Add to Cart</span></button>
                        </form>
                    </div>
                    <div>
                      <button type="button" class="wishlist" onClick=""><i class="fa fa-heart"></i> Add to Wish List</button>
                      <br />
                      <button type="button" class="wishlist" onClick=""><i class="fa fa-exchange"></i> Compare this Product</button>
                    </div>
                  </div>
                </div>
                <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                  <meta itemprop="ratingValue" content="0" />
                  <p>
                    <?php
						  unset($info);
						$info["table"] = "review";
						$info["fields"] = array("review.*"); 
						$info["where"]   = "1 AND products_id='".$_REQUEST['id']."' ORDER BY id DESC";
						$arrreview =  $db->select($info);
				 
						   unset($info);
						$info["table"] = "review";
						$info["fields"] = array("sum(review.rating)/5 as rating"); 
						$info["where"]   = "1 AND products_id='".$_REQUEST['id']."' ORDER BY id DESC";
						$arrreview2 =  $db->select($info);		 
					   for($j=1;$j<=5;$j++)
					   { 
						if($j<=(int)$arrreview2[0]['rating'])
						  {
						  ?>
						  <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i>
                            <i class="fa fa-star-o fa-stack-1x"></i></span>
						  <?php
						   }
						   else
						  {
						  ?>
						  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
						  <?php
						   }
					   }
					  ?>
                 
                   <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href=""><span itemprop="reviewCount"><?=count($arrreview)?>reviews</span></a> / <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href="">Write a review</a></p>
                </div>
                <hr>
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal" pi:pinit:url="http://www.addthis.com/features/pinterest" pi:pinit:media="http://www.addthis.com/cms-content/images/features/pinterest-lg.png"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
                <script type="text/javascript" src="s7.addthis.com/js/300/addthis_widget.js#pubid=ra-514863386b357649"></script>
                <!-- AddThis Button END -->
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
              <li><a href="#tab-specification" data-toggle="tab">Specification</a></li>
              <li><a href="#tab-term" data-toggle="tab">Term Condition</a></li>
              <li><a href="#tab-delivery " data-toggle="tab">Delivery Info</a></li>
              <li><a href="#tab-damage" data-toggle="tab">Damage Return</a></li>
              
              
              <li><a href="#tab-review" data-toggle="tab">Reviews (<?=count($arrreview)?>)</a></li>
            </ul>
            <div class="tab-content">
              <div itemprop="description" id="tab-description" class="tab-pane active">
                <div>
                  <?=$product[0]['description']?>
                </div>
              </div>
              <div id="tab-specification" class="tab-pane">
                
                <table  class="table table-bordered">
                     <tr>
                         <td>Brand</td>
                         <td>
                            <?=$product[0]['brand']?>
                         </td>
                     </tr>
                     <tr>
                         <td>Model</td>
                         <td>
                            <?=$product[0]['model']?>
                         </td>
                     </tr>
                     <tr>
                         <td>Sku</td>
                         <td>
                            <?=$product[0]['sku']?>
                         </td>
                     </tr>
                     <tr>
                         <td width="20%">Product Condition</td>
                         <td>
                            <?=$product[0]['product_condition']?>
                            
                         </td>
                     </tr>
                     <tr>
                         <td>Gender For</td>
                         <td>
                           <?=$product[0]['gender_for']?>                            
                         </td>
                     </tr>
                     <tr>
                         <td>Age For</td>
                         <td>
                            <?=$product[0]['age_for']?>                             
                         </td>
                     </tr>
                     <tr>
                         <td>Occasions</td>
                         <td>
                            <?=$product[0]['occasions']?>
                         </td>
                     </tr>
                     <tr>
                         <td>Material Used</td>
                         <td>
                            <?=$product[0]['material_used']?>
                         </td>
                     </tr>
                     <tr>
                         <td>Size</td>
                         <td>
                            <?=$product[0]['size']?>
                           
                         </td>
                     </tr>
                     <tr>
                         <td>Color</td>
                         <td>
                            <?=$product[0]['color']?>
                          
                         </td>
                     </tr>
                     <tr>
                         <td>Width X HeightX Length</td>
                         <td>
                            <?=$product[0]['width']?>X        
                            <?=$product[0]['height']?>X                            
                            <?=$product[0]['length']?>&nbsp;
                            <?=$product[0]['width_height_length_unit']?>
                         </td>
                     </tr>
                     <tr>
                         <td>Weight</td>
                         <td>
                            <?=$product[0]['weight']?>&nbsp;
                            <?=$product[0]['weight_unit']?>
                         </td>
                     </tr>
                    </table>
                
              </div>
              <div id="tab-term" class="tab-pane">
                 <?=$product[0]['term_condition']?>
              </div>
               <div id="tab-delivery" class="tab-pane">
                 <?=$product[0]['delivery_info']?>
              </div>
               <div id="tab-damage" class="tab-pane">
                 <?=$product[0]['damage_return']?>
              </div>
              <div id="tab-review" class="tab-pane">
                <!--<form class="form-horizontal">-->
                  <div id="review">
                    <div>
                     <?php
						for($i=0;$i<count($arrreview);$i++)
						{
					 ?>
                      <table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 50%;"><strong><span><?=$arrreview[$i]['name']?></span></strong></td>
                            <td class="text-right"><span><?=$arrreview[$i]['date_created']?></span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><p><?=$arrreview[$i]['review']?></p>
                              <div class="rating"> 
                                  <?php
								 
								   for($j=1;$j<=5;$j++)
								   { 
								    if($j<=$arrreview[$i]['rating'])
									  {
									  ?>
									  <span class="fa fa-stack">
										  <i class="fa fa-star fa-stack-2x"></i>
										  <i class="fa fa-star-o fa-stack-2x"></i>
									  </span> 
									  <?php
									   }
									   else
									  {
									  ?>
									  <span class="fa fa-stack">
										  <i class="fa fa-star-o fa-stack-2x"></i>
									  </span> 
									  <?php
									   }
								  }
								  ?>
                                 <!-- <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i>
                                  <i class="fa fa-star-o fa-stack-2x"></i></span> 
                                  
                                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i>
                                  <i class="fa fa-star-o fa-stack-2x"></i></span>
                                  
                                   <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i>
                                   <i class="fa fa-star-o fa-stack-2x"></i></span> 
                                   
                                   <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i>
                                   <i class="fa fa-star-o fa-stack-2x"></i></span>-->
                                    
                               </div>
                             </td>
                          </tr>
                        </tbody>
                      </table>
                      <?php
						}
					  ?>	
                      <!--<table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 50%;"><strong><span>Andrson</span></strong></td>
                            <td class="text-right"><span>20/01/2016</span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                          </tr>
                        </tbody>
                      </table>-->
                    </div>
                    <div class="text-right"></div>
                  </div>
                  <h2>Write a review</h2>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-name" class="control-label">Your Name</label>
                      <input type="text" class="form-control" id="input-name" value="" name="name">
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-review" class="control-label">Your Review</label>
                      <textarea class="form-control" id="input-review" rows="5" name="text"></textarea>
                      <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label class="control-label">Rating</label>
                      &nbsp;&nbsp;&nbsp; Bad&nbsp;
                      <input type="radio" value="1" name="rating">
                      &nbsp;
                      <input type="radio" value="2" name="rating">
                      &nbsp;
                      <input type="radio" value="3" name="rating">
                      &nbsp;
                      <input type="radio" value="4" name="rating">
                      &nbsp;
                      <input type="radio" value="5" name="rating" checked>
                      &nbsp;Good</div>
                  </div>
                  <div class="buttons">
                    <div class="pull-right">
                      <button class="btn btn-primary" id="button-review" type="button">Continue</button>
                    </div>
                  </div>
                <!--</form>-->
                <script>
				$(document).ready(function() {
					 $("#button-review").on('click',function()
						{
							
							if($("#input-name").val()=="")
							{
								toastr.options.timeOut = 3000;
								toastr.error("Name can't be empty");
								return;
							}
							
							if($("#input-review").val()=="")
							{
								toastr.options.timeOut = 3000;
								toastr.error("Review can't be empty");
								return;
							}
							
							if($("input[name='rating']:checked").val()=="")
							{
								toastr.options.timeOut = 3000;
								toastr.error("Rrating can't be empty");
								return;
							}
							
							
							  $.ajax({
									  headers: {
										   "Access-Control-Allow-Origin": "*",
										   "Access-Control-Allow-Methods": "GET, POST, PUT",
										   "Access-Control-Allow-Headers": "Content-Type",
									   },
									  method: "POST",
									  url: "<?=$site_url?>/product/index.php",
									  data:{
												cmd             : 'review',
												name            : $("#input-name").val(),     
												review          : $("#input-review").val(),
												rating          : $("input[name='rating']:checked").val(),
												products_id     : <?=$_REQUEST['id']?>
											   
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
													setTimeout(function(){
														 location.reload();													
													 }, 3000);
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
						  
						 });
					});
				</script>
              </div>
            </div>
            <h3 class="subtitle">Related Products</h3>
            <div class="owl-carousel related_pro">
             
               <?php
				   unset($info);
				   unset($data);
				$info["table"] = "products";
				$info["fields"] = array("products.*"); 
				$info["where"]   = "1  AND parent_category_txt LIKE '%".$product[0]['category_txt']."%'";
				$arr =  $db->select($info);
				for($i=0;$i<count($arr);$i++)
				 {
			 ?>
            <div class="product-thumb">
              <div class="image"><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_products']?>" alt="<?=$arr[$i]['product_name']?>" title="<?=$arr[$i]['product_title']?>" class="img-responsive" style="width:200px;height:200px;" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><?=$arr[$i]['product_name']?></a></h4>
                <p class="price"> $<?=$arr[$i]['net_price']?> </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
              <div class="button-group">
                 <form name="frm_related_<?=$i?>" id="frm_related_<?=$i?>" action="" method="post">
                   <input type="hidden" name="cmd" value="add_to_cart">
                   <input type="hidden" name="quantity"  value="1">               
                   <input type="hidden" name="os0" value="<?=strip_tags($arr[$i]['description'])?>">
                   <input type="hidden" name="currency" value="<?=$arr[$i]['currency']?>">
                   <input type="hidden" name="amount" value="<?=$arr[$i]['net_price']?>">
                   <input type="hidden" name="shipping_charge" value="<?=$arr[$i]['shipping_cost']?>">
                   <input type="hidden" name="item_name" value="<?=$arr[$i]['product_name']?>">
                   <input type="hidden" name="item_number" value="<?=$arr[$i]['model']?> <?=$arr[$i]['sku']?>">
                   <input type="hidden" name="products_id" value="<?=$arr[$i]['id']?>">
                    <button class="btn-primary" type="button" onClick="formSubmit('frm_related_<?=$i?>');"><span>Add to Cart</span></button>
                </form>
                <div class="add-to-links">
                  <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                  <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                </div>
              </div>
            </div>
            <?php
			 }
			?>
              
              <!--
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_pro_1-200x200.jpg" alt=" Strategies for Acquiring Your Own Laptop " title=" Strategies for Acquiring Your Own Laptop " class="img-responsive" /></a></div>
                <div class="caption">
                  <h4><a href="<?=$site_url?>/product"> Strategies for Acquiring Your Own Laptop </a></h4>
                  <p class="price"> <span class="price-new">$1,400.00</span> <span class="price-old">$1,900.00</span> <span class="saving">-26%</span> </p>
                </div>
                <div class="button-group">
                  <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                  <div class="add-to-links">
                    <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_1-200x200.jpg" alt="Ideapad Yoga 13-59341124 Laptop" title="Ideapad Yoga 13-59341124 Laptop" class="img-responsive" /></a></div>
                <div class="caption">
                  <h4><a href="<?=$site_url?>/product">Ideapad Yoga 13-59341124 Laptop</a></h4>
                  <p class="price"> $2.00 </p>
                  <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                </div>
                <div class="button-group">
                  <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                  <div class="add-to-links">
                    <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/ipod_shuffle_1-200x200.jpg" alt="Hp Pavilion G6 2314ax Notebok Laptop" title="Hp Pavilion G6 2314ax Notebok Laptop" class="img-responsive" /></a></div>
                <div class="caption">
                  <h4><a href="<?=$site_url?>/product">Hp Pavilion G6 2314ax Notebok Laptop</a></h4>
                  <p class="price"> $122.00 </p>
                </div>
                <div class="button-group">
                  <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                  <div class="add-to-links">
                    <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/ipod_touch_1-200x200.jpg" alt="Samsung Galaxy S4" title="Samsung Galaxy S4" class="img-responsive" /></a></div>
                <div class="caption">
                  <h4><a href="<?=$site_url?>/product">Samsung Galaxy S4</a></h4>
                  <p class="price"> <span class="price-new">$62.00</span> <span class="price-old">$122.00</span> <span class="saving">-50%</span> </p>
                </div>
                <div class="button-group">
                  <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                  <div class="add-to-links">
                    <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/ipod_shuffle_1-200x200.jpg" alt="Hp Pavilion G6 2314ax Notebok Laptop" title="Hp Pavilion G6 2314ax Notebok Laptop" class="img-responsive" /></a></div>
                <div class="caption">
                  <h4><a href="<?=$site_url?>/product">Hp Pavilion G6 2314ax Notebok Laptop</a></h4>
                  <p class="price"> $122.00 </p>
                </div>
                <div class="button-group">
                  <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                  <div class="add-to-links">
                    <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
              -->
            </div>
          </div>
        </div>
        <!--Middle Part End -->
        <!--Right Part Start -->
        <aside id="column-right" class="col-sm-3 hidden-xs">
          <h3 class="subtitle">Bestsellers</h3>
          <div class="side-item">
            
            <?php
			   unset($info);
			   unset($data);
			$info["table"] = "products";
			$info["fields"] = array("products.*"); 
			$info["where"]   = "1  AND product_display_position LIKE '%Bestsellers%'   LIMIT 0,5";
			$arr =  $db->select($info);
			for($i=0;$i<count($arr);$i++)
			{
			?>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_products']?>" alt="<?=$arr[$i]['product_name']?>" title="<?=$arr[$i]['product_title']?>" class="img-responsive" style="width:50px;height:50px;"/></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><?=$arr[$i]['product_name']?></a></h4>
                <p class="price"><span class="price-new">$<?=$arr[$i]['net_price']?></span> <span class="price-old">$$<?=$arr[$i]['price']?></span> <span class="saving">-<?=$arr[$i]['discount']?></span></p>
              </div>
            </div>
             <?php
			}
			?>
            
            <!--
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/iphone_1-50x50.jpg" alt="iPhone5" title="iPhone5" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">iPhone5</a></h4>
                <p class="price"> $123.20 </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span></div>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_1-50x50.jpg" alt="Ideapad Yoga 13-59341124 Laptop" title="Ideapad Yoga 13-59341124 Laptop" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Ideapad Yoga 13-59341124 Laptop</a></h4>
                <p class="price"> $2.00 </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/sony_vaio_1-50x50.jpg" alt="Xitefun Causal Wear Fancy Shoes" title="Xitefun Causal Wear Fancy Shoes" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Xitefun Causal Wear Fancy Shoes</a></h4>
                <p class="price"> <span class="price-new">$902.00</span> <span class="price-old">$1,202.00</span> <span class="saving">-25%</span> </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/FinePix-Long-Zoom-Camera-50x50.jpg" alt="FinePix S8400W Long Zoom Camera" title="FinePix S8400W Long Zoom Camera" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">FinePix S8400W Long Zoom Camera</a></h4>
                <p class="price">$122.00</p>
              </div>
            </div>
            -->
          </div>
          <div class="list-group">
            <h3 class="subtitle">Custom Content</h3>
            <p>This is a CMS block edited from admin. You can insert any content (HTML, Text, Images) Here. </p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
            <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
          </div>
          <h3 class="subtitle">Specials</h3>
          <div class="side-item">
          
            <?php
			   unset($info);
			   unset($data);
			$info["table"] = "products";
			$info["fields"] = array("products.*"); 
			$info["where"]   = "1  AND product_display_position LIKE '%Specials%'   LIMIT 0,5";
			$arr =  $db->select($info);
			for($i=0;$i<count($arr);$i++)
			{
			?>
             <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_products']?>" alt="<?=$arr[$i]['product_name']?>" title="<?=$arr[$i]['product_title']?>" class="img-responsive" style="width:50px;height:50px;"/></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>&product_name=<?=$arr[$i]['product_name']?>"><?=$arr[$i]['product_name']?></a></h4>
                <p class="price"><span class="price-new">$<?=$arr[$i]['net_price']?></span> <span class="price-old">$$<?=$arr[$i]['price']?></span> <span class="saving">-<?=$arr[$i]['discount']?></span></p>
              </div>
            </div>
             <?php
			}
			?>
            
            <!--
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/samsung_tab_1-50x50.jpg" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Aspire Ultrabook Laptop</a></h4>
                <p class="price"> <span class="price-new">$230.00</span> <span class="price-old">$241.99</span> <span class="saving">-5%</span> </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/apple_cinema_30-50x50.jpg" alt="Brand Fashion Cotton T-Shirt" title="Brand Fashion Cotton T-Shirt" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="http://demo.harnishdesign.net/opencart/marketshop/v1/index.php?route=product/product&amp;product_id=42">Brand Fashion Cotton T-Shirt</a></h4>
                <p class="price"> <span class="price-new">$110.00</span> <span class="price-old">$122.00</span> <span class="saving">-10%</span> </p>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/nikon_d300_1-50x50.jpg" alt="Digital Camera for Elderly" title="Digital Camera for Elderly" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Digital Camera for Elderly</a></h4>
                <p class="price"> <span class="price-new">$92.00</span> <span class="price-old">$98.00</span> <span class="saving">-6%</span> </p>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/nikon_d300_5-50x50.jpg" alt="Hair Care Products" title="Hair Care Products" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Hair Care Products</a></h4>
                <p class="price"> <span class="price-new">$66.80</span> <span class="price-old">$90.80</span> <span class="saving">-27%</span> </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_air_1-50x50.jpg" alt="Laptop Silver black" title="Laptop Silver black" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Laptop Silver black</a></h4>
                <p class="price"> <span class="price-new">$1,142.00</span> <span class="price-old">$1,202.00</span> <span class="saving">-5%</span> </p>
              </div>
            </div>
            -->
          </div>
        </aside>
        <!--Right Part End -->
      </div>
    </div>
  </div>
<?php
   include("../template/footer.php");
?>
    