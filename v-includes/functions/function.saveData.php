<?php
    
    session_start();
    
    
    include '../../v-includes/BLL.getData.php';
    
    $manageContent = new BLL_manageData();
	//including class mail
	include '../../v-includes/class.mail.php';
	$mail = new Mail();
    
    $deliveryStatus = '0';
    $ipaddress = $_SERVER["REMOTE_ADDR"];
    
    switch ($_POST['u']) {
        case 'uni':
            if(!isset($_SESSION['uniqueid']))
                $_SESSION['uniqueid'] = uniqid('order');
            break;
        
        default:
            
            break;
    }
    
    
    
    
    switch ($_POST['refData']) {
        case 'olddata':
            if(isset($_SESSION['memberId'])){
                //takes the values related to the user who is logged in
                $userData = $manageContent ->getUserData($_SESSION['memberId']);
                $insertUserAddress = $manageContent->insertAddressValue($userData[0]['address'],'olddata',$deliveryStatus,$ipaddress,$_SESSION['uniqueid']);
            }
            else {
                // enter just the address guest 
                $insertUserAddress = $manageContent->insertAddressValue($_SESSION['guestId'],'olddata',$deliveryStatus,$ipaddress,$_SESSION['uniqueid']);
            }
            
            break;
        case 'newdata':
            
            $insertUserAddress = $manageContent->insertAddressValue($_POST,'newdata',$deliveryStatus,$ipaddress,$_SESSION['uniqueid']);  
            break;
            
        case 'shipdata':
            $insertshipcomm = $manageContent->insertShipComment($_SESSION['uniqueid'],$_POST['shipcom']);
            break;
			
		case 'memberbalancecheck':
            $withdraw_amount = $manageContent->getNetAmount($_POST['memberid']);
			if($withdraw_amount != 0 && $withdraw_amount >= $_POST['totalPrice'])
			  {
				  echo '1';
			  }
			  else
			  {
				  echo '0';
			  }
            break;	
            
        case 'paymentOption':
                $insertpaymentComm = $manageContent->insertpaymentComm($_SESSION['uniqueid'],$_POST['paymentMethod'],$_POST['orderCom']);
             break;
            
        case 'payment':
              $insertPaymentConfirm = $manageContent->insertPaymentConfirm($_SESSION['uniqueid'],$_POST['totalPrice'],$_POST['memberid'],$_POST['allProducts']);
			  if($insertPaymentConfirm[0] == 1 && $insertPaymentConfirm[1] == 1)
			  {
				  $mailSent = $mail->invoiceOfOrder($insertPaymentConfirm[2],$_SESSION['uniqueid'],$insertPaymentConfirm[3],$insertPaymentConfirm[4],$insertPaymentConfirm[5]);
			  }
            
			  unset($_SESSION['uniqueid']);
              break;
		
		case 'mypayment':
			  $withdraw_amount = $manageContent->getNetAmount($_POST['memberid']);
			  if($withdraw_amount != 0 && $withdraw_amount >= $_POST['totalPrice'])
			  {
					$insertPaymentConfirmAccount = $manageContent->insertPaymentConfirmAccount($_SESSION['uniqueid'],$_POST['totalPrice'],$_POST['memberid'],$_POST['allProducts']);
					$withdraw_insertion = $manageContent->insertWithdrawValue($_POST['memberid'],$_POST['totalPrice'],$_SESSION['uniqueid']);
				  if($insertPaymentConfirmAccount[0] == 1 && $insertPaymentConfirmAccount[1] == 1)
				  {
					  $mailSent = $mail->invoiceOfOrder($insertPaymentConfirmAccount[2],$_SESSION['uniqueid'],$insertPaymentConfirmAccount[3],$insertPaymentConfirmAccount[4],$insertPaymentConfirmAccount[5]);
				  }
				
				  unset($_SESSION['uniqueid']);  
			  }
		
			break;
            
       	default:
            
            break;
    }
    
    
    
    
    
    
    



?>