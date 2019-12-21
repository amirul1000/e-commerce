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
                    <?php
					  if(count($_SESSION['cart'])>0)
					  {
					?>
                    <li class="nav nav-children">
                        <a class="nav-link" href="../cart/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Cart</span>
                        </a>
                     </li>
                    <?php
					  }
					?>  
                     <li class="nav nav-children">
                        <a class="nav-link" href="../orders/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Orders</span>
                        </a>
                     </li>
                     <li class="nav nav-children">
                        <a class="nav-link" href="../referrals/?cmd=list">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span>Referrals</span>
                        </a>
                     </li>
                      <li class="nav-parent"   >
                        <a> Social Network </a>
                        <ul class="nav nav-children">
                            <li   class="nav-link" ><a href="../fb_app/?cmd=list"><i class="icon-rocket"></i>FB app</a></li>
                            <li   class="nav-link" ><a href="../fb_post/?cmd=list"><i class="icon-rocket"></i>FB post</a></li>
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