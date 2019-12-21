<aside id="sidebar-left" class="sidebar-left">
				
    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
            
                <ul class="nav nav-main">
                    <li class="nav-active">
                        <a class="nav-link" href="../home">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>                        
                    </li>
                    <li class="nav nav-children">
                        <a class="nav-link" href="../users/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Users</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../category/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Category</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../products/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Products</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../home_page_category/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Home page category</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../orders/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Orders</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../slide/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Slide</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../banner/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Banner</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../referrals/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Referrals</span>
                        </a>
                     </li>
					 <li class="nav nav-children">
                        <a class="nav-link" href="../review/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Reviews</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../chatbot/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Chatbot</span>
                        </a>
                     </li>
                     <li class="nav-parent" >
                       <a> Settings</a>
                        <ul class="nav nav-children">
                            <li  class="nav-link" ><a href="../about/index.php?cmd=list"><i class="icon-rocket"></i>About</a></li>
                            <li  class="nav-link" ><a href="../contact_us/index.php?cmd=list"><i class="icon-rocket"></i>Contact us</a></li>
                            <li  class="nav-link" ><a href="../privacy_policy/index.php?cmd=list"><i class="icon-rocket"></i>Privacy Policy</a></li>
                            <li  class="nav-link" ><a href="../terms_condition/index.php?cmd=list"><i class="icon-rocket"></i>Terms Condition</a></li>  
                            <li  class="nav-link" ><a href="../returns/index.php?cmd=list"><i class="icon-rocket"></i>Returns</a></li>
                            <li  class="nav-link" ><a href="../gift_voucher/index.php?cmd=list"><i class="icon-rocket"></i>Gift voucher</a></li>
                            <li  class="nav-link" ><a href="../affiliate/index.php?cmd=list"><i class="icon-rocket"></i>Affiliate</a></li>  
                            <li  class="nav-link" ><a href="../delivery_information/index.php?cmd=list"><i class="icon-rocket"></i>Delivery information</a></li>  

                        </ul>
                     </li>
                
                     <li class="nav-parent"   >
                        <a> Newsletter </a>
                        <ul class="nav nav-children">
                            <li   class="nav-link" ><a href="../subscription/index.php?cmd=list"><i class="icon-rocket"></i>Subscription</a></li>
                            <li   class="nav-link" ><a href="../news_letter/index.php?cmd=list"><i class="icon-rocket"></i>News letter</a></li>
                            <li   class="nav-link" ><a href="../send_newsletter/index.php?cmd=list"><i class="icon-rocket"></i>Send News letter</a></li>			        
                        </ul>
                     </li> 

                    
                </ul>
            </nav>
           
        </div>

        <script>
		  $( document ).ready(function() {

				// Maintain Scroll Position
				if (typeof localStorage !== 'undefined') {
					if (localStorage.getItem('sidebar-left-position') !== null) {
						var initialPosition = localStorage.getItem('sidebar-left-position'),
							sidebarLeft = document.querySelector('#sidebar-left .nano-content');
						
						sidebarLeft.scrollTop = initialPosition;
					}
				}
			});
        </script>
        

    </div>

</aside>