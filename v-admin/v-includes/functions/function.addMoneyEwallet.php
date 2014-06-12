<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$m_id = $GLOBALS['_GET']['member_id'];
	}
	
	//create money id
	$money_id = uniqid('money');
	//getting new date
	$curdate = getdate();
	$date = $curdate['year']."-".$curdate['mon']."-".$curdate['mday'];
	echo $date;
	//inserting values to add money table
	$column_name = array("membership_id","money_id","date");
	$column_value = array($m_id,$money_id,$date);
	$insert = $manageData->insertValue("addmoney_info",$column_name,$column_value);
	
	header("Location: ../../pending_add_money.php");
?>