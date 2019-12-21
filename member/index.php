<?php
    session_start();
    if(count($_SESSION['cart']))
	{
		  Header("Location: ../member/cart");
	}
	else
	{
	   Header("Location: home");
	}
?>
