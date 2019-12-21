<?php
/*
*get_users_name
*/
function get_users_name($db,$users_id)
{

    $info2['table']    = "users";	
	$info2['fields']   = array("*");	   	   
	$info2['where']    =  "1 AND id='".$users_id."' LIMIT 0,1";
	$res2  =  $db->select($info2);
	return $res2[0]['first_name'].' '.$res2[0]['last_name'];	
}

function get_username($db,$users_id)
{

    $info2['table']    = "users";	
	$info2['fields']   = array("*");	   	   
	$info2['where']    =  "1 AND id='".$users_id."' LIMIT 0,1";
	$res2  =  $db->select($info2);
	return $res2[0]['username'];	
}
/*
*get_file_picture
*/
function get_file_picture($db,$users_id)
{

    $info2['table']    = "users";	
	$info2['fields']   = array("*");	   	   
	$info2['where']    =  "1 AND id='".$users_id."' LIMIT 0,1";
	$res2  =  $db->select($info2);
	
	$image = "../".$res2[0]['file_picture'];
	if(!(file_exists($image) && is_file($image)))
	{
	  $image = "../images/no_image.jpg";	
	  return $image;  
	}
	return $image;
}
/*
*get_freind_status
*/
function get_freind_status($db,$users_id)
{
        $info["table"] = "friends";
		$info["fields"] = array("friends.*"); 
		$info["where"]   = "1 AND users_id='".$_SESSION['users_id']."'
		                      AND friend_users_id='".$users_id."'";
		$arr =  $db->select($info);
		
		return $arr[0]['friend_status'];
}
/*
*get_friend_users_id_list
*/
function get_friend_users_id_list($db,$users_id)
{
   
        $info["table"] = "friends";
		$info["fields"] = array("friends.*"); 
		$info["where"]   = "1 AND users_id='".$_SESSION['users_id']."' AND friend_status='accept'";
		$arr =  $db->select($info);

        for($i=0;$i<count($arr);$i++)
		{
		   $arr_friend_users_id[] = $arr[$i]['friend_users_id'];
		}
         
        if(count($arr_friend_users_id)>0)
	    {
	      $str = implode(",",$arr_friend_users_id);
	      return   substr($str,0,strlen($str));
	    }
}

