<?php
   include("template/header.php");
   include("template/top_menu.php");
?>
    
  </div>
  <div id="container">
    <!-- Feature Box Start-->
    <div class="container">
      <div class="custom-feature-box row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="feature-box fbox_1">
            <div class="title">Free Shipping</div>
            <p>Free shipping on order over $1000</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="feature-box fbox_2">
            <div class="title">Free Return</div>
            <p>Free return in 24 hour after purchasing</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="feature-box fbox_3">
            <div class="title">Gift Cards</div>
            <p>Give the special perfect gift</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="feature-box fbox_4">
            <div class="title">Reward Points</div>
            <p>Earn and spend with ease</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Feature Box End-->
    <div class="container">
      <div class="row">
        <?php
		   include("template/left_menu.php");
		?>
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <!-- Slideshow Start-->
          <?php
		     unset($info);
			 unset($data);
		    $info["table"] = "slide";
			$info["fields"] = array("slide.*"); 
			$info["where"]   = "1 ORDER BY id DESC";
			$arr =  $db->select($info);			
		  ?>
          <div class="slideshow single-slider owl-carousel">
            <?php
			 for($i=0;$i<count($arr);$i++)
			{
			?>
            <div class="item"> <a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['products_id']?>"><img class="img-responsive" src="<?=$site_url?>/<?=$arr[$i]['file_picture']?>" alt="banner <?=$i?>"  style="width:920px;height:380px;"/></a> </div>
            <?php
			}
			?>
          </div>
          <!-- Slideshow End-->
          <!-- Featured Product Start-->
          <h3 class="subtitle">Featured</h3>
          <div class="owl-carousel product_carousel">
            <?php
			   unset($info);
			   unset($data);
			$info["table"] = "products";
			$info["fields"] = array("products.*"); 
			$info["where"]   = "1  AND product_display_position LIKE '%Featured%' LIMIT 0,5";
			$arr =  $db->select($info);
			for($i=0;$i<count($arr);$i++)
			{
			?>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_products']?>" alt="<?=$arr[$i]['product_name']?>" title="<?=$arr[$i]['product_title']?>" class="img-responsive" style="width:200px;height:200px;" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><?=$arr[$i]['product_name']?></a></h4>
                <p class="price"><span class="price-new">$<?=$arr[$i]['net_price']?></span><span class="price-old">$<?=$arr[$i]['price']?></span><span class="saving">-$<?=$arr[$i]['discount']?></span></p>
              </div>
              <div class="button-group">
                
                <form name="frm_featured_<?=$i?>" id="frm_featured_<?=$i?>" action="" method="post">
                   <input type="hidden" name="cmd" value="add_to_cart">
                   <input type="hidden" name="quantity"  value="1">               
                   <input type="hidden" name="os0" value="<?=strip_tags($arr[$i]['description'])?>">
                   <input type="hidden" name="currency" value="<?=$arr[$i]['currency']?>">
                   <input type="hidden" name="amount" value="<?=$arr[$i]['net_price']?>">
                   <input type="hidden" name="shipping_charge" value="<?=$arr[$i]['shipping_cost']?>">
                   <input type="hidden" name="item_name" value="<?=$arr[$i]['product_name']?>">
                   <input type="hidden" name="item_number" value="<?=$arr[$i]['model']?> <?=$arr[$i]['sku']?>">
                   <input type="hidden" name="products_id" value="<?=$arr[$i]['id']?>">
                    <button class="btn-primary" type="button" onClick="formSubmit('frm_featured_<?=$i?>');"><span>Add to Cart</span></button>
                </form>
               
               
                <div class="add-to-links">
                  <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                  <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                </div>
              </div>
            </div>
            <?php
			}
			?>
          </div>
          <!-- Featured Product End-->
          <!-- Banner Start-->
          <div class="marketshop-banner">
            <div class="row">
             <?php
			   unset($info);
			   unset($data);
			$info["table"] = "banner LEFT JOIN products ON(banner.products_id=products.id)";
			$info["fields"] = array("banner.*,products.product_name,products.product_title,products.id"); 
			$info["where"]   = "1  AND display_position LIKE '%top%'";
			$arr =  $db->select($info);
			for($i=0;$i<count($arr);$i++)
			 {
			?>
              <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_picture']?>" alt="<?=$arr[$i]['product_name']?>" title="<?=$arr[$i]['product_title']?>"   style="width:400px;height:200px;" /></a></div>
            <?php
			 }
			?>
            </div>
          </div>
          <!-- Banner End-->
          <!-- Categories Product Slider Start-->
          <div class="category-module" id="latest_category">
            <?php
				   unset($info);
				   unset($data);
				$info["table"] = "home_page_category LEFT JOIN products ON(home_page_category.products_id=products.id)";
				$info["fields"] = array("home_page_category.*,products.*,products.id"); 
				$info["where"]   = "1  AND display_position LIKE '%1st%'";
				$arr =  $db->select($info);
			?>
            <h3 class="subtitle"><?=$arr[0]['category_txt']?> - <a class="viewall" href="<?=$site_url?>/category/?cmd=category&category=<?=$arr[0]['category_txt']?>">view all</a></h3>
            <div class="category-module-content">
              <ul id="sub-cat" class="tabs">
                <li><a href="<?=$site_url?>/#tab-cat1">Laptops</a></li>
                <li><a href="<?=$site_url?>/#tab-cat2">Desktops</a></li>
                <li><a href="<?=$site_url?>/#tab-cat3">Cameras</a></li>
                <li><a href="<?=$site_url?>/#tab-cat4">Mobile Phones</a></li>
                <li><a href="<?=$site_url?>/#tab-cat5">TV &amp; Home Audio</a></li>
                <li><a href="<?=$site_url?>/#tab-cat6">MP3 Players</a></li>
              </ul>
              <div id="tab-cat1" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <?php
					   unset($info);
					   unset($data);
					$info["table"] = "home_page_category LEFT JOIN products ON(home_page_category.products_id=products.id)";
					$info["fields"] = array("home_page_category.*,products.*,products.id"); 
					$info["where"]   = "1  AND display_position LIKE '%1st%'";
					$arr =  $db->select($info);
					for($i=0;$i<count($arr);$i++)
					 {
				 ?>
                  <div class="product-thumb">
                    <div class="image"><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_products']?>" alt="<?=$arr[$i]['product_name']?>" title="<?=$arr[$i]['product_title']?>" class="img-responsive" style="width:200px;height:200px;" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><?=$arr[$i]['product_name']?></a></h4>
                      <p class="price"> <span class="price-new">$<?=$arr[$i]['net_price']?></span> <span class="price-old">$<?=$arr[$i]['price']?></span> <span class="saving">-<?=$arr[$i]['discount']?></span> </p>
                      <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                    </div>
                    <div class="button-group">
                       <form name="frm_home_page_<?=$i?>" id="frm_home_page_<?=$i?>" action="" method="post">
                           <input type="hidden" name="cmd" value="add_to_cart">
                           <input type="hidden" name="quantity"  value="1">               
                           <input type="hidden" name="os0" value="<?=strip_tags($arr[$i]['description'])?>">
                           <input type="hidden" name="currency" value="<?=$arr[$i]['currency']?>">
                           <input type="hidden" name="amount" value="<?=$arr[$i]['net_price']?>">
                           <input type="hidden" name="shipping_charge" value="<?=$arr[$i]['shipping_cost']?>">
                           <input type="hidden" name="item_name" value="<?=$arr[$i]['product_name']?>">
                           <input type="hidden" name="item_number" value="<?=$arr[$i]['model']?> <?=$arr[$i]['sku']?>">
                           <input type="hidden" name="products_id" value="<?=$arr[$i]['id']?>">
                            <button class="btn-primary" type="button" onClick="formSubmit('frm_home_page_<?=$i?>');"><span>Add to Cart</span></button>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_pro_1-200x200.jpg" alt=" Strategies for Acquiring Your Own Laptop " title=" Strategies for Acquiring Your Own Laptop " class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html"> Strategies for Acquiring Your Own Laptop </a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_air_1-200x200.jpg" alt="Laptop Silver black" title="Laptop Silver black" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Laptop Silver black</a></h4>
                      <p class="price"> <span class="price-new">$1,142.00</span> <span class="price-old">$1,202.00</span> <span class="saving">-5%</span> </p>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_1-200x200.jpg" alt="Ideapad Yoga 13-59341124 Laptop" title="Ideapad Yoga 13-59341124 Laptop" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Ideapad Yoga 13-59341124 Laptop</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_shuffle_1-200x200.jpg" alt="Hp Pavilion G6 2314ax Notebok Laptop" title="Hp Pavilion G6 2314ax Notebok Laptop" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Hp Pavilion G6 2314ax Notebok Laptop</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_touch_1-200x200.jpg" alt="Samsung Galaxy S4" title="Samsung Galaxy S4" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Samsung Galaxy S4</a></h4>
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
                  -->
                </div>
              </div>
             <!--
              <div id="tab-cat2" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <div class="product-thumb">
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_shuffle_1-200x200.jpg" alt="Hp Pavilion G6 2314ax Notebok Laptop" title="Hp Pavilion G6 2314ax Notebok Laptop" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Hp Pavilion G6 2314ax Notebok Laptop</a></h4>
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
                </div>
              </div>
              <div id="tab-cat3" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <div class="product-thumb">
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/FinePix-Long-Zoom-Camera-200x200.jpg" alt="FinePix S8400W Long Zoom Camera" title="FinePix S8400W Long Zoom Camera" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">FinePix S8400W Long Zoom Camera</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/nikon_d300_1-200x200.jpg" alt="Digital Camera for Elderly" title="Digital Camera for Elderly" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Digital Camera for Elderly</a></h4>
                      <p class="price"> <span class="price-new">$92.00</span> <span class="price-old">$98.00</span> <span class="saving">-6%</span> </p>
                    </div>
                    <div class="button-group">
                      <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                      <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="tab-cat4" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <div class="product-thumb">
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/samsung_tab_1-200x200.jpg" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Aspire Ultrabook Laptop</a></h4>
                      <p class="price"> <span class="price-new">$230.00</span> <span class="price-old">$241.99</span> <span class="saving">-5%</span> </p>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/iphone_1-200x200.jpg" alt="iPhone5" title="iPhone5" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">iPhone5</a></h4>
                      <p class="price"> $123.20 </p>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_touch_1-200x200.jpg" alt="Samsung Galaxy S4" title="Samsung Galaxy S4" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Samsung Galaxy S4</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/palm_treo_pro_1-200x200.jpg" alt="HTC M7 with Stunning Looks" title="HTC M7 with Stunning Looks" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">HTC M7 with Stunning Looks</a></h4>
                      <p class="price"> $337.99 </p>
                    </div>
                    <div class="button-group">
                      <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                      <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="tab-cat5" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <div class="product-thumb">
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/samsung_tab_1-200x200.jpg" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Aspire Ultrabook Laptop</a></h4>
                      <p class="price"> <span class="price-new">$230.00</span> <span class="price-old">$241.99</span> <span class="saving">-5%</span> </p>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_classic_1-200x200.jpg" alt="Portable Mp3 Player" title="Portable Mp3 Player" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Portable Mp3 Player</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_pro_1-200x200.jpg" alt=" Strategies for Acquiring Your Own Laptop " title=" Strategies for Acquiring Your Own Laptop " class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html"> Strategies for Acquiring Your Own Laptop </a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_air_1-200x200.jpg" alt="Laptop Silver black" title="Laptop Silver black" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Laptop Silver black</a></h4>
                      <p class="price"> <span class="price-new">$1,142.00</span> <span class="price-old">$1,202.00</span> <span class="saving">-5%</span> </p>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_1-200x200.jpg" alt="Ideapad Yoga 13-59341124 Laptop" title="Ideapad Yoga 13-59341124 Laptop" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Ideapad Yoga 13-59341124 Laptop</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_nano_1-200x200.jpg" alt="Mp3 Player" title="Mp3 Player" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Mp3 Player</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/FinePix-Long-Zoom-Camera-200x200.jpg" alt="FinePix S8400W Long Zoom Camera" title="FinePix S8400W Long Zoom Camera" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">FinePix S8400W Long Zoom Camera</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_shuffle_1-200x200.jpg" alt="Hp Pavilion G6 2314ax Notebok Laptop" title="Hp Pavilion G6 2314ax Notebok Laptop" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Hp Pavilion G6 2314ax Notebok Laptop</a></h4>
                      <p class="price"> $122.00 </p>
                    </div>
                    <div class="button-group">
                      <button class="btn-primary" type="button" onClick="cart.add('34');"><span>Add to Cart</span></button>
                      <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick="wishlist.add('34');"><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Add to compare" onClick="compare.add('34');"><i class="fa fa-exchange"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="product-thumb">
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_touch_1-200x200.jpg" alt="Samsung Galaxy S4" title="Samsung Galaxy S4" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Samsung Galaxy S4</a></h4>
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
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/nikon_d300_1-200x200.jpg" alt="Digital Camera for Elderly" title="Digital Camera for Elderly" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Digital Camera for Elderly</a></h4>
                      <p class="price"> <span class="price-new">$92.00</span> <span class="price-old">$98.00</span> <span class="saving">-6%</span> </p>
                    </div>
                    <div class="button-group">
                      <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                      <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="tab-cat6" class="tab_content">
                <div class="owl-carousel latest_category_tabs">
                  <div class="product-thumb">
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_classic_1-200x200.jpg" alt="Portable Mp3 Player" title="Portable Mp3 Player" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Portable Mp3 Player</a></h4>
                      <p class="price"> $122.00 </p>
                    </div>
                    <div class="button-group">
                      <button class="btn-primary" type="button" onClick="cart.add('48');"><span>Add to Cart</span></button>
                      <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="product-thumb">
                    <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_nano_1-200x200.jpg" alt="Mp3 Player" title="Mp3 Player" class="img-responsive" /></a></div>
                    <div class="caption">
                      <h4><a href="<?=$site_url?>/product.html">Mp3 Player</a></h4>
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
                </div>
              </div>
              -->
            </div>
          </div>
          <!-- Categories Product Slider End-->
          <!-- Banner Start -->
          <div class="marketshop-banner">
            <div class="row">
               <?php
			   unset($info);
			   unset($data);
			$info["table"] = "banner LEFT JOIN products ON(banner.products_id=products.id)";
			$info["fields"] = array("banner.*,products.product_name,products.product_title,products.id"); 
			$info["where"]   = "1  AND display_position LIKE '%middle%'";
			$arr =  $db->select($info);
			for($i=0;$i<count($arr);$i++)
			 {
			?>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_picture']?>"  alt="<?=$arr[$i]['product_name']?>" title="<?=$arr[$i]['product_title']?>"   style="width:400px;height:150px;" /></a></div>
            <?php
			 }
			?>
            </div>
          </div>
          <!-- Banner End -->
          <!-- Categories Product Slider Start -->
           <?php
				   unset($info);
				   unset($data);
				$info["table"] = "home_page_category LEFT JOIN products ON(home_page_category.products_id=products.id)";
				$info["fields"] = array("home_page_category.*,products.*,products.id"); 
				$info["where"]   = "1  AND display_position LIKE '%2nd%'";
				$arr =  $db->select($info);
			?> 
          <h3 class="subtitle"><?=$arr[0]['category_txt']?> - <a class="viewall" href="<?=$site_url?>/category/?cmd=category&category=<?=$arr[0]['category_txt']?>">view all</a></h3>
          <div class="owl-carousel latest_category_carousel">
           
           <?php
				   unset($info);
				   unset($data);
				$info["table"] = "home_page_category LEFT JOIN products ON(home_page_category.products_id=products.id)";
				$info["fields"] = array("home_page_category.*,products.*,products.id"); 
				$info["where"]   = "1  AND display_position LIKE '%2nd%'";
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
                <form name="frm_slide2nd_<?=$i?>" id="frm_slide2nd_<?=$i?>" action="" method="post">
                   <input type="hidden" name="cmd" value="add_to_cart">
                   <input type="hidden" name="quantity"  value="1">               
                   <input type="hidden" name="os0" value="<?=strip_tags($arr[$i]['description'])?>">
                   <input type="hidden" name="currency" value="<?=$arr[$i]['currency']?>">
                   <input type="hidden" name="amount" value="<?=$arr[$i]['net_price']?>">
                   <input type="hidden" name="shipping_charge" value="<?=$arr[$i]['shipping_cost']?>">
                   <input type="hidden" name="item_name" value="<?=$arr[$i]['product_name']?>">
                   <input type="hidden" name="item_number" value="<?=$arr[$i]['model']?> <?=$arr[$i]['sku']?>">
                   <input type="hidden" name="products_id" value="<?=$arr[$i]['id']?>">
                    <button class="btn-primary" type="button" onClick="formSubmit('frm_slide2nd_<?=$i?>');"><span>Add to Cart</span></button>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/nikon_d300_5-200x200.jpg" alt="Hair Care Products" title="Hair Care Products" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Hair Care Products</a></h4>
                <p class="price"> <span class="price-new">$66.80</span> <span class="price-old">$90.80</span> <span class="saving">-27%</span> </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/nikon_d300_4-200x200.jpg" alt="Bed Head Foxy Curls Contour Cream" title="Bed Head Foxy Curls Contour Cream" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Bed Head Foxy Curls Contour Cream</a></h4>
                <p class="price"> $88.00 </p>
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
              <div class="image"><a href="<?=$site_url?>/"><img src="<?=$site_url?>/image/product/macbook_5-200x200.jpg" alt="Shower Gel Perfume for Women" title="Shower Gel Perfume for Women" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Shower Gel Perfume for Women</a></h4>
                <p class="price"> <span class="price-new">$95.00</span> <span class="price-old">$99.00</span> <span class="saving">-4%</span> </p>
              </div>
              <div class="button-group">
                <button class="btn-primary" type="button" onClick="cart.add('61');"><span>Add to Cart</span></button>
                <div class="add-to-links">
                  <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick="wishlist.add('61');"><i class="fa fa-heart"></i></button>
                  <button type="button" data-toggle="tooltip" title="Add to compare" onClick="compare.add('61');"><i class="fa fa-exchange"></i></button>
                </div>
              </div>
            </div>
            <div class="product-thumb">
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_4-200x200.jpg" alt="Perfumes for Women" title="Perfumes for Women" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Perfumes for Women</a></h4>
                <p class="price"> $85.00 </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_3-200x200.jpg" alt="Make Up for Naturally Beautiful Better" title="Make Up for Naturally Beautiful Better" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Make Up for Naturally Beautiful Better</a></h4>
                <p class="price"> $123.00 </p>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_2-200x200.jpg" alt="Pnina Tornai Perfume" title="Pnina Tornai Perfume" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Pnina Tornai Perfume</a></h4>
                <p class="price"> $110.00 </p>
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
          <!-- Categories Product Slider End -->
          <!-- Brand Product Slider Start-->
          <?php
			   unset($info);
			   unset($data);
			$info["table"] = "home_page_category LEFT JOIN products ON(home_page_category.products_id=products.id)";
			$info["fields"] = array("home_page_category.*,products.*,products.id"); 
			$info["where"]   = "1  AND display_position LIKE '%3rd%'";
			$arr =  $db->select($info);
		 ?>
          <h3 class="subtitle"><?=$arr[0]['category_txt']?> - <a class="viewall" href="<?=$site_url?>/category/?cmd=category&category=<?=$arr[0]['category_txt']?>">view all</a></h3>
          <div class="owl-carousel latest_brands_carousel">
             <?php
				   unset($info);
				   unset($data);
				$info["table"] = "home_page_category LEFT JOIN products ON(home_page_category.products_id=products.id)";
				$info["fields"] = array("home_page_category.*,products.*,products.id"); 
				$info["where"]   = "1  AND display_position LIKE '%3rd%'";
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
                <form name="frm_slide3rd_<?=$i?>" id="frm_slide3rd_<?=$i?>" action="" method="post">
                   <input type="hidden" name="cmd" value="add_to_cart">
                   <input type="hidden" name="quantity"  value="1">               
                   <input type="hidden" name="os0" value="<?=strip_tags($arr[$i]['description'])?>">
                   <input type="hidden" name="currency" value="<?=$arr[$i]['currency']?>">
                   <input type="hidden" name="amount" value="<?=$arr[$i]['net_price']?>">
                   <input type="hidden" name="shipping_charge" value="<?=$arr[$i]['shipping_cost']?>">
                   <input type="hidden" name="item_name" value="<?=$arr[$i]['product_name']?>">
                   <input type="hidden" name="item_number" value="<?=$arr[$i]['model']?> <?=$arr[$i]['sku']?>">
                   <input type="hidden" name="products_id" value="<?=$arr[$i]['id']?>">
                    <button class="btn-primary" type="button" onClick="formSubmit('frm_slide3rd_<?=$i?>');"><span>Add to Cart</span></button>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/nikon_d300_5-200x200.jpg" alt="Hair Care Products" title="Hair Care Products" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Hair Care Products</a></h4>
                <p class="price"> <span class="price-new">$66.80</span> <span class="price-old">$90.80</span> <span class="saving">-27%</span> </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/nikon_d300_4-200x200.jpg" alt="Bed Head Foxy Curls Contour Cream" title="Bed Head Foxy Curls Contour Cream" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Bed Head Foxy Curls Contour Cream</a></h4>
                <p class="price"> $88.00 </p>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_5-200x200.jpg" alt="Shower Gel Perfume for Women" title="Shower Gel Perfume for Women" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Shower Gel Perfume for Women</a></h4>
                <p class="price"> <span class="price-new">$95.00</span> <span class="price-old">$99.00</span> <span class="saving">-4%</span> </p>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_4-200x200.jpg" alt="Perfumes for Women" title="Perfumes for Women" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Perfumes for Women</a></h4>
                <p class="price"> $85.00 </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_3-200x200.jpg" alt="Make Up for Naturally Beautiful Better" title="Make Up for Naturally Beautiful Better" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Make Up for Naturally Beautiful Better</a></h4>
                <p class="price"> $123.00 </p>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_2-200x200.jpg" alt="Pnina Tornai Perfume" title="Pnina Tornai Perfume" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Pnina Tornai Perfume</a></h4>
                <p class="price"> $110.00 </p>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/hp_3-200x200.jpg" alt="Casio Youth Series Marine Watch" title="Casio Youth Series Marine Watch" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Casio Youth Series Marine Watch</a></h4>
                <p class="price"> $1,300.00 </p>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/hp_2-200x200.jpg" alt="Mens Bracelet Watch" title="Mens Bracelet Watch" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Mens Bracelet Watch</a></h4>
                <p class="price"> $1,800.00 </p>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/ipod_classic_1-200x200.jpg" alt="Portable Mp3 Player" title="Portable Mp3 Player" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Portable Mp3 Player</a></h4>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_pro_1-200x200.jpg" alt=" Strategies for Acquiring Your Own Laptop " title=" Strategies for Acquiring Your Own Laptop " class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html"> Strategies for Acquiring Your Own Laptop </a></h4>
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
              <div class="image"><a href="<?=$site_url?>/product.html"><img src="<?=$site_url?>/image/product/macbook_air_1-200x200.jpg" alt="Laptop Silver black" title="Laptop Silver black" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product.html">Laptop Silver black</a></h4>
                <p class="price"> <span class="price-new">$1,142.00</span> <span class="price-old">$1,202.00</span> <span class="saving">-5%</span> </p>
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
          <!-- Brand Product Slider End -->
          <!-- Brand Logo Carousel Start-->
          <div id="carousel" class="owl-carousel nxt">
             <?php
			   unset($info);
			   unset($data);
			$info["table"] = "banner LEFT JOIN products ON(banner.products_id=products.id)";
			$info["fields"] = array("banner.*,products.product_name,products.product_title,products.id"); 
			$info["where"]   = "1  AND display_position LIKE '%bottom%'";
			$arr =  $db->select($info);
			for($i=0;$i<count($arr);$i++)
			 {
			?>
            <div class="item text-center"> <a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_picture']?>" alt="<?=$arr[$i]['product_name']?>" class="img-responsive" /></a> </div>
              <?php
			 }
			?>
          </div>
          <!-- Brand Logo Carousel End -->
        </div>
        <!--Middle Part End-->
      </div>
    </div>
  </div>

<?php
   include("template/footer.php");
?>
    