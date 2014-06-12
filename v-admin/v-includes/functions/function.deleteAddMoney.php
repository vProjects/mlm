<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from get value
	$id = $_GET['id'];
	
	//updating the selected values
	if(isset($id))
	{
		$result = $manageData->deleteValue("addmoney_info","id",$id);	
	}
	header("Location: ../../pending_add_money.php");
	
?>