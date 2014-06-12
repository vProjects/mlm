<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from get value
	$id = $_GET['o_id'];
	
	//updating the selected values
	if(isset($id))
	{
		$result1 = $manageData->deleteValue("purchase_log","order_id",$id);
		$result2 = $manageData->deleteValue("purchase_info","order_id",$id);
	}
	header("Location: ../../duePayment.php");
	
?>