<?php
    session_start();
	 //include money_mlm to distribute money details among the parents
	include 'v-includes/class.money_mlm.php';
	$manageMoney = new money_mlm();
	include 'v-includes/class.mail.php';
	$mailsent = new Mail();
    $page_title = '';
    if(!isset($_SESSION['memberId'])){
        $_SESSION['guestId'] = 'guest';
    }
	if(isset($GLOBALS['_GET']))
		{
			$membership_id = $_GET['m_id'];
			$total_price = $_GET['total_price'];
			$order_id = $_GET['order_id'];
		}
		//insert values to purchase table
		$result = $manageMoney->insertPaypalPayment($order_id,$total_price,$membership_id);
		//inserting credited amount in money transfer log
		$money = $manageMoney->insertCreditAmounts($membership_id);
		//distribute money to parents
		if($membership_id != 'guest' && substr($membership_id,0,6) == 'member')
		{
			$distribute = $manageMoney->distributeMoneyPaypal($membership_id);
		}
		//getting product details for mailing
		$product_list = $manageMoney->getProductDetailsForPaypal($order_id);
		
		//sending the mail
		$mail = $mailsent->confirmationOfOrderPaypal($result,$order_id,$product_list[0],$product_list[1],$product_list[2]);


 	header("Location: thanku.php");  
?>        
