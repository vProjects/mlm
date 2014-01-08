<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$id = $_POST['id'];
		$text = $_POST['bottom_text'];
		
	}
	
	//updating the selected values
	if(isset($text))
	{
		$result = $manageData->updateValueWhere("footer_content","bottom_text",$text,"id",$id);	
	}
	header("Location: ../../editFooterBottomText.php");
	
?>