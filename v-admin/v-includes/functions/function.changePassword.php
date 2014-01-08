<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$old_password = $_POST['old_password'];
		$new_password = $_POST['new_password'];
		$confirm_new_password = $_POST['confirm_new_password'];
	}
	//checking the values with database values
	if($new_password == $confirm_new_password)
	{
		$database_pass = $manageData->getValueWhere("admin_info","*","id",1);
		if($old_password == $database_pass[0]['password'])
		{
			//update password field
			$update = $manageData->updateValueWhere("admin_info","password",$new_password,"id",1);
			$_SESSION['p_msg'] = 'Password Changes Successfully';
			header("Location: ../../changePwd.php");
		}
		else
		{
			$_SESSION['p_msg'] = 'old password does not match';
			header("Location: ../../changePwd.php");
		}
	}
	else
	{
		$_SESSION['p_msg'] = 'password and confirm password field do not match';
		header("Location: ../../changePwd.php");
	}
	
?>