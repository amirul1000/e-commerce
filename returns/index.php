<?php
	session_start();
	ob_start();
	include("../common/lib.php");
	include("../lib/class.db.php");
	include("../common/config.php");
	include("../lib_cat/lib.php");
	include("../lib_products/lib.php");
	
	$cmd = $_REQUEST['cmd'];
	
	switch($cmd)
	{
		
		default :
			include("returns_view.php");
	}
?>