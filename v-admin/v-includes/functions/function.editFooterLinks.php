<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		$link = $_POST['link'];
	}
	
	//updating the selected values
	if(isset($name) && !empty($name))
	{
		$result = $manageData->updateValueWhere("footer_content","name",$name,"id",$id);	
	}
	
	if(isset($link))
	{
		$result = $manageData->updateValueWhere("footer_content","link",$link,"id",$id);	
	}
	header("Location: ../../listFooterLinks.php");
	
?>