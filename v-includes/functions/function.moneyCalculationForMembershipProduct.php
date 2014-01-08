<?php
	//include the DAL library to use the model layer methods
	include '../class.money_mlm.php'; 
	//creating object of DAL
	$manageMoney = new money_mlm();
	
	/*taking as constant value*/
	$product_id = "M_1001";
	$membership_id = "member528ca03d4db97";
	$quantity = "1";
	
	$manageMoney->moneyCalculationForMembershipProduct($membership_id,$product_id);

?>