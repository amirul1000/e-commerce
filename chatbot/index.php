<?php
    session_start();
	ob_start();
	include("../common/lib.php");
	include("../lib/class.db.php");
	include("../common/config.php");
	include("../lib_cat/lib.php");
	include("../lib_products/lib.php");
    
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1); 

    $msg = strtolower(trim($_REQUEST['msg']));
	
	$arrInput = explode(" ",$msg);
	//debug($arrInput);
	 
	 unset($info);
    $info["table"] = "chatbot";
	$info["fields"] = array("chatbot.*"); 
	$info["where"]   = "1";
	$arr =  $db->select($info);
	
	$arrCount = array();
	
	
	for($i=0;$i<count($arr);$i++)
	{							
		$question =  strtolower($arr[$i]['question']);
		$arrQuestion = explode(" ",$question);
		$arrCount[$i]=0;
	    //debug($arrQuestion);
	    for($j=0;$j<count($arrInput);$j++)
		{
		  for($k=0;$k<count($arrQuestion);$k++)
		  {
			if($arrInput[$j]==$arrQuestion[$k])
			{
				$arrCount[$i]=$arrCount[$i]+1;
			}
		  }
		}	
		//$answer   = strtolower($arr[$i]['answer']);
	}
	//debug($arrCount);
	
	if(array_sum($arrCount)==0)
	{
	  echo "Sorry I can't recognize you.Please provide a bit more details"; 
	  exit;	
	}
	else
	{
		$max = $arrCount[0];
		$indicate = 0;
		for($i=1;$i<count($arrCount);$i++)
		{
			if($arrCount[$i]>$max)
			{
				$max = $arrCount[$i];
				$indicate = $i;
			}
		}
		echo $arr[$indicate]['answer'];
		exit;
	}
  
?>