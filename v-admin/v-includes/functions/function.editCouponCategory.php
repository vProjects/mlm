<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$category_id = $_POST['id'];
		$category = $_POST['category'];
	}
	
	//updating the selected values
	if(isset($category))
	{
		$result = $manageData->updateValueWhere("coupon_category","category",$category,"id",$category_id);	
	}
	header("Location: ../../couponCategoryList.php");
	
?>