<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if(isset($GLOBALS['_GET']))
	{
		$id = $_GET['id'];
	}
	
	//updating the selected values
	$result = $manageData->deleteValue("mypage","id",$id);	
	header("Location: ../../listmypage.php");
	
?>