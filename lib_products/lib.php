<?php

 function get_best_sellers($db,$parent_category_txt)
 {
	 unset($info);
	$info["table"] = "products";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1 AND parent_category_txt  
	LIKE '%".mysqli_escape_string($db->linkid,$parent_category_txt)."%' LIMIT 0,5";
	$arr_product =  $db->select($info);
	
	return $arr_product;
 }

 
 function get_most_popular_products($db,$parent_category_txt)
 {
	 unset($info);
	$info["table"] = "products";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1 AND parent_category_txt  
	LIKE '%".mysqli_escape_string($db->linkid,$parent_category_txt)."%' LIMIT 0,5";
	$arr_product =  $db->select($info);
	
	return $arr_product;
 }
 
 
 
// 'NEW ARRIVALS','THE BEST SELLERS','MOST POPULAR PRODUCTS'
 function get_displayproducts($db,$display_type)
 {			  
	$info["table"] = "displayproducts LEFT OUTER JOIN products ON(displayproducts.products_id=products.id)";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1 AND display_type LIKE '%".$display_type."%' ORDER BY id DESC LIMIT 0,15";
	$arr =  $db->select($info);
	return $arr;
 }
 
function get_occasionsproducts($db,$occasion_name)
 {			  
	$info["table"] = "products";
	$info["fields"] = array("products.*"); 
	$info["where"]   = "1 AND occasions LIKE '%".mysqli_escape_string($db->linkid,$occasion_name)."%'  ORDER BY id DESC  LIMIT 0,15";
	$arr =  $db->select($info);
	return $arr;
 }
 
function add_products_views($db)
{
	
	$info["table"] = "products_views";
	$info["fields"] = array("products_views.*"); 
	$info["where"]   = "1  AND products_id='".$_REQUEST['id']."'";
	$arr =  $db->select($info);
	
	if($arr[0]['count']>0)
	{
		  unset($info);
		  unset($data);
		$info['table']    = "products_views";
		$data['count']   = $arr[0]['count']+1;
		$info['where'] = "products_id='".$_REQUEST['id']."'";
		$info['data']     =  $data;
		if(!empty($_REQUEST['id']))
		{
			 $db->update($info);
		}
	}
	else
	{
		  unset($info);
		  unset($data);
		$info['table']    = "products_views";
		$data['products_id']   = $_REQUEST['id'];
		$data['count']   = '1';
		$info['data']     =  $data;
		if(!empty($_REQUEST['id']))
		{
			 $db->insert($info);
		}
		
	}
	
}

function total_products_views($db)
{
    $info["table"] = "products_views";
	$info["fields"] = array("products_views.*"); 
	$info["where"]   = "1  AND products_id='".$_REQUEST['id']."'";
	$arr =  $db->select($info);
	
	return $arr[0]['count'];
}

/////////////////////////Like//////////////////
function get_products_owner($db,$products_id)
{	
		unset($info);
		unset($data);		  
	$info["table"] = "products";
	$info["fields"] = array("products.users_id"); 
	$info["where"]   = "1  AND id='".$products_id."'";
	$arr =  $db->select($info);
	
	return $arr[0]['users_id'];
}

function add_product_likes($db)
{
	
	$info["table"] = "product_likes";
	$info["fields"] = array("product_likes.id"); 
	$info["where"]   = "1  AND likes_users_id='".$_SESSION['users_id']."' AND products_id='".$_REQUEST['id']."'";
	$arr =  $db->select($info);
	
	if(count($arr)>0)
	{
		  unset($info);
		  unset($data);
		$info['table']            = "product_likes";
		$data['like_type']        = $_REQUEST['like_type'];
		$info["where"]            = "1  AND likes_users_id='".$_SESSION['users_id']."' AND products_id='".$_REQUEST['id']."'";
		$info['data']     =  $data;
			 $db->update($info);
	}
	else
	{
		  unset($info);
		  unset($data);
		$info['table']            = "product_likes";
		$data['owner_users_id']   = get_products_owner($db,$_REQUEST['id']);
		$data['likes_users_id']   = $_SESSION['users_id'];
		$data['products_id']      = $_REQUEST['id'];
		$data['like_count']       = 1;
		$data['like_type']        = $_REQUEST['like_type'];
		$data['date_created']     = date("Y-m-d H:i:s");
		$info['data']     =  $data;
		$db->insert($info);
	}
}


function total_product_likes($db)
{
    $info["table"] = "product_likes";
	$info["fields"] = array("sum(like_count) as total"); 
	$info["where"]   = "1  AND products_id='".$_REQUEST['id']."' AND like_type='like'";
	$arr =  $db->select($info);
	
	return $arr[0]['total']>0?$arr[0]['total']:0;
}

function total_product_dislikes($db)
{
    $info["table"] = "product_likes";
	$info["fields"] = array("sum(like_count) as total"); 
	$info["where"]   = "1  AND products_id='".$_REQUEST['id']."' AND like_type='dislike'";
	$arr =  $db->select($info);
	
	return $arr[0]['total']>0?$arr[0]['total']:0;
}

?>