/*
*get_friend_users_id_list
*/
function get_friend_count($db,$users_id)
{
   
        $info["table"] = "friends";
		$info["fields"] = array("count(*) as total_rows"); 
		$info["where"]   = "1 AND users_id='".$_SESSION['users_id']."' AND friend_status='accept'";
		$arr =  $db->select($info);

        return $arr[0]['total_rows'];
}
/*
*get_likes_count
*/
function get_likes_count($db,$contents_id)
{
        unset($info);	
	  $info["table"] = "likes";
	  $info["fields"] = array("count(*) as total_rows"); 
	  $info["where"]   = "1  AND contents_id='".$contents_id."'";
      $res  = $db->select($info);  
      $numrows = $res[0]['total_rows'];
	  
	  return $numrows;
}
/*
*get_likes_users_id
*/
function get_likes_users_id($db,$contents_id)
{
        unset($info);	
	 	$info["table"] = "likes";
		$info["fields"] = array("likes.*"); 
		$info["where"]   = "1  AND likes_users_id='".$_SESSION['users_id']."' 
		                       AND contents_id='".$contents_id."'";
		
		$arr =  $db->select($info);
		
		return count($arr);
		
}
/*
*get_likes_owner_users_id
*/
function get_likes_owner_users_id($db,$contents_id)
{
       unset($info);	               
	$info["table"] = "contents";
	$info["fields"] = array("contents.*"); 
	$info["where"]   = "1 AND id='".$contents_id."'";
	$arr =  $db->select($info);
	
	return $arr[0]['users_id'];
}
/*
*add_views
*/
function add_views($db,$users_id)
{
    
	if($_SESSION['users_id']==$users_id)
	{
	  return;
	}
	else if(empty($_SESSION['users_id']))
	{
	  return; 
	}
	
	$info["table"] = "views";
	$info["fields"] = array("views.*"); 
	$info["where"]   = "1 AND users_id='".$users_id."'  AND viwers_users_id='". $_SESSION['users_id']."'";
	$arr =  $db->select($info);
	
	$Id = $arr[0]['id'];
	
	  unset($info);
	  unset($data);
	$info['table']    = "views";
	$data['users_id']   = $users_id;
	$data['viwers_users_id']   = $_SESSION['users_id'];
	$data['date_time']   = date("Y-m-d H:i:s");
	$info['data']     =  $data;
	
	if(empty($Id))
	{
		 $db->insert($info);
	}
}
/*
*get_views_count
*/
function get_views_count($db,$users_id)
{
       	 unset($info);	
		 unset($info);	
	  $info["table"] = "views";
	  $info["fields"] = array("count(*) as total_rows"); 
	  $info["where"]   = "1 AND users_id='".$users_id."'";
	  $res  = $db->select($info);  
	  
	 $numrows = $res[0]['total_rows'];
	 
	 return $numrows;;
}
/*
*get_page_weights
*/
function get_page_weights($db,$users_id)
{
   
        unset($info);	
	  $info["table"] = "contents";
	  $info["fields"] = array("count(*) as total_rows"); 
	  $info["where"]   = "1  AND users_id='".$users_id."' ORDER BY id DESC";
	   $res  = $db->select($info);  
      $total_contents = $res[0]['total_rows'];
   
   
        unset($info);	
	  $info["table"] = "likes";
	  $info["fields"] = array("count(*) as total_rows"); 
	  $info["where"]   = "1    AND owner_users_id='".$users_id."' ORDER BY id DESC";
	  $res  = $db->select($info);  
	    $total_likes = $res[0]['total_rows'];
		   
   
      return ceil($total_likes/$total_contents);  
}
/*
  get content owner id
*/
function get_content_owner_id($db,$id)
{
    $info["table"] = "contents";
	$info["fields"] = array("contents.*"); 
	$info["where"]   = "1 AND id='".$id."'";
	$arr =  $db->select($info); 
	
	return $arr[0]['users_id'];
}
/*
  check shared
*/
function shared($db,$id)
{
    $info["table"] = "shared";
	$info["fields"] = array("shared.*"); 
	$info["where"]   = "1  AND id='".$id."' AND shared_users_id='".$_SESSION['users_id']."'";
	$arr =  $db->select($info);
	
	if(count($arr)>0)
	{
	  return true;
	}
   return false;
}

function get_shared_count($db,$id)
{
  $info["table"] = "shared";
  $info["fields"] = array("count(*) as total_rows"); 
  $info["where"]   = "1 AND contents_id='".$id."'";
  $res  = $db->select($info);  
	$numrows = $res[0]['total_rows'];
  
  return $numrows;
}

function get_comments_count($db,$id)
{
  $info["table"] = "comments";
  $info["fields"] = array("count(*) as total_rows"); 
  $info["where"]   = "1 AND contents_id='".$id."'";
  $res  = $db->select($info);  
	$numrows = $res[0]['total_rows'];
  
  return $numrows;
}

