<?php
	session_start();
	//include the DAL library to use the model layer methods
	include '../class.DAL.php'; 
	//creating object of DAL
	$managedata = new ManageContent_DAL();
	
	//getting values from change password page
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$password = $_POST['password'];
		$newPassword = $_POST['new_password'];
		$newPassword1 = $_POST['re_new_password'];
		$membership_id = $_POST['membership_id'];
	}
	
	
	if($password != "" && isset($password) && isset($newPassword) && isset($newPassword1) && $newPassword != "" && $newPassword1 !="")
	{
		$password_db = $managedata->getValue_where('member_table','password','membership_id',$membership_id);
		
		if($newPassword == $newPassword1)
		{
			if($password == $password_db[0]['password'])
			{
				$rowCount = $managedata->updateValueWhere("member_table","password",$newPassword,"membership_id",$membership_id);
				if($rowCount == 1)
				{
				 	$_SESSION['result'] = "Password successfully changed";
				}
				else
				{
					$_SESSION['result'] = "Password change Failed";
				}
			}
			else
			{
				$_SESSION['result'] = "Wrong Password";
			}
		}
		else
		{
			$_SESSION['result'] = "New passwords don't match.";
		}
	}
	else
	{
		$_SESSION['result'] = "Please fill the form properly";
	}
	
	header("Location: ../../changePassword.php");
	
?>