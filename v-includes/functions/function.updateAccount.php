<?php
	session_start();
	//include the DAL library to use the model layer methods
	include '../class.DAL.php'; 
	//creating object of DAL
	$managedata = new ManageContent_DAL();
	
	//getting values from edit account page
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$membership_id = $_POST['membership_id'];
		$ac_name = $_POST['ac_name'];
		$ac_no = $_POST['ac_no'];
		$bank = $_POST['bank'];
		$branch = $_POST['branch'];
		$ifsc = $_POST['ifsc_code'];
	}
	
	//fetching the id value of database
	$table_id = $managedata->getValue_where("member_account_details","id","membership_id",$membership_id);
	$id = $table_id[0]['id'];
	
	//updating the selected values
	if(isset($ac_name))
	{
		$result = $managedata->updateValueWhere("member_account_details","ac_name",$ac_name,"id",$id);	
	}
	if(isset($ac_no))
	{
		$result = $managedata->updateValueWhere("member_account_details","ac_no",$ac_no,"id",$id);	
	}
	if(isset($bank))
	{
		$result = $managedata->updateValueWhere("member_account_details","bank",$bank,"id",$id);	
	}
	if(isset($branch))
	{
		$result = $managedata->updateValueWhere("member_account_details","branch",$branch,"id",$id);	
	}
	if(isset($ifsc))
	{
		$result = $managedata->updateValueWhere("member_account_details","ifsc_code",$ifsc,"id",$id);	
	}
	
	header("Location: ../../editProfile.php");
?>