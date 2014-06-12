<?php
	session_start();
	//include the DAL library for the method to insert the details
	include ('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//include class mail
	include '../library/class.mail.php';
	$mail = new Mail();
	//taking the values from form
		$m_id = $_POST['m_id'];
		$mail_body = $_POST['mail_body'];
	
	//getting member details
	$member_details = $manageData->getValueWhere("member_table","*","membership_id",$m_id);
	//sending mail to the member
	$mailsent = $mail->membershipExtendationMail($member_details[0]['email_id'],$mail_body);
	header("Location: ../../membership_extendation.php");
	
?>