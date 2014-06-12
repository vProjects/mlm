<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//include class mail
	include '../library/class.mail.php';
	$mail = new Mail();
	//taking the values from form
	if(isset($GLOBALS['_POST']))
	{
		$id = $_POST['id'];
		$amount = $_POST['amount'];
	}
	
	//getting member details
	$member_id = $manageData->getValueWhere("addmoney_info","*","id",$id);
	$member_details = $manageData->getValueWhere("member_table","*","membership_id",$member_id[0]['membership_id']);
	//updating the selected values
	$result = $manageData->updateValueWhere("addmoney_info","amount",$amount,"id",$id);
	$result1 = $manageData->updateValueWhere("addmoney_info","status",1,"id",$id);
	
	//sending mail to the member
	$mailsent = $mail->confirmationOfAddMoney($member_details[0]['email_id'],$member_id[0]['money_id'],$amount);	
	header("Location: ../../pending_add_money.php");
	
?>