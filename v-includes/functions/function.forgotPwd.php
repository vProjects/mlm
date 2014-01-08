<?php
    
    $sessionStart = session_start();
    //include the DAL library to use the model layer methods
    
    
    // check whether session has started or not if yes then executes the cosed else sends an error message
    if($sessionStart == TRUE){
        include '../BLL.getData.php'; 
        //creating object of DAL
        $bllMangageData = new BLL_manageData();
		//include the mail class to send the mails to new sign up
		include '../class.mail.php';
		$mail = new Mail();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['email_id']) == null){   
                //sets the session value which can be used to show error message to the user
                $_SESSION['error'] = 'Email Id not entered';   
            }
            else 
              $result = $bllMangageData->forgot_pwd($_POST['email_id']);
              if($result[0] == 'success'){
				  $mailsent = $mail->mailPassword($_POST['email_id'],$result[1]);
				  if($mailsent == 'mailsent')
				  {
					  $_SESSION['message'] = 'Password Is Sent To Your Email Id';
				  }
				  else
				  {
					  $_SESSION['message'] = 'Password Can Not Delivered Due To Some Reason';
				  }
				  
              }
              else if($result[0] == 'failed'){
                  // sets the session variable for inccorect username or password
                  $_SESSION['error'] = 'Email ID entered is incorrect';
              }
        }
		header('Location: ../../forgot_pwd.php');
    
    }


?>