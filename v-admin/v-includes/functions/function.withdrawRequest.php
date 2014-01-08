<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from url
	$withdraw_order_id = $_GET['w_id'];
	//approve the withdrawal request
	$result = $manageData->updateValueWhere("withdraw_log","status",1,"withdraw_order_id",$withdraw_order_id);
	header("Location: ../../pendingWithdrawal.php");
	
?>