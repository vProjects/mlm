<?php
    
    $sessionStart = session_start();
    //include the DAL library to use the model layer methods
    
    
    // check whether session has started or not if yes then executes the cosed else sends an error message
    if($sessionStart == TRUE){
        include '../BLL.getData.php'; 
        //creating object of DAL
        $bllMangageData = new BLL_manageData();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['email_id']) == null || $_POST['password'] == null){
                    
                //sets the session value which can be used to show error message to the user
                $_SESSION['login_error'] = 'Email Id or password not entered';
                header('Location: ../../login.php');
            }
            else 
              $result = $bllMangageData->login_users($_POST['email_id'],$_POST['password']);
              if($result[0] == 'success'){
				  $_SESSION['memberId'] = $result[1];
                  header('Location: ../../my_tree.php');
              }
              else if($result[0] == 'failed' && $result[1] == 'incorrect'){
                  // sets the session variable for inccorect username or password
                  $_SESSION['login_error'] = 'Email ID or password entered is incorrect';
                  header('Location: ../../login.php');
              }
			  else if($result[0] == 'failed' && $result[1] == 'invalid_email'){
				  // sets the session variable for invalid member
                  $_SESSION['memberId'] = $result[2];
				  $_SESSION['invalid_member'] = 'Invalid Member';
                  header('Location: ../../invalidMember.php');
			  }
			  else if($result[0] == 'failed' && $result[1] == 'invalid_user'){
				  // sets the session variable for invalid member
                  $_SESSION['memberId'] = $result[2];
                  header('Location: ../../invalidMember.php');
			  }
			  else if($result[0] == 'failed' && $result[1] == 'invalid_all'){
				  // sets the session variable for invalid member
                  $_SESSION['memberId'] = $result[2];
				  $_SESSION['invalid_member'] = 'Invalid Member';
                  header('Location: ../../invalidMember.php');
			  }
        }
    
    }
    else 
        echo 'some server error';


?>