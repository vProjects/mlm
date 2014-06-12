<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$description1 = $_POST['description1'];
		$description2 = $_POST['description2'];
	}
	
	if(isset($description1))
	{
		$result = $manageData->updateValueWhere("invalid_member_content","description",$description1,"id",1);	
	}
	
	if(isset($description2))
	{
		$result = $manageData->updateValueWhere("invalid_member_content","description",$description2,"id",2);	
	}
	
	header("Location: ../../editInvalidMemberContent.php");
?>