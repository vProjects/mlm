<?php
	 session_start();
	 //include money_mlm to distribute money details among the parents
	include '../class.money_mlm.php';
	$manageMoney = new money_mlm();
	
	if(isset($GLOBALS['_GET']))
		{
			$membership_id = $_GET['m_id'];
			$total_price = $_GET['total_price'];
		}
		//taking order id from session variable
		$order_id = $_SESSION['uniqueid'];
		
		//insert values to purchase table
		$result = $manageContent->insertPaypalPayment($order_id,$total_price,$membership_id);
		//inserting credited amount in money transfer log
		$money = $manageContent->insertCreditAmounts($membership_id);
		//distribute money to parents
		echo $result;
		if($membership_id != 'guest')
		{
			$result = $manageMoney->distributeMoneyPaypal($membership_id);
		}
		else
		{
			$result = 1;
		}
	
    
    //header("Location: ../../thanku.php"); 
?>
