<?php
	//include the DAL library to use the model layer methods
	include 'class.DAL.php'; 
	//money calculation of mlm starts here
	class money_mlm
	{
		public $manage_data;
		
		/*
		 method for constructing DAL class
		 Auth: Dipanjan
		*/
		function __construct()
		{	
			$this->manage_data = new ManageContent_DAL();
			return $this->manage_data;
		}
		
		/*
		 method for getting product details
		 Auth: Dipanjan
		*/
		function distributedAmount($product_id,$quantity){
			//getting product details of given product id
			$product_details = $this->manage_data->getValue_where("product_table","*","product_id",$product_id);
			//separating required values in an array
			$discount = $product_details[0]['discount'];
			$price_member = $product_details[0]['price_members'];
			//amount which will be distributed among members
			$distributed_amount = ($price_member * $discount)/100;
			$total_distributed_amount = ($distributed_amount * $quantity);
			return $total_distributed_amount;
		}
		
		/*
		 method for getting membership product details
		 Auth: Dipanjan
		*/
		function distributedAmountForMembership($product_id){
			//getting product details of given product id
			$product_details = $this->manage_data->getValue_where("membership_product","*","product_id",$product_id);
			//separating required values in an array
			$discount = $product_details[0]['discount'];
			$price = $product_details[0]['price'];
			//amount which will be distributed among members
			$distributed_amount = ($price * $discount)/100;
			return $distributed_amount;
		}
		
		/*
		 method for getting coupon details
		 Auth: Dipanjan
		*/
		function distributedAmountForCoupon($coupon_id){
			//getting product details of given product id
			$coupon_details = $this->manage_data->getValue_where("coupon_table","*","coupon_id",$coupon_id);
			//separating required values in an array
			$discount = $coupon_details[0]['discount'];
			$price_member = $coupon_details[0]['price_members'];
			//amount which will be distributed among members
			$distributed_amount = ($price_member * $discount)/100;
			return $distributed_amount;
		}
		
		/*
		 method for getting current date
		 Auth: Dipanjan
		*/
		function getDate(){
			//getting current date/time
			$getdate = getdate();
			$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
			return $date;
		}
		
		
		/*
		 method for getting fraction of money distribution rate for business product
 		 Auth: Dipanjan
		*/
		function fractionRateMember($level){
			$level_list = 
			array(1=>0.5, 2=>0.25, 3=>0.10, 4=>0.05, 5=>0.04, 6=>0.03, 7=>0.015, 8=>0.005, 9=>0.005, 10=>0.005);
			foreach($level_list as $key => $value){
				if($key == $level)
				{
					return $value;
				}
			}
		}
		
		/*
		 method for getting fraction of money distribution rate for membership product
 		 Auth: Dipanjan
		*/
		function fractionRateMembership($level){
			$level_list = 
			array(1=>0.5, 2=>0.25, 3=>0.10, 4=>0.05, 5=>0.04, 6=>0.03, 7=>0.01, 8=>0.005, 9=>0.005, 10=>0.005,
			 11=>0.001, 12=>0.001, 13=>0.001, 14=>0.001, 15=>0.001);
			foreach($level_list as $key => $value){
				if($key == $level)
				{
					return $value;
				}
			}
		}
		
		/*
		 method for getting amount calculation of member
		 Auth: Dipanjan
		*/
		function receivingAmount($distributed_amount,$product_id,$quantity,$membership_id){
			//getting the system balence
			$system_balence = $this->manage_data->getLastValue("money_transfer_log","system_balence","id");
			$getting_amount = ($distributed_amount/2);
			//get insertion date
			$date = $this->getDate();
			//calculating new system balence
			$new_system_balence = ($system_balence[0]['system_balence'] - $getting_amount);
			//checking for valid member or not
			$validiation = $this->manage_data->getValue_where("member_table","*","membership_id",$membership_id);
			if($validiation[0]['membership_validiation'] == 0 || $validiation[0]['membership_activation'] == 0)
			{
				$notes = $membership_id;
				$m_id = 'potentialMoney';
			}
			else
			{
				$notes = '';
				$m_id = $membership_id;
			}
			//inserting values in money transfer log table
			$result = $this->manage_data->
			insertDebitAmount($m_id,$product_id,$quantity,$date,$getting_amount,$new_system_balence,0,$notes);
			return array($result,($distributed_amount - $getting_amount),$membership_id);
		}
		
		/*
		 method for getting amount calculation of parent member
		 Auth: Dipanjan
		*/
		
		function amountForParent($membership_id,$product_id,$quantity,$distributed_amount,$rest_amount,$level){
			//getting parent id
			//echo $rest_amount."<br>";
			$parent_id = $this->manage_data->getValue_where("mlm_info","parent_id","membership_id",$membership_id);
			//checking for parent member
			if($parent_id[0]['parent_id'] != "")
			{
				//getting parent membership id
				$parent_membership_id = $this->manage_data->
				getValue_where("mlm_info","membership_id","id",$parent_id[0]['parent_id']);
				//getting the system balence
				$system_balence = $this->manage_data->
				getLastValue("money_transfer_log","system_balence","id");
				//get parent member level 
				//checking for membership product or not
				if(substr($product_id,0,2) == 'M_')
				{
					$fraction_rate = $this->fractionRateMembership($level);
					//setting the frozen money section of database
					if($level > 2)
					{
						$frozen_money = 1;
					}
					else
					{
						$frozen_money = 0;
					}
				}
				else
				{
					$fraction_rate = $this->fractionRateMember($level);
					//setting the frozen money section of database
					if($level > 3)
					{
						$frozen_money = 1;
					}
					else
					{
						$frozen_money = 0;
					}
				}
				//amount received by parent member
				$amount_debited = ($distributed_amount * $fraction_rate);
				//echo $amount_debited."<br>";
				//get insertion date
				$date = $this->getDate();
				//calculating new system balence
				$new_system_balence = ($system_balence[0]['system_balence'] - $amount_debited);
				//checking for valid member or not
				$validiation = $this->manage_data->getValue_where("member_table","*","membership_id",$parent_membership_id[0]['membership_id']);
				if($validiation[0]['membership_validiation'] == 0 || $validiation[0]['membership_activation'] == 0)
				{
					$notes = $parent_membership_id[0]['membership_id'];
					$m_id = 'potentialMoney';
				}
				else
				{
					$notes = '';
					$m_id = $parent_membership_id[0]['membership_id'];
				}
				//inserting values in money transfer log table
				$result = $this->manage_data->
				insertDebitAmount($m_id,$product_id,$quantity,$date,$amount_debited,$new_system_balence,$frozen_money,$notes);
				
				return array($result,($rest_amount - $amount_debited),$parent_membership_id[0]['membership_id']);
			}
			else
			{
				//echo $rest_amount;
				return array(0,$rest_amount,'null');
				
			}
			
		}
		
		/*
		 method for inserting resting amount to particuler account of admin
		 Auth: Dipanjan
		*/
		function fundAdmin($product_id,$quantity,$amount_debited){
			$member_id = "admin007";
			//get insertion date
			$date = $this->getDate();
			//getting the system balence
			$system_balence = $this->manage_data->
			getLastValue("money_transfer_log","system_balence","id");
			//new system balence
			$new_system_balence = ($system_balence[0]['system_balence'] - $amount_debited);
			//inserting values in money transfer log table
			$result = $this->manage_data->insertDebitAmount($member_id,$product_id,$quantity,$date,$amount_debited,$new_system_balence,0,"");
			return $result;
			
		}
		
		/*
			recursive method for parent member amount distribution
			Auth: Dipanjan
		*/
		
		function recursiveForMemberProduct($membership_id,$product_id,$quantity,$distributed_amount,$rest_amount,$level){
			//value insertion to money transfer log table
			$result = $this->amountForParent($membership_id,$product_id,$quantity,$distributed_amount,$rest_amount,$level);
			//checking for money distribution of parent id
			if($result[0] == 1)
			{
				if($level < 10)
				{
					$level++;
					$this->recursiveForMemberProduct($result[2],$product_id,$quantity,$distributed_amount,$result[1],$level);
				}
				else
				{
					return $result;
					break;
				}
					
			}
			else
			{
				$this->fundAdmin($product_id,$quantity,$result[1]);
				return $result;
				break;
			}
			return $result;
		}
		
		/*
			recursive method for parent member amount distribution
			Auth: Dipanjan
		*/
		
		function recursiveForMembershipProduct($membership_id,$product_id,$quantity,$distributed_amount,$rest_amount,$level){
			//value insertion to money transfer log table
			$result = $this->amountForParent($membership_id,$product_id,$quantity,$distributed_amount,$rest_amount,$level);
			//checking for money distribution of parent id
			if($result[0] == 1)
			{
				if($level < 15)
				{
					$level++;
					$this->recursiveForMembershipProduct($result[2],$product_id,$quantity,$distributed_amount,$result[1],$level);
				}
				else
				{
					return $result;
					break;
				}
					
			}
			else
			{
				$this->fundAdmin($product_id,$quantity,$result[1]);
				return $result;
				break;
			}
			return $result;
		}
		
		/*
			recursive method for money distribution for member product
			Auth: Dipanjan
		*/
		function moneyCalculationForMemberProduct($membership_id,$product_id,$quantity){
			//getting amount which will be distributed among members
			$distributed_amount = $this->distributedAmount($product_id,$quantity);
			//money received by member
			$result_member = $this->receivingAmount($distributed_amount,$product_id,$quantity,$membership_id);
			//money distribution for parent
			if($result_member[0] == 1)
			{
				//setting the level of parent element
				$level = 2;
				//calling recursive function
				$result = $this->recursiveForMemberProduct($result_member[2],$product_id,$quantity,$distributed_amount,$result_member[1],$level);
			}
		}
		
		/*
			recursive method for money distribution for coupon
			Auth: Dipanjan
		*/
		function moneyCalculationForCoupon($membership_id,$coupon_id){
			//getting amount which will be distributed among members
			$distributed_amount = $this->distributedAmountForCoupon($coupon_id);
			//money received by member
			$result_member = $this->receivingAmount($distributed_amount,$coupon_id,1,$membership_id);
			//money distribution for parent
			if($result_member[0] == 1)
			{
				//setting the level of parent element
				$level = 2;
				//calling recursive function
				$result = $this->recursiveForMemberProduct($result_member[2],$coupon_id,1,$distributed_amount,$result_member[1],$level);
			}
		}
		
		/*
			recursive method for money distribution for membership product
			Auth: Dipanjan
		*/
		function moneyCalculationForMembershipProduct($membership_id,$product_id){
			$quantity = 1;
			//getting amount which will be distributed among members
			$distributed_amount = $this->distributedAmountForMembership($product_id);
			//money distribution for parent
			if(!empty($distributed_amount))
			{
				//setting the level of parent element
				$level = 1;
				//calling recursive function
				$result = $this->recursiveForMembershipProduct($membership_id,$product_id,$quantity,$distributed_amount,$distributed_amount,$level);
			}
		}
		
		
		/* method for distribute money among parents for paypal transfer
		 	Auth Dipanjan
		 */
         function distributeMoneyPaypal($memberid){
			//taking all the cookie value to an array 
            $arr = $GLOBALS['_COOKIE'];
			//getting date of insertion
			$date = $this->getDate();
            //loop for extracting the cookies value
            foreach($arr as $key=>$value)
            {
                //checking the key name for identifying the cookies
                if(substr($key,0,10) == 'no_product')
                {
                    //separating the product id from cookies name
                    $product_id = substr($key,10);
					//checking for membership product
                    if(substr($product_id,0,1) == 'M')
                    {
                        //calling function for distribute money
						$result = $this->moneyCalculationForMembershipProduct($memberid,$product_id);					
                    }
                    else
                    {
                        //calling function for distribute money
						$result = $this->moneyCalculationForMemberProduct($memberid,$product_id,$value);
                    }
                }
				//checking for values of cookies in array
				else if($value == 'mojolife')
				{
					//separating the coupon id from cookies name
					$coupon_id = substr($key,0,11);
					//calling function for distribute money
					$result = $this->moneyCalculationForCoupon($memberid,$coupon_id);
				}
            }
			return $result;
         }
		 
		 /* method for distribute money among parents for account transfer
		 	Auth Dipanjan
		 */
		 function distributeMoneyAccount($order_id){
			 //getting purchase info from dtabase
			 $purchase_details = $this->manage_data->getValue_where("purchase_info","*","order_id",$order_id);
			 //getting date of insertion
			 $date = $this->getDate();
			 //executing every value in order
			 foreach($purchase_details as $purchase){
				 //getting membership id
				 $member = $this->manage_data->getValue_where("purchase_log","membership_id","order_id",$order_id);
				 //getting last system balence
				 $system_balence = $this->manage_data->getLastValue("money_transfer_log","system_balence","id");
				 //checking for guest or member
				 if($member[0]['membership_id'] == 'guest')
				 {
					 $price = 'price_guest';
				 }
				 else
				 {
					 $price = 'price_members';
				 }
				//checking for membership product
				if(substr($purchase['product_id'],0,1) == 'M')
				{
					//getting product price
					$product_price = $this->manage_data->getValue_where("membership_product","*","product_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$product_price[0]['price'];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					//getting member details from member table
					$member_details = $this->manage_data->getValue_where("member_table","*","membership_id",$member[0]['membership_id']);
					$previous_member_active = $member_details[0]['membership_activation'];
					//setting expiration date after 1 year
					$expiration_date = date('Y-m-d', strtotime('+1 years'));
					//updating the membership_activation column of member table
					$membership_activation = $this->manage_data->updateValueWhere("member_table","membership_activation",1,"membership_id",$member[0]['membership_id']);
					//update expiration date
					$update_expiry = $this->manage_data->updateValueWhere("member_table","expiration_date",$expiration_date,"membership_id",$member[0]['membership_id']);
					if($result == 1 && $member[0]['membership_id'] != 'guest')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForMembershipProduct($member[0]['membership_id'],$purchase['product_id']);
					}
										
				}
				//checking for member product
				else if(substr($purchase['product_id'],0,1) == 'P')
				{
					//getting product price
					$product_price = $this->manage_data->getValue_where("product_table","*","product_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$product_price[0][$price];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					if($result == 1 && $member[0]['membership_id'] != 'guest')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForMemberProduct($member[0]['membership_id'],$purchase['product_id'],$purchase['quantity']);
					}
				}
				//checking for coupon in table
				else if(substr($purchase['product_id'],0,1) == 'C')
				{
					//getting coupon price
					$coupon = $this->manage_data->getValue_where("coupon_table","*","coupon_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$coupon[0][$price];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					if($result == 1 && $member[0]['membership_id'] != 'guest')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForCoupon($member[0]['membership_id'],$purchase['product_id']);
					}
				} 
			 }
			 //approve the payment confirmation
			 $update = $this->manage_data->updateValueWhere("purchase_info","payment_status",1,"order_id",$order_id);
			 $payment_status = $this->manage_data->updateValueWhere("purchase_info","payment_request","Confirm","order_id",$order_id);
		 }
		 
		 /* method for distribute money among parents for my account transfer
		 	Auth Dipanjan
		 */
		 function distributeMoneyByMyAccount($order_id){
			 //getting purchase info from dtabase
			 $purchase_details = $this->manage_data->getValue_where("purchase_info","*","order_id",$order_id);
			 //getting date of insertion
			 $date = $this->getDate();
			 //executing every value in order
			 foreach($purchase_details as $purchase){
				 //getting membership id
				 $member = $this->manage_data->getValue_where("purchase_log","membership_id","order_id",$order_id);
				 //getting last system balence
				 $system_balence = $this->manage_data->getLastValue("money_transfer_log","system_balence","id");
				 //checking for guest or member
				 if($member[0]['membership_id'] == 'guest')
				 {
					 $price = 'price_guest';
				 }
				 else
				 {
					 $price = 'price_members';
				 }
				//checking for membership product
				if(substr($purchase['product_id'],0,1) == 'M')
				{
					//getting product price
					$product_price = $this->manage_data->getValue_where("membership_product","*","product_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$product_price[0]['price'];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					//setting expiration date after 1 year
					$expiration_date = date('Y-m-d', strtotime('+1 years'));
					//updating the membership_activation column of member table
					$membership_activation = $this->manage_data->updateValueWhere("member_table","membership_activation",1,"membership_id",$member[0]['membership_id']);
					//update expiration date
					$update_expiry = $this->manage_data->updateValueWhere("member_table","expiration_date",$expiration_date,"membership_id",$member[0]['membership_id']);
					if($result == 1 && $member[0]['membership_id'] != 'guest')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForMembershipProduct($member[0]['membership_id'],$purchase['product_id']);
					}
										
				}
				//checking for member product
				else if(substr($purchase['product_id'],0,1) == 'P')
				{
					//getting product price
					$product_price = $this->manage_data->getValue_where("product_table","*","product_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$product_price[0][$price];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					if($result == 1 && $member[0]['membership_id'] != 'guest')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForMemberProduct($member[0]['membership_id'],$purchase['product_id'],$purchase['quantity']);
					}
				}
				//checking for coupon in table
				else if(substr($purchase['product_id'],0,1) == 'C')
				{
					//getting coupon price
					$coupon = $this->manage_data->getValue_where("coupon_table","*","coupon_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$coupon[0][$price];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					if($result == 1 && $member[0]['membership_id'] != 'guest')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForCoupon($member[0]['membership_id'],$purchase['product_id']);
					}
				} 
			 }
			 //approve the payment confirmation
			 $update = $this->manage_data->updateValueWhere("purchase_info","payment_status",1,"order_id",$order_id);
			 $payment_status = $this->manage_data->updateValueWhere("purchase_info","payment_request","Confirm","order_id",$order_id);
			 $withdrawal_status = $this->manage_data->updateValueWhere("withdraw_log","status",1,"withdraw_order_id",$order_id);
		 }
		 
		 /* method for distribute money among parents for paypal transfer
		 	Auth Dipanjan
		 */
		 function distributeMoneyByPaypalPayment($order_id){
			 //getting purchase info from dtabase
			 $purchase_details = $this->manage_data->getValue_where("purchase_info","*","order_id",$order_id);
			 //getting date of insertion
			 $date = $this->getDate();
			 //executing every value in order
			 foreach($purchase_details as $purchase){
				 //getting membership id
				 $member = $this->manage_data->getValue_where("purchase_log","membership_id","order_id",$order_id);
				 //getting last system balence
				 $system_balence = $this->manage_data->getLastValue("money_transfer_log","system_balence","id");
				 //checking for guest or member
				 if($member[0]['membership_id'] == 'guest')
				 {
					 $price = 'price_guest';
				 }
				 else
				 {
					 $price = 'price_members';
				 }
				//checking for membership product
				if(substr($purchase['product_id'],0,1) == 'M')
				{
					//getting product price
					$product_price = $this->manage_data->getValue_where("membership_product","*","product_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$product_price[0]['price'];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					//getting member details from member table
					$member_details = $this->manage_data->getValue_where("member_table","*","membership_id",$member[0]['membership_id']);
					$previous_member_active = $member_details[0]['membership_activation'];
					//setting expiration date after 1 year
					$expiration_date = date('Y-m-d', strtotime('+1 years'));
					//updating the membership_activation column of member table
					$membership_activation = $this->manage_data->updateValueWhere("member_table","membership_activation",1,"membership_id",$member[0]['membership_id']);
					//update expiration date
					$update_expiry = $this->manage_data->updateValueWhere("member_table","expiration_date",$expiration_date,"membership_id",$member[0]['membership_id']);
					if($result == 1 && substr($member[0]['membership_id'],0,6) == 'member')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForMembershipProduct($member[0]['membership_id'],$purchase['product_id']);
					}				
				}
				//checking for member product
				else if(substr($purchase['product_id'],0,1) == 'P')
				{
					//getting product price
					$product_price = $this->manage_data->getValue_where("product_table","*","product_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$product_price[0][$price];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					if($result == 1 && substr($member[0]['membership_id'],0,6) == 'member')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForMemberProduct($member[0]['membership_id'],$purchase['product_id'],$purchase['quantity']);
					}
				}
				//checking for coupon in table
				else if(substr($purchase['product_id'],0,1) == 'C')
				{
					//getting coupon price
					$coupon = $this->manage_data->getValue_where("coupon_table","*","coupon_id",$purchase['product_id']);
					//amount credited
					$amount = $purchase['quantity']*$coupon[0][$price];
					//new system balence
					$new_balance = $system_balence[0]['system_balence'] + $amount;
					//inserted credit amount
					$result = $this->manage_data->insertCreditAmount($member[0]['membership_id'],
					$purchase['product_id'],$purchase['quantity'],$date,$amount,$new_balance,0,"");
					if($result == 1 && substr($member[0]['membership_id'],0,6) == 'member')
					{
						//calling function for distribute money
						$result = $this->moneyCalculationForCoupon($member[0]['membership_id'],$purchase['product_id']);
					}
				} 
			 }
			 //approve the payment confirmation
			 $update = $this->manage_data->updateValueWhere("purchase_info","payment_status",1,"order_id",$order_id);
			 $payment_status = $this->manage_data->updateValueWhere("purchase_info","payment_request","Confirm","order_id",$order_id);
		 }
		 
		 /*method which inserts users final value at the time of payment through paypal
		 	Auth Dipanjan
		 */
         function insertPaypalPayment($orderId,$totalPrice,$memberid){
            //initialize variable
			$product_string = "";
			//taking all the cookie value to an array 
            $arr = $GLOBALS['_COOKIE'];
			//getting payment method from purchase log table
			$payment_method = $this->manage_data->
			getValue_where("purchase_log","*","order_id",$orderId);
			//getting date of insertion
			$date = $this->getDate();
            //loop for extracting the cookies value
            foreach($arr as $key=>$value)
            {
                //checking the key name for identifying the cookies
                if(substr($key,0,10) == 'no_product')
                {
                    //separating the product id from cookies name
                    $product_id = substr($key,10);
					//setting payment request
					$payment_request = 'Progressing';
					//setting payment status
					$payment_status = 0;
					//setting all products variable
					$product_string = $product_string.",".$product_id;
					//inserting values in payment status
					$result = $this->manage_data->insertPurchaseInfoPaypal($orderId,$product_id,$value,$date,$payment_method[0]['payment_method'],$payment_request,$payment_status);
                }
				//checking for coupon in the cookie value
				else if($value == 'mojolife')
				{
					//separating the coupon id from cookies name
					$coupon_id = substr($key,0,11);
					//setting payment request
					$payment_request = 'Progressing';
					//setting payment status
					$payment_status = 0;
					//setting all products variable
					$product_string = $product_string.",".$coupon_id;
					//inserting values in payment status
					$result = $this->manage_data->insertPurchaseInfoPaypal($orderId,$coupon_id,1,$date,$payment_method[0]['payment_method'],$payment_request,$payment_status);
				}
            }
			/*
			- remove the first word from the $category_string sa it
			- it contains a comma
			*/
			$product_string = substr($product_string,1);
			//insert values in purchase log
			$insertPaymentConf = $this->manage_data->insertPayment($orderId,$totalPrice,$memberid,$product_string);
			if(substr($memberid,0,6) == 'member')
			{
				$member = $this->manage_data->getValue_where("member_table","*","membership_id",$memberid);
				$email_id = $member[0]['email_id'];
			}
			else
			{
				$email_id = $payment_method[0]['email_id'];
			}
			return $email_id;
         }
		 
		 /*method for inserting values in money transfer log
		 	Auth Dipanjan
		 */
         function insertCreditAmounts($memberid){
			if($memberid == 'guest')
			{
				$price = 'price_guest';
			}
			else
			{
				$price = 'price_members';
			}
			//taking all the cookie value to an array 
            $arr = $GLOBALS['_COOKIE'];
			//getting date of insertion
			$date = $this->getDate();
            //loop for extracting the cookies value
            foreach($arr as $key=>$value)
            {
                //checking the key name for identifying the cookies
                if(substr($key,0,10) == 'no_product')
                {
                    //separating the product id from cookies name
                    $product_id = substr($key,10);
					//getting system balance from money transfer log
					$system_balance = $this->manage_data->getLastValue("money_transfer_log","system_balence","id");
					//checking for membership product
                    if(substr($product_id,0,1) == 'M')
                    {
                        //fetching the values from database according to product id
                        $product = $this->manage_data->getValue_where("membership_product","*","product_id",$product_id);
						//setting amount credited
						$amount = $value*$product[0]['price'];
						//new system balance
						$new_system_balence = $system_balance[0]['system_balence'] + $amount;	
						//insert values in money transfer log
						$result = $this->manage_data->insertCreditAmount($memberid,$product_id,$value,$date,$amount,$new_system_balence,0,"");
						//updating the membership_activation column of member table
						$membership_activation = $this->manage_data->updateValueWhere("member_table","membership_activation",1,"membership_id",$memberid);					
                    }
                    else
                    {
                        //fetching the values from database according to product id
                        $product = $this->manage_data->getValue_where("product_table","*","product_id",$product_id);
						//setting amount credited
						$amount = $value*$product[0][$price];
						//new system balance
						$new_system_balence = $system_balance[0]['system_balence'] + $amount;
						//insert values in money transfer log
						$result = $this->manage_data->insertCreditAmount($memberid,$product_id,$value,$date,$amount,$new_system_balence,0,"");
                    }
                }
				//checking for coupon values of in cookies
				else if($value == 'mojolife')
				{
					//separating the coupon id from cookies name
					$coupon_id = substr($key,0,11);
					//getting system balance from money transfer log
					$system_balance = $this->manage_data->getLastValue("money_transfer_log","system_balence","id");
					//fetching the values from coupon table
					$coupon = $this->manage_data->getValue_where("coupon_table","*","coupon_id",$coupon_id);
					//setting amount credited
					$amount = 1*$coupon[0][$price];
					//new system balance
					$new_system_balence = $system_balance[0]['system_balence'] + $amount;
					//insert values in money transfer log
					$result = $this->manage_data->insertCreditAmount($memberid,$coupon_id,1,$date,$amount,$new_system_balence,0,"");
				}
            }
         }
		 
		 /*method for inserting values in money transfer log
		 	Auth Dipanjan
		 */
		 function getProductDetailsForPaypal($order_id){
			//getting current date
			$getdate = getdate();
			$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
			//change date format
			$change_date = explode("-",$date);
			$curdate = $change_date[2]."-".$change_date[1]."-".$change_date[0];
			$year = $getdate['year'];
			//getting invoice no
			$invoice = $this->manage_data->getLastValue("purchase_log","*","invoice_no");
			//separating year from invoice no and increase the value by 1
			$new_no = sprintf("%05s",substr($invoice[0]['invoice_no'],5)+1);
			$new_invoice_no = $year."-".$new_no;
			//update invoice no and date
			$updateinvoice = $this->manage_data->updateValueWhere("purchase_log","invoice_no",$new_invoice_no,"order_id",$order_id);
			$updatedate = $this->manage_data->updateValueWhere("purchase_log","invoice_date",$date,"order_id",$order_id);
			//getting member or guest email id
			$email = $this->manage_data->getValue_where("purchase_log","*","order_id",$order_id);
			if($email[0]['membership_id'] == 'guest')
			{
				$email_id = $email[0]['email_id'];
				$price = 'price_guest';
			}
			else
			{
				$member = $this->manage_data->getValue_where("member_table","*","membership_id",$email[0]['membership_id']);
				$email_id = $member[0]['email_id'];
				$price = 'price_members';
			}
			//getting the product and coupon id
			$all_products = $this->manage_data->getValue_where("purchase_info","*","order_id",$order_id);
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
					$product = $this->manage_data->getValue_where("membership_product","*","product_id",$val);
					$cate = $product[0]['product_name'];
					$tax = 0;
					$product_price = $product[0][$price];
					
				}
				else if(substr($val,0,1) == 'C')
				{
					$product = $this->manage_data->getValue_where("coupon_table","*","coupon_id",$val);
					$cate = $product[0]['coupon_name'];
					$tax = $product[0]['tax'];
					$product_price = $product[0][$price];
				}
				else
				{
					$product = $this->manage_data->getValue_where("product_table","*","product_id",$val);
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
			return array($email_id,$product_details,$total_amount_details,$new_invoice_no,$curdate);
		 }
		 
		 /*method for checking member validiation field
		 	Auth Dipanjan
		 */
		 function getInvalidConditionsOfMember($membership_id){
			 //getting member details
			$member = $this->manage_data->getValue_where("member_table","*","membership_id",$membership_id);
			return array($member[0]['membership_validiation'],$member[0]['membership_activation']);
		 }
		
	}
	
	
	
?>