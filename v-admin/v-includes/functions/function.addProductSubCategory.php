<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$category = $_POST['category'];
		$sub_category = $_POST['sub_category'];
	}
	//setting category status
	if(isset($category) && !empty($category))
	{
		$status = 1;
	}
	//setting the current date
	//getting current date/time and expiration date
	$getdate = getdate();
	$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
	//insert values to database
	$result = $manageData->insertSubCategory($category,$sub_category,$date,$status);
	
	header("Location: ../../addSubCategory.php");
	
?>