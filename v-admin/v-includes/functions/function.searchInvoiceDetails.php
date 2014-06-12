<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//finding the search key
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$redirect_page = $_POST['redirect_page'];
	}
	
	header("Location: ../../".$redirect_page.".php?from_date=".$from_date."&to_date=".$to_date);
?>