<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from url
	$order_id = $_GET['o_id'];
	if(!empty($order_id))
	{
		//calling method for undo payment confirmation
		$result = $manageData->updateValueWhere("purchase_info","payment_request","Undo","order_id",$order_id);
	}
	header("Location: ../../finalConfirmationPayment.php");
?>