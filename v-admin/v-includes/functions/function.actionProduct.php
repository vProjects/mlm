<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from get value
	$value = $_GET['value'];
	$id = $_GET['id'];
	//getting current date
	$getdate = getdate();
	$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
	
	//updating the selected values
	if(isset($id))
	{
		if($value == 1)
		{
			$result = $manageData->updateValueWhere("product_table","expiration_date",$date,"id",$id);	
		}
		else
		{
			$result = $manageData->updateValueWhere("product_table","expiration_date","0000-00-00","id",$id);
		}
	}	
	header("Location: ../../listProducts.php");
	
?>