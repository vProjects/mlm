<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	$id = $_GET['id'];
	$action = $_GET['action'];
	//action for enable or disable
	$result = $manageData->updateValueWhere("footer_content","status",$action,"id",$id);
	
	header("Location:../../listFooterLinks.php");
?>