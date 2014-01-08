<?php
	//include the DAL library to use the model layer methods
	include '../class.DAL.php'; 
	//creating object of DAL
	$managedata = new ManageContent_DAL();
	
	/*taking as constant value*/
	$product_id = "P_003";
	$membership_id = "member528c9e69f2d45";
	
	$table_name1 = "mlm_info";
	$table_name2 = "member_table";
	$table_name3 = "product_table";
	$table_name4 = "money_transfer_log";
	
	$product_details = $managedata->getValue_where($table_name3,"*","product_id",$product_id);
	$discount = $product_details[0]['discount'];
	$price_member = $product_details[0]['price_members'];
	
	$distributed_amount = ($price_member * $discount)/100;
	echo $distributed_amount."<br>";
	
	//money calculation for buyer as member
	$receiving_amount = ($distributed_amount/2);
	echo $receiving_amount;	

	//money calculation for 1st parent member
	$parent_id = $managedata->getValue_where($table_name1,"parent_id","membership_id",$membership_id);
	if(count($parent_id) > 0)
	{
		print_r($parent_id)."<br>";
		$parent_membership_id = $managedata->getValue_where($table_name1,"membership_id","id",$parent_id[0]['parent_id']);
		print_r($parent_membership_id)."<br>";
		$amount_1st = ($distributed_amount/4);
		echo $amount_1st;
	}
	
	/*if($result0[0] == 1)
	{
		$result = $manageMoney->amountForParent($membership_id,$product_id,$distributed_amount,$result0[1],2);
	print_r($result); echo "<br>";
	}
	else
	{
		//invalid member
	}

	if($result[0] == 1)
	{
		$result2 = $manageMoney->amountForParent($result[2],$product_id,$distributed_amount,$result[1],3);
		print_r($result2); echo "<br>";
	}
	else
	{
		//inserting rest amount to a particuler account
	}
	
	if($result2[0] == 1)
	{
		$result3 = $manageMoney->amountForParent($result2[2],$product_id,$distributed_amount,$result2[1],4);
		print_r($result3); echo "<br>";
	}
	else
	{
		//inserting rest amount to a particuler account 
	}
	
	if($result3[0] == 1)
	{
		$result4 = $manageMoney->amountForParent($result3[2],$product_id,$distributed_amount,$result3[1],5);
		print_r($result4); echo "<br>";
	}
	else
	{
		//inserting rest amount to a particuler account 
	}
	
	if($result4[0] == 1)
	{
		$result5 = $manageMoney->amountForParent($result4[2],$product_id,$distributed_amount,$result4[1],6);
		print_r($result5);
	}
	else
	{
		//inserting rest amount to a particuler account 
	}
	
	if($result5[0] == 1)
	{
		$result6 = $manageMoney->amountForParent($result5[2],$product_id,$distributed_amount,$result5[1],7);
		print_r($result5);
	}
	else
	{
		echo "no parent element";
		//inserting rest amount to a particuler account 
	}*/
	
	


?>