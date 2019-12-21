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
        <li><a href="<?=$site_url?>/search/?search-key=<?=trim($_REQUEST['search-key'])?>"><?=trim($_REQUEST['search-key'])?></a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Left Part Start -->
         <?php
		   include("../template/left_menu.php");
		?>
        <!--Left Part End -->
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
          <h1 class="title">Electronics</h1>
          <h3 class="subtitle">Refine Search</h3>
          <div class="category-list-thumb row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4"> <a href="<?=$site_url?>/category"><img src="<?=$site_url?>/image/no_image.jpg" alt="Laptops (6)" /></a> <a href="<?=$site_url?>/category">Laptops (6)</a> </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4"> <a href="<?=$site_url?>/category"><img src="<?=$site_url?>/image/no_image.jpg" alt="Desktops (1)" /></a> <a href="<?=$site_url?>/category">Desktops (1)</a> </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4"> <a href="<?=$site_url?>/category"><img src="<?=$site_url?>/image/no_image.jpg" alt="Cameras (2)" /></a> <a href="<?=$site_url?>/category">Cameras (2)</a> </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4"> <a href="<?=$site_url?>/category"><img src="<?=$site_url?>/image/no_image.jpg" alt="Mobile Phones (4)" /></a> <a href="<?=$site_url?>/category">Mobile Phones (4)</a> </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4"> <a href="<?=$site_url?>/category"><img src="<?=$site_url?>/image/no_image.jpg" alt="TV &amp; Home Audio (11)" /></a> <a href="<?=$site_url?>/category">TV &amp; Home Audio (11)</a> </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4"> <a href="<?=$site_url?>/category"><img src="<?=$site_url?>/image/no_image.jpg" alt="MP3 Players (2)" /></a> <a href="<?=$site_url?>/category">MP3 Players (2)</a> </div>
          </div>
          <div class="product-filter">
            <div class="row">
              <div class="col-md-4 col-sm-5">
                <div class="btn-group">
                  <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                </div>
                <a href="compare.html" id="compare-total">Product Compare (0)</a> </div>
              <div class="col-sm-2 text-right">
                <label class="control-label" for="input-sort">Sort By:</label>
              </div>
              <div class="col-md-3 col-sm-2 text-right">
                <select id="input-sort" class="form-control col-sm-3">
                  <option value="" selected="selected">Default</option>
                  <option value="">Name (A - Z)</option>
                  <option value="">Name (Z - A)</option>
                  <option value="">Price (Low &gt; High)</option>
                  <option value="">Price (High &gt; Low)</option>
                  <option value="">Rating (Highest)</option>
                  <option value="">Rating (Lowest)</option>
                  <option value="">Model (A - Z)</option>
                  <option value="">Model (Z - A)</option>
                </select>
              </div>
              <div class="col-sm-1 text-right">
                <label class="control-label" for="input-limit">Show:</label>
              </div>
              <div class="col-sm-2 text-right">
                <select id="input-limit" class="form-control">
                  <option value="" selected="selected">20</option>
                  <option value="">25</option>
                  <option value="">50</option>
                  <option value="">75</option>
                  <option value="">100</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <div class="row products-category">
            <?php
			if($_SESSION["search"]=="yes")
			  {
				$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
			  }
			  else
			  {
				$whrstr = "";
			  }
			  
			$q  = $_REQUEST['search-key'];
			$whrstr .= " AND ( category.cat_name LIKE '%".$q."%'  
										  OR products.product_title LIKE '%".$q."%' 
												OR products.product_name LIKE '%".$q."%' 
												OR products.brand LIKE '%".$q."%' 
												OR products.model LIKE '%".$q."%'
												OR products.parent_category_txt LIKE '%".$q."%')";
	 
			$rowsPerPage = 10;
			$pageNum = 1;
			if(isset($_REQUEST['page']))
			{
				$pageNum = $_REQUEST['page'];
			}
			$offset = ($pageNum - 1) * $rowsPerPage;  
	 
	 
						  
			unset($info);	
			$info["table"] = "category  JOIN products  ON (products.category_id=category.id)";
			$info["fields"] = array("products.*,category.cat_name"); 
			$info["where"]   = "1   $whrstr ORDER BY products.id DESC  LIMIT $offset, $rowsPerPage";
								
			
			$arr =  $db->select($info);
			
			for($i=0;$i<count($arr);$i++)
			{
			?>	
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>"><img src="<?=$site_url?>/<?=$arr[$i]['file_products']?>"  alt="<?=$arr[$i]['product_name']?>" title="<?=$arr[$i]['product_title']?>" class="img-responsive"   style="width:200px;height:200px;" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product?cmd=details&id=<?=$arr[$i]['id']?>"> <?=$arr[$i]['product_name']?> </a></h4>
                    <p class="description"> <?=substr($arr[$i]['description'],0,200)?>..</p>
                    <p class="price"> <span class="price-new">$<?=$arr[$i]['net_price']?></span> <span class="price-old">$<?=$arr[$i]['price']?></span> <span class="saving">-<?=$arr[$i]['discount']?></span> <!--<span class="price-tax">Ex Tax: $1,400.00</span>--> </p>
                  </div>
                  <div class="button-group">
                    <!--<button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>-->
                    <form name="frm_search_<?=$i?>" id="frm_search_<?=$i?>" action="" method="post">
                       <input type="hidden" name="cmd" value="add_to_cart">
                       <input type="hidden" name="quantity"  value="1">               
                       <input type="hidden" name="os0" value="<?=strip_tags($arr[$i]['description'])?>">
                       <input type="hidden" name="currency" value="<?=$arr[$i]['currency']?>">
                       <input type="hidden" name="amount" value="<?=$arr[$i]['net_price']?>">
                       <input type="hidden" name="shipping_charge" value="<?=$arr[$i]['shipping_cost']?>">
                       <input type="hidden" name="item_name" value="<?=$arr[$i]['product_name']?>">
                       <input type="hidden" name="item_number" value="<?=$arr[$i]['model']?> <?=$arr[$i]['sku']?>">
                       <input type="hidden" name="products_id" value="<?=$arr[$i]['id']?>">
                        <button class="btn-primary" type="button" onClick="formSubmit('frm_search_<?=$i?>');"><span>Add to Cart</span></button>
                    </form>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
			}
			?>
           <!--
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/nikon_d300_1-200x200.jpg" alt="Digital Camera for Elderly" title="Digital Camera for Elderly" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">Digital Camera for Elderly</a></h4>
                    <p class="description"> Engineered with pro-level features and performance, the 12.3-effective-megapixel D300 combines bra..</p>
                    <p class="price"> <span class="price-new">$92.00</span> <span class="price-old">$98.00</span> <span class="saving">-6%</span> <span class="price-tax">Ex Tax: $75.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('31');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/FinePix-Long-Zoom-Camera-200x200.jpg" alt="FinePix S8400W Long Zoom Camera" title="FinePix S8400W Long Zoom Camera" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">FinePix S8400W Long Zoom Camera</a></h4>
                    <p class="description">Product 8
                      ..</p>
                    <p class="price"> $122.00 <span class="price-tax">Ex Tax: $100.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/ipod_shuffle_1-200x200.jpg" alt="Hp Pavilion G6 2314ax Notebok Laptop" title="Hp Pavilion G6 2314ax Notebok Laptop" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">Hp Pavilion G6 2314ax Notebok Laptop</a></h4>
                    <p class="description">Born to be worn.
                      Clip on the worlds most wearable music player and take up to 240 songs with you an..</p>
                    <p class="price"> $122.00 <span class="price-tax">Ex Tax: $100.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/palm_treo_pro_1-200x200.jpg" alt="HTC M7 with Stunning Looks" title="HTC M7 with Stunning Looks" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">HTC M7 with Stunning Looks</a></h4>
                    <p class="description">Redefine your workday with the Palm Treo Pro smartphone. Perfectly balanced, you can respond to busi..</p>
                    <p class="price"> $337.99 <span class="price-tax">Ex Tax: $279.99</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_1-200x200.jpg" alt="Ideapad Yoga 13-59341124 Laptop" title="Ideapad Yoga 13-59341124 Laptop" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">Ideapad Yoga 13-59341124 Laptop</a></h4>
                    <p class="description"> Intel Core 2 Duo processor
                      
                      Powered by an Intel Core 2 Duo processor at speeds up to 2.16GHz, th..</p>
                    <p class="price"> $2.00 <span class="price-tax">Ex Tax: $0.00</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/iphone_1-200x200.jpg" alt="iPhone5" title="iPhone5" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">iPhone5</a></h4>
                    <p class="description">iPhone is a revolutionary new mobile phone that allows you to make a call by simply tapping a name o..</p>
                    <p class="price"> $123.20 <span class="price-tax">Ex Tax: $101.00</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/macbook_air_1-200x200.jpg" alt="Laptop Silver black" title="Laptop Silver black" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">Laptop Silver black</a></h4>
                    <p class="description">MacBook Air is ultrathin, ultraportable, and ultra unlike anything else. But you don’t lose inches a..</p>
                    <p class="price"> <span class="price-new">$1,142.00</span> <span class="price-old">$1,202.00</span> <span class="saving">-5%</span> <span class="price-tax">Ex Tax: $950.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/ipod_nano_1-200x200.jpg" alt="Mp3 Player" title="Mp3 Player" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">Mp3 Player</a></h4>
                    <p class="description"> Video in your pocket.
                      
                      Its the small iPod with one very big idea: video. The worlds most popular..</p>
                    <p class="price"> $122.00 <span class="price-tax">Ex Tax: $100.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/ipod_classic_1-200x200.jpg" alt="Portable Mp3 Player" title="Portable Mp3 Player" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">Portable Mp3 Player</a></h4>
                    <p class="description"> More room to move.
                      
                      With 80GB or 160GB of storage and up to 40 hours of battery life, the new ..</p>
                    <p class="price"> $122.00 <span class="price-tax">Ex Tax: $100.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/ipod_touch_1-200x200.jpg" alt="Samsung Galaxy S4" title="Samsung Galaxy S4" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">Samsung Galaxy S4</a></h4>
                    <p class="description">Revolutionary multi-touch interface.
                      iPod touch features the same multi-touch screen technology as ..</p>
                    <p class="price"> <span class="price-new">$62.00</span> <span class="price-old">$122.00</span> <span class="saving">-50%</span> <span class="price-tax">Ex Tax: $50.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="<?=$site_url?>/product"><img src="<?=$site_url?>/image/product/samsung_tab_1-200x200.jpg" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="<?=$site_url?>/product">Aspire Ultrabook Laptop</a></h4>
                    <p class="description">Samsung Galaxy Tab 10.1, is the world’s thinnest tablet, measuring 8.6 mm thickness, running with An..</p>
                    <p class="price"> <span class="price-new">$230.00</span> <span class="price-old">$241.99</span> <span class="saving">-5%</span> <span class="price-tax">Ex Tax: $190.00</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Product</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            -->
          </div>
          <div class="row">
            <div class="col-sm-6 text-left">
              <ul class="pagination">
                <!--<li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">&gt;</a></li>
                <li><a href="#">&gt;|</a></li>-->
                
                <?php              
					    unset($info);	
					   $info["table"] = "category   JOIN products  ON (products.category_id=category.id)";
					   $info["fields"] = array("count(*) as total_rows"); 
					   $info["where"]   = "1  $whrstr ORDER BY products.id DESC";
					  
					   $res  = $db->select($info);  
	
								
						$numrows = $res[0]['total_rows'];
						$maxPage = ceil($numrows/$rowsPerPage);
						$self = 'index.php?cmd=list&search-key='.$q;
						$nav  = '';
						
						$start    = ceil($pageNum/5)*5-5+1;
						$end      = ceil($pageNum/5)*5;
						
						if($maxPage<$end)
						{
						  $end  = $maxPage;
						}
						
						for($page = $start; $page <= $end; $page++)
						//for($page = 1; $page <= $maxPage; $page++)
						{
							if ($page == $pageNum)
							{
								$nav .= "<li class=\"active\"><span>$page</span></li>"; 
							}
							else
							{
								$nav .= "<li><a href=\"$self&&page=$page\" >$page</a></li>";
							} 
						}
						if ($pageNum > 1)
						{
							$page  = $pageNum - 1;
							$prev  = "<li><a href=\"$self&&page=$page\" >[Prev]</a></li>";
					
						   $first = "<li><a href=\"$self&&page=1\" >[First Page]</a></li>";
						} 
						else
						{
							$prev  = '<li>&nbsp;</li>'; 
							$first = '<li>&nbsp;</li>'; 
						}
					
						if ($pageNum < $maxPage)
						{
							$page = $pageNum + 1;
							$next = "<li><a href=\"$self&&page=$page\" >[Next]</a></li>";
					
							$last = "<li><a href=\"$self&&page=$maxPage\" >[Last Page]</a></li>";
						} 
						else
						{
							$next = '<li>&nbsp;</li>'; 
							$last = '<li>&nbsp;</li>'; 
						}
						
						if($numrows>1)
						{
						  
						   echo $first . $prev . $nav . $next . $last;
						 
						}
					?>     
                
              </ul>
            </div>
            <div class="col-sm-6 text-right">Showing 1 to 12 of 15 (2 Pages)</div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php
   include("../template/footer.php");
?>
    