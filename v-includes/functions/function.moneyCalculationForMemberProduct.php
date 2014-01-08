<?php 
	//include the DAL library to use the model layer methods
	include '../class.money_mlm.php'; 
	//creating object of DAL
	$manageMoney = new money_mlm();
	
	/*taking as constant value*/
	$product_id = "P_1002";
	$membership_id = "member528fc31c71754";
	$quantity = "3";
	
	$manageMoney->moneyCalculationForMemberProduct($membership_id,$product_id,$quantity);
	
?>