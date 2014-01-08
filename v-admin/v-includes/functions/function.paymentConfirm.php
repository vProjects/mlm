<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//include class mail
	include '../../../v-includes/class.mail.php';
	$mail = new Mail();
	//taking the values from url
	$order_id = $_GET['o_id'];
	if(!empty($order_id))
	{
		//setting payment request value
		$value = "Progressing";
		//calling method for money distribution
		$result = $manageData->updateValueWhere("purchase_info","payment_request",$value,"order_id",$order_id);
	}
	//getting member or guest email id
	$email = $manageData->getValueWhere("purchase_log","*","order_id",$order_id);
	if($email[0]['membership_id'] == 'guest')
	{
		$email_id = $email[0]['email_id'];
	}
	else
	{
		$member = $manageData->getValueWhere("member_table","*","membership_id",$email[0]['membership_id']);
		$email_id = $member[0]['email_id'];
	}
	//getting the product and coupon id
	$all_products = $manageData->getValueWhere("purchase_info","*","order_id",$order_id);
	//initialize parameter
	$cate = "";
	$quantity = "";
	foreach($all_products as $all_product){
		$val = $all_product['product_id'];
		if(substr($val,0,1) == 'M')
		{
			$product = $manageData->getValueWhere("membership_product","*","product_id",$val);
			$cate = $cate.$product[0]['product_name']."<br>";
			
		}
		else if(substr($val,0,1) == 'C')
		{
			$product = $manageData->getValueWhere("coupon_table","*","coupon_id",$val);
			
			$cate = $cate.$product[0]['coupon_code']."<br>";
		}
		else
		{
			$product = $manageData->getValueWhere("product_table","*","product_id",$val);
			$cate = $cate.$product[0]['product_name']."<br>";
		}
		$sl_no++;
		//llisting the quantity of products
		$quantity = $quantity.$all_product['quantity']."<br>";
	}
	//sending mail to purchaser
	$mailsent = $mail->confirmationOfOrderAccount($email_id,$order_id,$cate,$quantity,$email[0]['price']);
	
	header("Location: ../../duePayment.php");
?>