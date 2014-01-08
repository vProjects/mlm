<?php
    session_start();
	//include the DAL library to use the model layer methods
	include '../class.DAL.php'; 
	//creating object of DAL
	$managedata = new ManageContent_DAL();
    
    
    //include the mail class to send the mails to new sign up
	include '../class.mail.php';
    $mail = new Mail();
	
	//getting values from withdrawal form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$frozen_amount = $_POST['frozen'];
		$withdraw = $_POST['withdraw'];
		$membership_id = $_POST['membership_id'];
	}
	//initialize the total amount
	$amount = 0;
	$withdraw_amount = 0;
	//checking for frozen money or not
	if($frozen_amount == 0)
	{
		//getting the debited amount from database
		$transactions = $managedata->getValue_twoCoditions("money_transfer_log","*","membership_id",$membership_id,"frozen_money",0);
		//getting the amount debited to that member
		foreach($transactions as $transaction)
		{
			//only debited values
			if(!empty($transaction['debit']))
			{
				$amount = $amount + $transaction['debit'];
			}
		}
		//getting the withdrawal amount from database
		$withdraws = $managedata->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",0);
		//getting the amount withdrawal to that member
		if(!empty($withdraws[0]))
		{
			foreach($withdraws as $withdrawal)
			{
				$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
			}
		}
		//the due amount of the member
		$net_amount = $amount - $withdraw_amount;
			
		//checking that input amount is less than or equal to the due amount
		if($withdraw <= $net_amount)
		{
			//generate an order id with prefix withdraw
			$withdrawal_id = uniqid('withdraw');
			//getting current date/time and expiration date
			$getdate = getdate();
			$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
			//setting the status of payment to initialy 0
			$status = 0;
			
			//inserting the values in database
			$result = $managedata->insertWithdrawalAmount($membership_id,$withdraw,0,$withdrawal_id,$date,$status);
			if($result == 1){ header ("Location: ../../ewallet.php?msg=1212");}
		}
		else
		{
			header ("Location: ../../ewallet.php?msg=7788");
		}
		
	}
	else if($frozen_amount == 1)
	{
		//getting the debited amount from database
		$transactions = $managedata->getValue_twoCoditions("money_transfer_log","*","membership_id",$membership_id,"frozen_money",1);
		//getting the amount debited to that member
		foreach($transactions as $transaction)
		{
			//only debited values
			if(!empty($transaction['debit']))
			{
				$amount = $amount + $transaction['debit'];
			}
		}
		//getting the withdrawal amount from database
		$withdraws = $managedata->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",1);
		//getting the amount withdrawal to that member
		if(!empty($withdraws[0]))
		{
			foreach($withdraws as $withdrawal)
			{
				$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
			}
		}
		//the due amount of the member
		$net_amount = $amount - $withdraw_amount;
			
		//checking that input amount is less than or equal to the due amount
		if($withdraw <= $net_amount)
		{
			//generate an order id with prefix withdraw
			$withdrawal_id = uniqid('withdraw');
			//getting current date/time and expiration date
			$getdate = getdate();
			$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
			//setting the status of payment to initialy 0
			$status = 0;
			
			//inserting the values in database
			$result = $managedata->insertWithdrawalAmount($membership_id,$withdraw,1,$withdrawal_id,$date,$status);
			if($result == 1){ header ("Location: ../../ewallet.php?msg=1212");}
		}
		else
		{
			header ("Location: ../../ewallet.php?msg=7788");
		}
	}
	

?>