/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
/*
     get user info
  */
  function get_users_info($db,$id)
	  {
		  
		$info["table"] = "users";
		$info["fields"] = array("users.*"); 
		$info["where"]   = "1  AND id='".$id."'";
		$arr =  $db->select($info);
		
		return $arr;
	  }
	  
   /*
     get user info by email
  */
  function get_users_id_by_email($db,$email)
	  {
		  
		$info["table"] = "users";
		$info["fields"] = array("users.*"); 
		$info["where"]   = "1  AND email='".$email."'";
		$arr =  $db->select($info);
		
		return $arr[0]['id'];
	  }
	  
   /*
     get company info
   */	  
   function get_company_info($db,$id)
   {
		$info["table"] = "company";
		$info["fields"] = array("company.*"); 
		$info["where"]   = "1  AND id='".$id."'";
		$arr =  $db->select($info);
		
		return $arr;   
   }
	  
  /*
    get_currency_id
  */ 	  
  function get_currency_id($db,$code)
  {
		$info["table"] = "currency";
		$info["fields"] = array("currency.*"); 
		$info["where"]   = "1 AND code='".$code."'";
	    $arr =  $db->select($info);
		
		return $arr[0]['id'];	
						
  }
  
  /*
    get_currency_code
  */ 	  
  function get_currency_code($db,$id)
  {
		$info["table"] = "currency";
		$info["fields"] = array("currency.*"); 
		$info["where"]   = "1 AND id='".$id."'";
	    $arr =  $db->select($info);
		
		return $arr[0]['code'];	
						
  }
  /*
    add transaction
  */	  
  function add_transaction($db,$arr)
  {
		$info['table']    = "transactions";
		$data['users_id']   = $arr['users_id'];
		$data['subject']   = $arr['subject'];
		$data['description']   = $arr['description'];
		$data['currency']   = $arr['currency'];
		$data['debit']   = $arr['debit'];
		$data['credit']   = $arr['credit'];
		$data['refference']   = $arr['refference'];
		$data['date_time_created']   = $arr['date_time_created'];
		//$info['debug']     = true;
		$info['data']     =  $data;
			 $db->insert($info);
		
  }
  
/*
 get_total_deposits
*/
function get_total_deposits($db,$users_id)
{
	$info["table"] = "deposits";
	$info["fields"] = array("sum(deposits.amount) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}

/*
 get_total_loans
*/
function get_total_loans($db,$users_id)
{
	$info["table"] = "loans";
	$info["fields"] = array("sum(loans.credit-loans.debit) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}
/*
 get_total_credited_loans
*/
function get_total_credited_loans($db,$users_id)
{
	$info["table"] = "loans";
	$info["fields"] = array("sum(loans.credit) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}
/*
 get_total_debitted_loans
*/
function get_total_debitted_loans($db,$users_id)
{
	$info["table"] = "loans";
	$info["fields"] = array("sum(loans.debit) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}




/*
  get_balance
*/
function get_balance($db,$users_id)  
{
	$info["table"] = "transactions";
	$info["fields"] = array("sum(transactions.credit-transactions.debit) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}

/*
  get_transactions_credit
*/
function get_transactions_credit($db,$users_id)  
{
	$info["table"] = "transactions";
	$info["fields"] = array("sum(transactions.credit) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}

/*
  get_transactions_debit
*/
function get_transactions_debit($db,$users_id)  
{
	$info["table"] = "transactions";
	$info["fields"] = array("sum(transactions.debit) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}

/*
 transfer_funds
*/
function get_transfer_funds($db,$users_id)
{
	$info["table"] = "transfer_funds";
	$info["fields"] = array("sum(transfer_funds.amount) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND from_users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}

function get_signup_bonus($db)
{
	$info["table"] = "signup_bonus";
	$info["fields"] = array("signup_bonus.*"); 
	$info["where"]   = "1";
	$arr =  $db->select($info);
	
	return $arr[0]['bonus_amount'];

}

function get_total_withdraw($db,$users_id)  
{
	$info["table"] = "withdraw";
	$info["fields"] = array("sum(withdraw.amount) as total"); 
	if($users_id>0)
	{
		$info["where"]   = "1  AND users_id='".$users_id."'";
	}
	else if($users_id=='all')
	{
	  	$info["where"]   = "1";	
	}
	$arr =  $db->select($info);
    if(empty($arr[0]['total']))
	{
		return 0.0;
	}
    return $arr[0]['total']; 	
}

?>