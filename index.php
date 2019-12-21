<?php
       session_start();
	   include("common/lib.php");
	   include("lib/class.db.php");
	   include("common/config.php");
	   include("lib_cat/lib.php");
	   include("lib_products/lib.php");
	   
	   if(isset($_REQUEST['ref']))
	   {
		   setcookie("affiliate_users_id", $_REQUEST['ref'], time()+3600*24*90);
	   }
	
	   $cmd = $_REQUEST['cmd'];
	   
		switch($cmd)
		{
		 
		default :
				include("home_view.php");
		}	
 
?>