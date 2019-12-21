<?php
         session_start();
      include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   include("../lib_cat/lib.php");

      $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   { 
		  case 'get_level_data':
		        $level = $_REQUEST['level'];
		        
	      	    $info["table"] = "category";
				$info["fields"] = array("category.*"); 
				$info["where"]   = "1 AND parent_category_id='".$_REQUEST['category_id']."'   ORDER BY cat_name ASC";
				$arr =  $db->select($info);
							
				 
				$options = "";
	           for($i=0;$i<count($arr);$i++)
				{
				  $options .= '<option value="'.$arr[$i]["id"].'">'.$arr[$i]["cat_name"].'</option>';
				}
				if(count($arr)>0)
				{
					//echo json_encode($arr);	
					$str = '<select  name="category_id_'.$level.'" id="category_id_'.$level.'"  class="form-control" onchange="fillUpNextLevel(this.value,'.$level.');" required>
							  <option value="">--Select--</option>
							  '.$options.'
							</select>';
							$level = $level + 1;
					$str .= '<div id="next_level_'.$level.'"></div>';
					echo $str;
				}
				else
				{
				  echo '0'; 
				}	
				break;    
	   }
?>	   
	   