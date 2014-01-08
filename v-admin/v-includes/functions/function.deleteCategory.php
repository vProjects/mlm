<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from get value
	$category_id = $_GET['c_id'];
	
	//updating the selected values
	if(isset($category_id))
	{
		$result = $manageData->deleteValue("product_category","id",$category_id);	
	}
	header("Location: ../../categoryList.php");
	
?>