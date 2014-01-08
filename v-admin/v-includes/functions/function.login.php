<?php
	$sessionStart = session_start();
	
	// check whether session has started or not if yes then executes the cosed else sends an error message
	if($sessionStart == TRUE)
	{
		//include the BLL library for login
		include('../library/library.BLL.php');
		$manageBll = new manageContent_BLL();
		
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			if($username == null || $password == null)
			{
				//sets the session value which can be used to show error message to the user
				$_SESSION['login_error'] = 'Email Id or password not entered';
				header('Location: ../../index.php');
			}
			else
			{
				$result = $manageBll->loginAdmin($username,$password);
				if($result == 'success')
				{
					$_SESSION['id'] = session_id();
					header('Location: ../../admin.php');
				}
				else
				{
					$_SESSION['login_error'] = 'Email Id or password are invalid';
					header('Location: ../../index.php');
				}
			}
		}
	}
	
?>