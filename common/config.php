<?php 

   /*$host     = "localhost"; 
   $database = "o2";
   $user     = "o2";
   $password = "12345678";*/
   
   $host     = "localhost"; 
   $database = "github_ecommerce";
   $user     = "root";
   $password = "secret";
   
   $db  = new Db($host,$user,$password,$database);
   
   $GLOBALS['DB'] = $db;

?>
