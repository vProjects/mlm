<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$category = $_POST['category'];
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
	$result = $manageData->insertCouponCategory($category,$date,$status);
	
	header("Location: ../../addCouponCategory.php");
	
?>