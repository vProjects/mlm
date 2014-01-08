<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//finding the search key
		$search_key = $_POST['search_key'];
		$redirect_page = $_POST['redirect_page'];
		if($search_key == 'product_name')
		{
			$search_value = $_POST['value'];
		}
		else if($search_key == 'membership_product_name')
		{
			$search_value = $_POST['value'];
		}
	}
	
	header("Location: ../../".$redirect_page.".php?".$search_key."=".$search_value);
?>