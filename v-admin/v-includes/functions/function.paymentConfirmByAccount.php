<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//include class mail
	include '../library/class.mail.php';
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
	//getting current date
	$getdate = getdate();
	$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
	//change date format
	$change_date = explode("-",$date);
	$curdate = $change_date[2]."-".$change_date[1]."-".$change_date[0];
	$year = $getdate['year'];
	//getting invoice no
	$invoice = $manageData->getLastValue("purchase_log","*","invoice_no");
	//separating year from invoice no and increase the value by 1
	$new_no = sprintf("%05s",substr($invoice[0]['invoice_no'],5)+1);
	$new_invoice_no = $year."-".$new_no;
	//update invoice no and date
	$updateinvoice = $manageData->updateValueWhere("purchase_log","invoice_no",$new_invoice_no,"order_id",$order_id);
	$updatedate = $manageData->updateValueWhere("purchase_log","invoice_date",$date,"order_id",$order_id);
	//getting member or guest email id
	$email = $manageData->getValueWhere("purchase_log","*","order_id",$order_id);
	if($email[0]['membership_id'] == 'guest')
	{
		$email_id = $email[0]['email_id'];
		$price = 'price_guest';
	}
	else
	{
		$member = $manageData->getValueWhere("member_table","*","membership_id",$email[0]['membership_id']);
		$email_id = $member[0]['email_id'];
		$price = 'price_members';
	}
	//getting the product and coupon id
	$all_products = $manageData->getValueWhere("purchase_info","*","order_id",$order_id);
	//initialize parameter
	$product_details = "";
	$cate = "";
	$quantity = "";
	$total_price_without_tax = 0;
	$total_price_with_tax = 0;
	foreach($all_products as $all_product){
		$val = $all_product['product_id'];
		if(substr($val,0,1) == 'M')
		{
			$product = $manageData->getValueWhere("membership_product","*","product_id",$val);
			$cate = $product[0]['product_name'];
			$tax = 0;
			$product_price = $product[0][$price];
			
		}
		else if(substr($val,0,1) == 'C')
		{
			$product = $manageData->getValueWhere("coupon_table","*","coupon_id",$val);
			$cate = $product[0]['coupon_name'];
			$tax = $product[0]['tax'];
			$product_price = $product[0][$price];
		}
		else
		{
			$product = $manageData->getValueWhere("product_table","*","product_id",$val);
			$cate = $product[0]['product_name'];
			$tax = $product[0]['tax'];
			$product_price = $product[0][$price];
		}
		//getting price without tax
		$price_without_tax = ($all_product['quantity'])*($product_price/(1+($tax/100)));
		$price_with_tax = ($all_product['quantity'])*($product_price);
		$total_price_without_tax = $total_price_without_tax + $price_without_tax;
		$total_price_with_tax = $total_price_with_tax + $price_with_tax;
		$product_details = $product_details.'<tr>
									<td style="border:1px solid;">'.$cate.'</td>
									<td style="border:1px solid;">'.$all_product['quantity'].'</td>
									<td style="border:1px solid;">'.$tax.'</td>
									<td style="border:1px solid;"> €'.round($price_without_tax,2).'</td>
									<td style="border:1px solid;"> €'.$price_with_tax.'</td>
								</tr>';						
	}
	$total_amount_details = '<tr>
								<td style=""></td>
								<td style=""></td>
								<td style=""></td>
								<td style="border:1px solid;color:#ff0000;font-weight:bold;">Cena brez DDV</td>
								<td style="border:1px solid;"> €'.round($total_price_without_tax,2).'</td>
							</tr>
							<tr>
								<td style=""></td>
								<td style=""></td>
								<td style=""></td>
								<td style="border:1px solid;color:#ff0000;font-weight:bold;">Cena z DDV</td>
								<td style="border:1px solid;"> €'.$total_price_with_tax.'</td>
							</tr>';
	//sending mail to purchaser
	$mailsent = $mail->confirmationOfOrderAccount($email_id,$order_id,$product_details,$total_amount_details,$new_invoice_no,$curdate);
	
	header("Location: ../../duePaymentMyAccount.php");
?>