<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$quantity = $GLOBALS['_POST']['quantity'];
		$product_id = $GLOBALS['_POST']['p_id'];
	}
	echo "<pre>";
	print_r($GLOBALS['_COOKIE']);
	echo "</pre>";
	
	$cookie_name = 'no_product'.$product_id;
	$cookie_value = $quantity;
	$expiration_day = time()+ 24*3600;
	setcookie($cookie_name,$cookie_value,$expiration_day,'/');
	header("Location: ../../view_cart.php");
?>