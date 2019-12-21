<?php 

   $host     = "localhost"; 
   $database = "o2";
   $user     = "root";
   $password = "secret";
   
   $db  = new Db($host,$user,$password,$database);
   
   $GLOBALS['DB'] = $db;

?>
