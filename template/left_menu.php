<!-- Left Part Start-->
    <aside id="column-left" class="col-sm-3 hidden-xs">
          <h3 class="subtitle">Categories</h3>
          <div class="box-category">
            <ul id="cat_accordion">
            <?php
  			      function printTree2($tree) {
		       
					if(!is_null($tree) && count($tree) > 0) {
						echo '<ul>';
						foreach($tree as $node) {
							if(count($node['children'])>0)
							{
								echo '<li><a href="'.$site_url.'/category?cmd=category&category='.urlencode($node['name']).'">'.$node['name'].'</a> <span class="down"></span>';
							}
							else
							{
								echo '<li><a href="'.$site_url.'/category?cmd=category&category='.urlencode($node['name']).'">'.$node['name'].'</a></li>';	
							}
							printTree2($node['children']);
							echo '</li>';
						}
						echo '</ul>';
					}
				}
				      $category_id = 0;
                      $tree1 = get_tree($category_id,$db);
                      unset($tree1['']);				  
                      $tree = parseTree($tree1,null);				  
                       if(!is_null($tree) && count($tree) > 0) {
                            foreach($tree as $node) {
								
						 unset($info);		  
						$info["table"] = "category";
						$info["fields"] = array("category.*"); 
						$info["where"]   = "1 AND cat_name LIKE '%".$node['name']."%' AND parent_category_id='0'";
						$arr2 =  $db->select($info);	
						
			 ?>
                <li><a href="<?=$site_url?>/category?cmd=category&category=<?=urlencode($node['name'])?>"><?=$node['name']?></a> <span class="down"></span>
                  
             <?php 
			      printTree2($node['children']);
				 echo "</li>";     
			        }
				  }
               ?>
            
              <!--<li><a href="<?=$site_url?>/category">Clothing</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Men</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories New</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Women</a></li>
                  <li><a href="<?=$site_url?>/category">Girls</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories New</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories New</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Boys</a></li>
                  <li><a href="<?=$site_url?>/category">Baby</a></li>
                  <li><a href="<?=$site_url?>/category">Accessories</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                    </ul>
                  </li>
                </ul>
              </li>-->
              <!--
              <li><a href="<?=$site_url?>/category">Electronics</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Laptops</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories New</a></li>
                    </ul>
                  </li>
                  <li class="custom_id68"><a href="<?=$site_url?>/category">Desktops</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories New</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories New</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Cameras</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Mobile Phones</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">TV &amp; Home Audio</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories New</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">MP3 Players</a></li>
                </ul>
              </li>
              <li><a href="<?=$site_url?>/category">Shoes</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Men</a></li>
                  <li><a href="<?=$site_url?>/category">Women</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Girls</a></li>
                  <li><a href="<?=$site_url?>/category">Boys</a></li>
                  <li><a href="<?=$site_url?>/category">Baby</a></li>
                  <li><a href="<?=$site_url?>/category">Accessories</a><span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">Sub Categories</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="<?=$site_url?>/category">Watches</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Men's Watches</a></li>
                  <li><a href="<?=$site_url?>/category">Women's Watches</a></li>
                  <li><a href="<?=$site_url?>/category">Kids' Watches</a></li>
                  <li><a href="<?=$site_url?>/category">Accessories</a></li>
                </ul>
              </li>
              <li><a href="<?=$site_url?>/category">Jewellery</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Silver</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Gold</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">test 1</a></li>
                      <li><a href="<?=$site_url?>/category">test 2</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Diamond</a></li>
                  <li><a href="<?=$site_url?>/category">Pearl</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Men's Jewellery</a></li>
                  <li><a href="<?=$site_url?>/category">Children's Jewellery</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">New Sub Categories</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="<?=$site_url?>/category">Health &amp; Beauty</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Perfumes</a></li>
                  <li><a href="<?=$site_url?>/category">Makeup</a></li>
                  <li><a href="<?=$site_url?>/category">Sun Care</a></li>
                  <li><a href="<?=$site_url?>/category">Skin Care</a></li>
                  <li><a href="<?=$site_url?>/category">Eye Care</a></li>
                  <li><a href="<?=$site_url?>/category">Hair Care</a></li>
                </ul>
              </li>
              <li><a href="<?=$site_url?>/category">Kids &amp; Babies</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Toys</a></li>
                  <li><a href="<?=$site_url?>/category">Games</a> <span class="down"></span>
                    <ul>
                      <li><a href="<?=$site_url?>/category">test 25</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=$site_url?>/category">Puzzles</a></li>
                  <li><a href="<?=$site_url?>/category">Hobbies</a></li>
                  <li><a href="<?=$site_url?>/category">Strollers</a></li>
                  <li><a href="<?=$site_url?>/category">Health &amp; Safety</a></li>
                </ul>
              </li>
              <li><a href="<?=$site_url?>/category">Sports</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Cycling</a></li>
                  <li><a href="<?=$site_url?>/category">Running</a></li>
                  <li><a href="<?=$site_url?>/category">Swimming</a></li>
                  <li><a href="<?=$site_url?>/category">Football</a></li>
                  <li><a href="<?=$site_url?>/category">Golf</a></li>
                  <li><a href="<?=$site_url?>/category">Windsurfing</a></li>
                </ul>
              </li>
              <li><a href="<?=$site_url?>/category">Home &amp; Garden</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Bedding</a></li>
                  <li><a href="<?=$site_url?>/category">Food</a></li>
                  <li><a href="<?=$site_url?>/category">Furniture</a></li>
                  <li><a href="<?=$site_url?>/category">Kitchen</a></li>
                  <li><a href="<?=$site_url?>/category">Lighting</a></li>
                  <li><a href="<?=$site_url?>/category">Tools</a></li>
                </ul>
              </li>
              <li><a href="<?=$site_url?>/category">Wines &amp; Spirits</a> <span class="down"></span>
                <ul>
                  <li><a href="<?=$site_url?>/category">Wine</a></li>
                  <li><a href="<?=$site_url?>/category">Whiskey</a></li>
                  <li><a href="<?=$site_url?>/category">Vodka</a></li>
                  <li><a href="<?=$site_url?>/category">Liqueurs</a></li>
                  <li><a href="<?=$site_url?>/category">Beer</a></li>
                </ul>
              </li>
              -->
            </ul>
          </div>
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
                <h4><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><?=$arr[$i]['product_name']?></a></h4>
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
                <h4><a href="<?=$site_url?>/http://demo.harnishdesign.net/opencart/marketshop/v1/index.php?route=product/product&amp;product_id=42">Brand Fashion Cotton T-Shirt</a></h4>
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
          <div class="list-group">
            <h3 class="subtitle">Custom Content</h3>
            <p>This is a CMS block edited from admin. You can insert any content (HTML, Text, Images) Here. </p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
            <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
          </div>
          <div class="banner owl-carousel">
             <?php
			   unset($info);
			   unset($data);
			$info["table"] = "banner LEFT JOIN products ON(banner.products_id=products.id)";
			$info["fields"] = array("banner.*,products.product_name,products.id"); 
			$info["where"]   = "1  AND display_position LIKE '%left%'   LIMIT 0,5";
			$arr =  $db->select($info);
			for($i=0;$i<count($arr);$i++)
			 {
			?>
            <div class="item"> <a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>&product_name=<?=$arr[$i]['product_name']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_picture']?>" alt="<?=$arr[$i]['product_name']?>" class="img-responsive"  style="width:265px;height:350px;" /></a> </div>
            <!--<div class="item"> <a href="<?=$site_url?>/#"><img src="<?=$site_url?>/image/banner/small-banner-265x350.jpg" alt="<?=$arr[$i]['product_name']?>" class="img-responsive"  style="width:50px;height:50px;"/></a> </div>-->
            <?php
			 }
			?>
          </div>
          <h3 class="subtitle">Latest</h3>
          <div class="side-item">
            <?php
			   unset($info);
			   unset($data);
			$info["table"] = "products";
			$info["fields"] = array("products.*"); 
			$info["where"]   = "1  AND product_display_position LIKE '%Latest%'   LIMIT 0,5";
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
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/nikon_d300_5-50x50.jpg" alt="Hair Care Products" title="Hair Care Products" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Hair Care Products</a></h4>
                <p class="price"> <span class="price-new">$66.80</span> <span class="price-old">$90.80</span> <span class="saving">-27%</span> </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/nikon_d300_4-50x50.jpg" alt="Bed Head Foxy Curls Contour Cream" title="Bed Head Foxy Curls Contour Cream" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Bed Head Foxy Curls Contour Cream</a></h4>
                <p class="price"> $88.00 </p>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_5-50x50.jpg" alt="Shower Gel Perfume for Women" title="Shower Gel Perfume for Women" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Shower Gel Perfume for Women</a></h4>
                <p class="price"> <span class="price-new">$95.00</span> <span class="price-old">$99.00</span> <span class="saving">-4%</span> </p>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_4-50x50.jpg" alt="Perfumes for Women" title="Perfumes for Women" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Perfumes for Women</a></h4>
                <p class="price"> $85.00 </p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_3-50x50.jpg" alt="Make Up for Naturally Beautiful Better" title="Make Up for Naturally Beautiful Better" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Make Up for Naturally Beautiful Better</a></h4>
                <p class="price"> $123.00 </p>
              </div>
            </div>            
            <div class="product-thumb clearfix">
              <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_2-50x50.jpg" alt="Pnina Tornai Perfume" title="Pnina Tornai Perfume" class="img-responsive" /></a></div>
              <div class="caption">
                <h4><a href="<?=$site_url?>/product">Pnina Tornai Perfume</a></h4>
                <p class="price"> $110.00 </p>
              </div>
            </div>
            -->
          </div>
        </aside>
<!-- Left Part End-->