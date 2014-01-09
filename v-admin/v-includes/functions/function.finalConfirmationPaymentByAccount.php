<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../../../v-includes/class.money_mlm.php');
	$manageMoney = new money_mlm();
	//taking the values from url
	$order_id = $_GET['o_id'];
	if(!empty($order_id))
	{
		//calling method for money distribution
		$result = $manageMoney->distributeMoneyByMyAccount($order_id);
	}
	header("Location: ../../finalConfirmationByAccount.php");
?>