<!-- Main Menu Start-->
    <div class="container">
      <nav id="menu" class="navbar">
        <div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a class="home_link" title="Home" href="<?=$site_url?>/"><span>Home</span></a></li>
            <li class="mega-menu dropdown"><a>Categories</a>
              <div class="dropdown-menu">
              <?php
                 unset($info);		  
                $info["table"] = "category";
                $info["fields"] = array("category.*"); 
                $info["where"]   = "1  AND parent_category_id='0'";
                $arr1 =  $db->select($info);
				for($i=0;$i<count($arr1);$i++)
				{
				?>
                <div class="column col-lg-2 col-md-3"><a href="<?=$site_url?>/category?cmd=category&category=<?=$arr1[$i]['cat_name']?>"><?=$arr1[$i]['cat_name']?></a>
                  <div>
                    <?php
						  unset($info);		  
						$info["table"] = "category";
						$info["fields"] = array("category.*"); 
						$info["where"]   = "1 AND parent_category_id='".$arr1[$i]['id']."'";
						$arr2 =  $db->select($info);
						for($j=0;$j<count($arr2);$j++)
				         {
                    ?>
                    <ul>
                      <li><a href="<?=$site_url?>/category?cmd=category&category=<?=$arr2[$j]['cat_name']?>"><?=substr($arr2[$j]['cat_name'],0,18)?> <span>&rsaquo;</span></a>
                        
                            <?php
								unset($info);		  
							$info["table"] = "category";
							$info["fields"] = array("category.*"); 
							$info["where"]   = "1 AND parent_category_id='".$arr2[$j]['id']."'";
							$arr3 =  $db->select($info);
							if(count($arr3)>0)
							{
						    ?>
                            <div class="dropdown-menu">
                              <ul>
                               <?php
							    for($k=0;$k<count($arr3);$k++)
							    {
							  ?>		
                                <li><a href="<?=$site_url?>/category?cmd=category&category=<?=$arr3[$k]['cat_name']?>"><?=$arr3[$k]['cat_name']?></a></li>
                              <?php
								}
						      ?>
                             </ul>
                            </div> 
                         <?php
							}
					     ?>
                      </li>
                    </ul>    
                    <?php
					}
				   ?>
                    
                  </div>
                </div>
               <?php
				}
               ?>
               
               
              </div>
            </li>
            <?php
                /* unset($info);		  
                $info["table"] = "products";
                $info["fields"] = array("distinct(products.brand) as brand"); 
                $info["where"]   = "1  ORDER BY brand ASC";
                $arr1 =  $db->select($info);
				for($i=0;$i<count($arr1);$i++)
				{*/
			?>
            <!--<li class="menu_brands dropdown"><a href="<?=$site_url?>/#">brand</a>
              <div class="dropdown-menu">
                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-6">
                    <a href="<?=$site_url?>/#">
                      <img src="<?=$site_url?>/image/product/apple_logo-60x60.jpg" title="<?=$arr1[$i]['brand']?>" alt="<?=$arr1[$i]['brand']?>" />
                    </a>
                    <a href="<?=$site_url?>/#"><?=$arr1[$i]['brand']?></a></div>
              </div>
            </li>-->
            <?php
				//}
            ?>
            
            <!--<li class="custom-link"><a href="<?=$site_url?>/#">Custom Links</a></li>
            <li class="dropdown wrap_custom_block hidden-sm hidden-xs"><a>Custom Block</a>
              <div class="dropdown-menu custom_block">
                <ul>
                  <li>
                    <table>
                      <tbody>
                        <tr>
                          <td><img alt="" src="<?=$site_url?>image/banner/cms-block.jpg"></td>
                          <td><img alt="" src="<?=$site_url?>image/banner/responsive.jpg"></td>
                          <td><img alt="" src="<?=$site_url?>image/banner/cms-block.jpg"></td>
                        </tr>
                        <tr>
                          <td><h4>CMS Blocks</h4></td>
                          <td><h4>Responsive Template</h4></td>
                          <td><h4>Dedicated Support</h4></td>
                        </tr>
                        <tr>
                          <td>This is a CMS block. You can insert any content (HTML, Text, Images) Here.</td>
                          <td>This is a CMS block. You can insert any content (HTML, Text, Images) Here.</td>
                          <td>This is a CMS block. You can insert any content (HTML, Text, Images) Here.</td>
                        </tr>
                        <tr>
                          <td><strong><a class="btn btn-primary btn-sm" href="<?=$site_url?>/#">Read More</a></strong></td>
                          <td><strong><a class="btn btn-primary btn-sm" href="<?=$site_url?>/#">Read More</a></strong></td>
                          <td><strong><a class="btn btn-primary btn-sm" href="<?=$site_url?>/#">Read More</a></strong></td>
                        </tr>
                      </tbody>
                    </table>
                  </li>
                </ul>
              </div>
            </li>
            <li class="dropdown"><a href="<?=$site_url?>/blog.html">Blog</a>
              <div class="dropdown-menu">
              <ul>
              <li><a href="<?=$site_url?>/blog.html">Blog</a></li>
                  <li><a href="<?=$site_url?>/blog-grid.html">Blog Grid</a></li>
                  <li><a href="<?=$site_url?>/blog-detail.html">Single Post</a></li>
              </ul>
              </div>
            </li>
            <li class="dropdown"><a>Pages</a>
              <div class="dropdown-menu">
                <ul>
                  <li><a href="<?=$site_url?>/category">Category (Grid/List)</a></li>
                  <li><a href="<?=$site_url?>/product.html">Product Page</a></li>
                  <li><a href="<?=$site_url?>/cart.html">Shopping Cart</a></li>
                  <li><a href="<?=$site_url?>/checkout.html">Checkout</a></li>
                  <li><a href="<?=$site_url?>/compare.html">Product Compare</a></li>
                  <li><a href="<?=$site_url?>/wishlist.html">Wishlist</a></li>
                  <li><a href="<?=$site_url?>/search.html">Search</a></li>
                  <li><a href="<?=$site_url?>/manufacturer.html">Brands</a></li>
                </ul>
                <ul>
                  <li><a href="<?=$site_url?>/about-us.html">About Us</a></li>
                  <li><a href="<?=$site_url?>/elements.html">Elements</a></li>
                  <li><a href="<?=$site_url?>/elements-forms.html">Forms</a></li>
                  <li><a href="<?=$site_url?>/careers.html">Careers</a></li>
                  <li><a href="<?=$site_url?>/faq.html">Faq</a></li>
                  <li><a href="<?=$site_url?>/404.html">404</a></li>
                  <li><a href="<?=$site_url?>/sitemap.html">Sitemap</a></li>
                  <li><a href="<?=$site_url?>/contact-us.html">Contact Us</a></li>
                  <li><a href="<?=$site_url?>/email-template" target="_blank">Email Template Page</a></li>
                </ul>                
                <ul>
              <li><a href="<?=$site_url?>/login.html">Login</a></li>
                  <li><a href="<?=$site_url?>/register.html">Register</a></li>
                  <li><a href="<?=$site_url?>/my-account.html">My Account</a></li>
                  <li><a href="<?=$site_url?>/order-history.html">Order History</a></li>
                  <li><a href="<?=$site_url?>/order-information.html">Order Information</a></li>
                  <li><a href="<?=$site_url?>/return.html">Return</a></li>
                  <li><a href="<?=$site_url?>/gift-voucher.html">Gift Voucher</a></li>
              </ul>
              </div>
            </li>-->
            <li class="contact-link"><a href="<?=$site_url?>/contact_us">Contact Us</a></li>
            <li class="custom-link-right"><a href="<?=$site_url?>/member/cart" target="_blank"> Buy Now!</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- Main Menu End-->