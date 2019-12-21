<?php
   //get all child group
   function get_all_child_category($id,$arrtStoreChild,$db)
   {  
        global $arrChild;
        $arrChild = $arrtStoreChild;
		
      	$info["table"] = "category";
		$info["fields"] = array("category.*"); 
		$info["where"]   = " 1=1 AND parent_category_id='".$id."'";		
		$res =  $db->select($info);
				
		
		if(count($res)>=1)
		{	
			for($i=0;$i<count($res);$i++)
			{
				$id        = $res[$i]["id"];  			
				$arrChild[] = $id;
				get_all_child_category($id,$arrChild,$db);
			}
		}
   }   
   //get last  group
   function get_last_category($id,$arrtStoreParent,$db)
   {  
        global $arrParent;
        $arrParent = $arrtStoreParent;
		
			$info["table"] = "category";
			$info["fields"] = array("category.*"); 
			$info["where"]   = " 1=1 AND id='".$id."'";	
			$res =  $db->select($info);
			if(count($res)>=1)
			{	
				for($i=0;$i<count($res);$i++)
				{
					$parent_category_id = $res[$i]["parent_category_id"]; 
					if($res[$i]["parent_category_id"]==0 || $res[$i]["parent_category_id"]=="")
					{
					  return $res[$i]["id"];
					}			
					$arrParent[] = $parent_category_id;
					get_last_category($parent_category_id,$arrParent,$db);
				}
		   }		
   }
   
   
 /*
*/
function get_tree($category_id,$db)
{
    //get all child group	 
	 global $arrChild;
	 get_all_child_category($category_id,array(),$db);
	 if(count($arrChild)>0)
	 {
	   if(is_array($arrChild))
	   {
	   	$allgroup = array_merge(array(0=>$category_id),$arrChild);
	   }
	   else
	   {
	     $allgroup = array(0=>$category_id);  
	   }
	 }
	 else
	 {
	   $allgroup = array(0=>$category_id);
	 }  
	 
	 //search all online owner to invite for vote
	 $k=0;
	 foreach($allgroup as $key=>$category_id)
	 {
	   $info["table"] = "category";
		$info["fields"] = array("category.*"); 
		$info["where"]   = " 1=1 AND id='".$category_id."'";	  
	   $res =  $db->select($info);		
	 
		$cat_name = get_category_name($category_id,$db);
		if($k>0)
		{
		   $parent_category_name = get_category_name($res[0]['parent_category_id'],$db);
		}
		else
		{
		  $parent_category_name = '';
		}
		$k++;
		$arr_virtual_id[] = array($category_id,$cat_name,$parent_category_name);
	 }

	 foreach($arr_virtual_id as $key=>$eachnode)
	 {
		   $tree[$eachnode[1]]=strlen($eachnode[2])>0?$eachnode[2]:null;
	 }
	 
	 return $tree;
}
 
function parseTree($tree, $root = null) {
    $return = array();
    # Traverse the tree and search for direct children of the root
    foreach($tree as $child => $parent) {
        # A direct child is found
        if($parent == $root) {		    
            # Remove item from tree (we don't need to traverse this again)
            unset($tree[$child]);
            # Append the child into result array and parse its children
            $return[] = array(
                'name' => $child,
                'children' => parseTree($tree, $child)
            );
        }
    }
    return empty($return) ? null : $return;    
}
function printTree($tree) {
    if(!is_null($tree) && count($tree) > 0) {
        echo '<ul>';
        foreach($tree as $node) {
            echo '<li>'.$node['name'];
            printTree($node['children']);
            echo '</li>';
        }
        echo '</ul>';
    }
}  
function get_category_name($category_id,$db)
{
    $info["table"] = "category";
	 $info["fields"] = array("category.*"); 
	 $info["where"]   = " 1=1 AND id='".$category_id."'";	   
	 $res =   $db->select($info);
	 if(count($res) >= 1)
	 {
	  return $res[0]["cat_name"];
	 }
} 	 

function get_all_cat_name($db)
{
     $info["table"] = "category";
	 $info["fields"] = array("category.*"); 
	 $info["where"]   = " 1=1 ORDER BY cat_name ASC";	   
	 $res =   $db->select($info);
    	 
	 $list = "";
	 
	 foreach($res  as $key=>$value)
	 {
	   $list .= $value['cat_name'].",";	
	 }	 
	 
	 if(strlen($list)>0) 
	 {
	 	 return substr($list,0,strlen($list)-1);
	 }	 
}  

function get_first($db)
{
    $info["table"] = "category";
	 $info["fields"] = array("category.*"); 
	 $info["where"]   = "1=1 ORDER BY id DESC LIMIT 0,1";	   
	 $res =   $db->select($info); 
	 
	 return $res;
}	
function get_last($db)
{
     $info["table"] = "category";
	 $info["fields"] = array("category.*"); 
	 $info["where"]   = "1=1 ORDER BY id ASC LIMIT 0,1";	   
	 $res =   $db->select($info); 
	 
	 return $res;
}	
?>	   