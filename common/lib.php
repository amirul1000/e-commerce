<?php
 /*
  Get Enum Value
 */

 function getEnumFieldValues($tableName = null, $field = null)
   {
       // Make a DDL query
       $query = "SHOW COLUMNS FROM $tableName LIKE " . q($field);
      
       $result = mysqli_query($GLOBALS['DB']->linkid,$query);
	   
       $data   = mysqli_fetch_array($result);

       if(preg_match("('.*')", $data['Type'], $match))
       {
		  
          $enumStr       = str_replace("'", '', $match[0]);
          $enumValueList = explode(',', $enumStr);
       }

       return $enumValueList;
   }
   
/*
  Get Field Type
*/
 function getFieldType($tableName = null, $field = null)
   {
       // Make a DDL query
       $query = "SHOW COLUMNS FROM $tableName LIKE " . q($field);
      
       $result = mysqli_query($GLOBALS['DB']->linkid,$query);
	   
       $data   = mysqli_fetch_array($result);
       $splitTypeData = explode("(",$data['Type']);
	   $typeName = $splitTypeData[0];
       return $typeName;
   }
/* 
 Get table fields list 
 */ 
function  getTableFieldsName($table)
{
     $sql          =  "select * from  ".$table."";
     $res          =  mysqli_query($GLOBALS['DB']->linkid,$sql);
     $fields       =  mysqli_num_fields($res);
	 
    // Setup an array to store return info
      $hash = array();

      for ($i=0; $i < $fields; $i++)
      {
         $field          =  mysqli_fetch_field_direct($res, $i);
		 
         $hash[$field->name]    = $field->name ;
      }
    return $hash;
}
/*
  Table List
*/
function getTableList($dbname)
{
    $sql = "SHOW TABLES FROM $dbname";
	$result = mysqli_query($GLOBALS['DB']->linkid,$sql);
	
	if (!$result) {
		echo "DB Error, could not list tables\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	while ($row = mysqli_fetch_row($result)) {
		 $arrTable[] = $row[0];
	}
	mysqli_free_result($result);
	return $arrTable;
}
/*
 Set Foreign Key Field value
*/
function setForeignKeyIdValue($db,$table,$field,$value)
{
   if($field==null)
   {
      $hash = getTableFieldsName($table);
	  foreach($hash as $key=>$value2)
		{
			if(!(eregi("_id", $key, $match)||$key=="id"))
			{ 
			  $field=$key;
			  break;
			}
		}
   }
    
	$info['table']    = $table;
	$info['fields']   = array($field);   	   
	$info['where']    =  "1 AND id='".$value."' LIMIT 0,1";
	$res  =  $db->select($info);
	return $res[0][$field];
}
function q($str = null)
	   {
		  return "'" . mysqli_escape_string($GLOBALS['DB']->linkid,$str) . "'";
	   }

 function   debug($var)
	 {
       echo "<pre>";
	      print_r($var);
	   echo "</pre>";
     }

?>