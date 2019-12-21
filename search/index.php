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
		case "product_autocomplete":
						$q = '';
						if (isset($_REQUEST['q'])) {
							$q = strtolower($_REQUEST['q']);
						}
						if (!$q) {
							return;
						}
		
						 unset($info);	
						$info["table"] = "category  LEFT OUTER JOIN products  ON (products.category_id=category.id)";
						$info["fields"] = array("products.*,category.cat_name"); 
						$info["where"]   = "1 OR category.cat_name='%".$q."%'  
										  OR products.product_title='%".$q."%' 
												OR products.product_name='%".$q."%' 
												OR products.brand='%".$q."%' 
												OR products.model='%".$q."%'";
												
						$arr =  $db->select($info);
						
						
						for($i=0;$i<count($arr);$i++)
						 {
							$com = "/$q/i";
							$key   = $arr[$i]['product_title'];
							$value = $arr[$i]['product_title'];	
							
							if (preg_match($com,$key))
							{					
								//echo "$value|$key\n";
								$arr_result[] = $value; 
							}
							
							$key   = $arr[$i]['product_name'];
							$value = $arr[$i]['product_name'];	
							if (preg_match($com,$key))
							{										
								//echo "$value|$key\n";
								$arr_result[] = $value; 
							}
							
							$key   = $arr[$i]['brand'];
							$value = $arr[$i]['brand'];	
							if (preg_match($com,$key))
							{										
								//echo "$value|$key\n";
								$arr_result[] = $value; 
							}
							
							$key   = $arr[$i]['model'];
							$value = $arr[$i]['model'];	
							if (preg_match($com,$key))
							{										
								//echo "$value|$key\n";
								$arr_result[] = $value; 
							}
							
							$key = $arr[$i]['cat_name'];
							$value = $arr[$i]['cat_name'];	
							if (preg_match($com,$key))
							{									
								//echo "$value|$key\n";
								$arr_result[] = $value; 
							}
						}
						
						$result = array_unique($arr_result);		
						echo '<ul id="data-list">';
						foreach($result as $key=>$value)
						{
						  //echo "$value|$value\n";
						   echo '<li onClick="selectData(\''.$value.'\');">'.$value.'</li>';
						} 
						echo '</ul>';
			  break;
		 default :
			include("search_view.php");
     }