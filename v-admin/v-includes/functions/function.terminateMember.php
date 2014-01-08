<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	$membership_id = $_GET['m_id'];
	$validiation_value = $_GET['validiation'];
	//terminate membership validiation
	$result = $manageData->updateValueWhere("member_table","membership_validiation",$validiation_value,"membership_id",$membership_id);
	header("Location:../../upgradeMembershipValidiation.php?membership_id=".$membership_id);
?>