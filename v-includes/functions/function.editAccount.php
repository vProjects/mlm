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

	
	if(isset($membership_id) && !empty($membership_id) && isset($ac_name) && !empty($ac_name) && isset($ac_no) && !empty($ac_no) && isset($bank) && !empty($bank) && isset($branch) && !empty($branch))
	{
		$status = 1;
		$result = $managedata->insertAcDetails($membership_id,$ac_name,$ac_no,$bank,$branch,$ifsc,$status);
	}
	
	header("Location: ../../editProfile.php");

?>