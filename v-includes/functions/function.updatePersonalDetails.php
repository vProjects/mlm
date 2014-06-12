<?php
    session_start();
	//include the DAL library to use the model layer methods
	include '../class.DAL.php'; 
	//creating object of DAL
	$managedata = new ManageContent_DAL();
	
	//getting values from signup page
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$membership_id = $_POST['membership_id'];
		$name = $_POST['name'];
		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
		$contact_no = $_POST['contact_no'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$postal_code = $_POST['postal_code'];
		$state = $_POST['state_id'];
		$country = $_POST['country_id'];
	}
	
	//fetching the id value of database
	$table_id = $managedata->getValue_where("member_table","id","membership_id",$membership_id);
	$id = $table_id[0]['id'];
	//making address field
	$address = $address1."<br>".$address2;
	
	//updating the selected values
	if(isset($name))
	{
		$result = $managedata->updateValueWhere("member_table","name",$name,"id",$id);	
	}
	
	if(isset($dob))
	{
		$result = $managedata->updateValueWhere("member_table","dob",$dob,"id",$id);	
	}
	
	if(isset($gender))
	{
		$result = $managedata->updateValueWhere("member_table","gender",$gender,"id",$id);	
	}
	
	if(isset($contact_no))
	{
		$result = $managedata->updateValueWhere("member_table","contact_no",$contact_no,"id",$id);	
	}
	
	
	if(isset($address1) || isset($address2))
	{
		$result = $managedata->updateValueWhere("member_table","address",$address,"id",$id);	
	}
	
	if(isset($city))
	{
		$result = $managedata->updateValueWhere("member_table","city",$city,"id",$id);	
	}
	
	if(isset($postal_code))
	{
		$result = $managedata->updateValueWhere("member_table","postal_code",$postal_code,"id",$id);	
	}
	
	if(isset($state))
	{
		$result = $managedata->updateValueWhere("member_table","state",$state,"id",$id);	
	}
	
	if(isset($country))
	{
		$result = $managedata->updateValueWhere("member_table","country",$country,"id",$id);	
	}
	
	header("Location: ../../editPersonalDetails.php");
	
?>