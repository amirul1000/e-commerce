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
		case "review":
				$info['table']    = "review";
				$data['products_id']   = $_REQUEST['products_id'];
				$data['name']   = $_REQUEST['name'];
				$data['review']   = $_REQUEST['review'];
				$data['rating']   = $_REQUEST['rating'];
				$data['date_created']   = date("Y-m-d H:i:s");
				$info['data']     =  $data;
				$status = $db->insert($info);
				
				if($status==true)
				{
					$arr[0]['status'] = 'success';
					$arr[0]['msg']    = "The review has been submitted successfully";
				}
				if($status==false)
				{
					$arr[0]['status'] = 'fail';
					$arr[0]['msg']    = "This review submitting is fail";
				}
				echo json_encode($arr);
		     break; 
		default :
			include("product_view.php");
	}
?>