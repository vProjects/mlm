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
		$result = $manageData->updateValueWhere("product_table","status",0,"id",$id);	
	}
	header("Location: ../../listProducts.php");
	
?>