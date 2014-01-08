<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$name = $_POST['name'];
		$link = $_POST['link'];
		$column_name = $_POST['column'];
	}
	//setting category status
	if(isset($name) && !empty($name) && isset($column_name) && !empty($column_name))
	{
		$status = 1;
	}
	
	//insert values to database
	$result = $manageData->insertFooterLinks($name,$link,$column_name,$status);
	
	header("Location: ../../addFooterLinks.php");
	
?>