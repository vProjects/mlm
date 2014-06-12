<?php
	//include class library of database connecton
	include 'class.database.php';
	class ManageContent_DAL
	{
		public $link;
		
		//construct function
		function __construct()
		{
			$db_Connection = new dbConnection();
			$this->link = $db_Connection->connect();
			return $this->link;
		}
		
		
		function getValue($table_name,$value)
		{
			$query = $this->link->query("SELECT $value from $table_name");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		function getValue_descending($table_name,$value)
		{
			$query = $this->link->query("SELECT $value from $table_name ORDER BY `id` DESC");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		function getValue_distinct($table_name,$value)
		{
			$query = $this->link->query("SELECT DISTINCT $value from $table_name");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		function getValue_where($table_name,$value,$row_value,$value_entered)
		{
			try{
				$query = $this->link->query("SELECT $value from $table_name where $row_value='$value_entered'");
				$query->execute();
				$rowcount = $query->rowCount();
				if($rowcount > 0){
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
					return $result;
				}
				else{
					return $rowcount;
				}
			}
			catch(Exception $e)
			{
				throw "Result Not Found";
			}
		}
		
		function getValueWhere_descending($table_name,$value,$row_value,$value_entered)
		{
			$query = $this->link->query("SELECT $value from $table_name where $row_value='$value_entered' ORDER BY `id` DESC");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		function getValue_twoCoditions($table_name,$value,$row_value1,$value_entered1,$row_value2,$value_entered2)
		{
			try{
				$query = $this->link->query("SELECT $value from $table_name where $row_value1='$value_entered1' AND $row_value2='$value_entered2'");
				$query->execute();
				$rowcount = $query->rowCount();
				if($rowcount > 0){
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
					return $result;
				}
				else{
					return $rowcount;
				}
			}
			catch(Exception $e)
			{
				throw "Result Not Found";
			}
		}
		
		function getValue_twoCoditions_descending($table_name,$value,$row_value1,$value_entered1,$row_value2,$value_entered2)
		{
			try{
				$query = $this->link->query("SELECT $value from $table_name where $row_value1='$value_entered1' AND $row_value2='$value_entered2' ORDER BY `id` DESC");
				$query->execute();
				$rowcount = $query->rowCount();
				if($rowcount > 0){
					$result = $query->fetchAll(PDO::FETCH_ASSOC);
					return $result;
				}
				else{
					return $rowcount;
				}
			}
			catch(Exception $e)
			{
				throw "Result Not Found";
			}
		}
		
		//get all the latest aricles 
		function getValue_latest($table_name,$value)
		{
			$query = $this->link->query("SELECT $value from $table_name pet ORDER BY `article_date` DESC");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		//get latest article according to the author
		function getValue_latest_where($table_name,$value,$row_value,$value_entered)
		{
			$query = $this->link->query("SELECT $value from $table_name where $row_value='$value_entered' ORDER BY `article_date` DESC");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		//function for inserting member's details
		function insertMember($name,$email_id,$dob,$gender,$contact_no,$address,$city,$postal_code,$state,$country,
		$username,$password,$membership_id,$date,$expiration_date)
		{
			$query = $this->link->prepare("INSERT INTO `member_table`(`name`, `email_id`, `dob`, `gender`, `contact_no`,`address`, `city`, `postal_code`, `state`, `country`, `username`, `password`, `membership_id`, `date`, `expiration_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$values = array($name,$email_id,$dob,$gender,$contact_no,$address,$city,$postal_code,$state,$country,$username,$password,$membership_id,$date,$expiration_date);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*method for inserting member in mlm_info
		//Auth Dipanjan  
		*/
		function insertMembershipId($membership_id,$date){
			$query = $this->link->prepare("INSERT INTO `mlm_info`(`membership_id`, `date`) VALUES (?,?)");
			$values = array($membership_id,$date);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*method for inserting withdrawal amount
		//Auth Dipanjan  
		*/
		function insertWithdrawalAmount($membership_id,$withdraw_amount,$frozen_money,$withdraw_id,$date,$status){
			$query = $this->link->prepare("INSERT INTO `withdraw_log`(`membership_id`, `withdraw_amount`, `frozen_money`, `withdraw_order_id`, `date`, `status`) VALUES (?,?,?,?,?,?)");
			$values = array($membership_id,$withdraw_amount,$frozen_money,$withdraw_id,$date,$status);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*method for inserting information in money transfer log
		//Auth Dipanjan  
		*/
		function insertDebitAmount($membership_id,$product_id,$quantity,$date,$amount,$system_balence,$frozen_money,$notes){
			$query = $this->link->prepare("INSERT INTO `money_transfer_log`
			(`membership_id`, `product_id`, `product_quantity`, `date`, `debit`, `system_balence`, `frozen_money`, `notes`) VALUES (?,?,?,?,?,?,?,?)");
			$values = array($membership_id,$product_id,$quantity,$date,$amount,$system_balence,$frozen_money,$notes);
			$query->execute($values);
			return $query->rowCount();
		}
		/*method for inserting information in money transfer log
		//Auth Dipanjan  
		*/
		function insertCreditAmount($membership_id,$product_id,$quantity,$date,$amount,$system_balence,$frozen_money,$notes){
			$query = $this->link->prepare("INSERT INTO `money_transfer_log`
			(`membership_id`, `product_id`, `product_quantity`, `date`, `credit`, `system_balence`, `frozen_money`, `notes`) VALUES (?,?,?,?,?,?,?,?)");
			$values = array($membership_id,$product_id,$quantity,$date,$amount,$system_balence,$frozen_money,$notes);
			$query->execute($values);
			return $query->rowCount();
		}
		/*method for inserting information in purchase info table
		//Auth Dipanjan  
		*/
		function insertPurchaseInfo($order_id,$product_id,$quantity,$date,$payment_method,$payment_status){
			$query = $this->link->prepare("INSERT INTO `purchase_info`(`order_id`, `product_id`, `quantity`, `date`, `payment_method`, `payment_status`) VALUES (?,?,?,?,?,?)");
			$values = array($order_id,$product_id,$quantity,$date,$payment_method,$payment_status);
			$query->execute($values);
			return $query->rowCount();
		}
		/*method for inserting information in purchase info table
		//Auth Dipanjan  
		*/
		function insertPurchaseInfoPaypal($order_id,$product_id,$quantity,$date,$payment_method,$payment_request,$payment_status){
			$query = $this->link->prepare("INSERT INTO `purchase_info`(`order_id`, `product_id`, `quantity`, `date`, `payment_method`, `payment_request`, `payment_status`) VALUES (?,?,?,?,?,?,?)");
			$values = array($order_id,$product_id,$quantity,$date,$payment_method,$payment_request,$payment_status);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*method for inserting account information of member
		//Auth Dipanjan  
		*/
		function insertAcDetails($membership_id,$ac_name,$ac_no,$bank,$branch,$ifsc,$status){
			$query = $this->link->prepare("INSERT INTO `member_account_details`(`membership_id`, `ac_name`, `ac_no`, `bank`, `branch`, `ifsc_code`, `status`) VALUES (?,?,?,?,?,?,?)");
			$values = array($membership_id,$ac_name,$ac_no,$bank,$branch,$ifsc,$status);
			$query->execute($values);
			return $query->rowCount();
		}
		
		//getting last value of a column
		function getLastValue($table_name,$column_name,$sorting_column){
			$query = $this->link->query("SELECT $column_name FROM $table_name ORDER BY $sorting_column DESC LIMIT 1");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		//function for search functionality
		function getvalue_search($table_name,$value,$row_value,$value_entered)
		{
			//$value_entered = htmlentities($value_entered);
			$query = $this->link->query("SELECT $value from $table_name WHERE (( $row_value LIKE '%".$value_entered."%') OR (`company_city` LIKE '%".$value_entered."%') OR (`company_name` LIKE '%".$value_entered."%')) AND (`status` = '1') AND (`end_date` >= CURDATE()) ORDER BY RAND()");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		//get ads according to email(username)
		function getValue_email($table_name,$value,$row_value,$value_entered)
		{
			//$value_entered = htmlentities($value_entered);
			$query = $this->link->query("SELECT $value from $table_name WHERE $row_value LIKE '".$value_entered."'");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		//get submenus according to the position
		function getSubmenu_ordered($table_name,$value,$order)
		{
			$query = $this->link->query("SELECT $value from $table_name HAVING $order > 0  ORDER BY $order ASC");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		//get vertical nav sorted by parent_id and position
		function getMenu_sorted($table_name,$value,$order,$value_parent)
		{
			$query = $this->link->query("SELECT $value from $table_name HAVING $order = $value_parent ORDER BY $order,`parent_id`,`position` ASC");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		// function to store user tracking results


		function insertTrackingValues($companyName,$browserName,$OS,$browserVersion,$date,$ip,$time){
			
			$query = $this->link->prepare("INSERT INTO `tracking`(`browserversion`, `os`, `browsername`, `ip`, `category`, `date`, `time`) VALUES (?,?,?,?,?,?,?)");
			$values = array($browserVersion,$OS,$browserName,$ip,$companyName,$date,$time);
			
			$query->execute($values);
		}
		//function for update of values
		function updateValue_email_owner($table_name,$column_name,$column_value,$email)
		{
			$query = $this->link->prepare("UPDATE `$table_name` SET `$column_name` = '$column_value' WHERE `owner_email` = '$email'");
			$query->execute();
			$count = $query->rowCount();
			return $count;
		}
		//function for update of values
		function updateValue_email_company($table_name,$column_name,$column_value,$email)
		{
			$query = $this->link->prepare("UPDATE `$table_name` SET `$column_name` = '$column_value' WHERE `company_name` = '$email'");
			$query->execute();
			$count = $query->rowCount();
			return $count;
		}
		
		/*
		- method for updating the values using where clause
		- auth: Dipanjan
		*/
		function updateValueWhere($table_name,$update_column,$update_value,$column_name,$column_value)
		{
			$query = $this->link->prepare("UPDATE `$table_name` SET `$update_column`= '$update_value' WHERE `$column_name` = '$column_value'");
			$query->execute();
			$count = $query->rowCount();
			return $count;
		}
		
		/*
		- function to get the likely values of keyword
		- auth: Dipanjan
		*/
		function getValue_likely($table_name,$value,$column_name,$keyword)
		{
			$query = $this->link->prepare("SELECT $value from $table_name WHERE $column_name LIKE '%$keyword%'");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		/*
		- function to get the likely values of keyword with descending
		- auth: Dipanjan
		*/
		function getValue_likely_descending($table_name,$value,$column_name,$keyword)
		{
			$query = $this->link->prepare("SELECT $value from $table_name WHERE $column_name LIKE '%$keyword%' ORDER BY `id` DESC");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		/*
		- function to get the likely values of keyword
		- auth: Dipanjan
		*/
		function getValue_latestDate($table_name,$value,$no)
		{
			$query = $this->link->prepare("SELECT $value from $table_name ORDER BY `date` DESC LIMIT $no");
			$query->execute();
			$rowcount = $query->rowCount();
			if($rowcount > 0){
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				return $result;
			}
			else{
				return $rowcount;
			}
		}
		
		/*method for inserting values to given table
		//Auth Dipanjan  
		*/
		function insertValue($table_name,$column_name,$column_values){
			//declaring variables for preparing the query
			$column = "";
			$value = "";
			for($i=0;$i<count($column_name);$i++)
			{
				$column = $column."`".$column_name[$i]."`, ";
				$value = $value."?,"; 
			}
			//modifying the string for column name and values
			$column = substr($column,0,-2);
			$value = substr($value,0,-1);
			$query = $this->link->prepare("INSERT INTO `$table_name`($column) VALUES ($value)");
			$query->execute($column_values);
			return $query->rowCount();
		}
		
		
		
		 /* ====== codes written by vasu ================== */
        
        /* insert the new address provided by the users at the time
         * of checkout
        */
        function insertAddress($userShippingAddress,$dataType,$deliveryStatus,$ipaddress,$orderid){

            if($dataType == 'olddata'){
                $wholeAddress = $userShippingAddress;
            }
            else if($dataType == 'newdata'){
                $wholeAddress = $userShippingAddress['f_name'].' '.$userShippingAddress['l_name'].
                                ', <br>'.$userShippingAddress['company_name'].','.$userShippingAddress['company_id'].
                                ', <br>'. $userShippingAddress['address_1'].'<br>'.$userShippingAddress['address_2'].
                                ','.$userShippingAddress['city'].'<br> pin:'.$userShippingAddress['p_code'].
                                ', <br>'. $userShippingAddress['state'].','.$userShippingAddress['country'];
								
				// this line takes the users or guest email if they are entering the new shipping address 								
				$email_id = $userShippingAddress['email_id'];
                 }                 
           $date = date('Y-m-d');
		   if(!isset($email_id))
		   {
			   $email_id = "";
		   }
           //checks whether orderId session variable exists or not
           $query = $this->link->prepare("select * from `purchase_log` where order_id = '$orderid'");
            $query->execute(); 
           if($query->rowcount()!=1){
                $query = $this->link->prepare("INSERT INTO `purchase_log`(`shipping_address`,`date`,`delivery_status`,`ip_address`,`email_id`,`order_id`) VALUES (?,?,?,?,?,?)"); 
                $values = array($wholeAddress,$date,$deliveryStatus,$ipaddress,$email_id,$orderid);
                $query->execute($values);  
				echo $orderid;
                return $query->rowcount();  
           }
           else {
               $query = $this->link->prepare("UPDATE `purchase_log` SET `ip_address`='$ipaddress',`date`='$date',`delivery_status`=$deliveryStatus,`email_id`='$email_id',`shipping_address`='$wholeAddress' WHERE order_id='$orderid'");
               $query->execute();
			   echo $orderid;
               return $query->rowcount();  
               
           }
           
         }

        function insertShipCon($orderId,$shipComment){
           $query = $this->link->prepare("UPDATE `purchase_log` SET `shipping_comments`='$shipComment' WHERE order_id = '$orderId'");
           $query->execute();
           return $query->rowcount();
        }
        
        function insertPaymentCon($orderId,$paymentMethod,$orderCom){
           $query = $this->link->prepare("UPDATE `purchase_log` SET `payment_method`='$paymentMethod',`order_comments`='$orderCom' WHERE order_id = '$orderId'");
           $query->execute();
		   echo $orderId;
           return $query->rowcount();
        }
        
        function insertPayment($orderId,$totalPrice,$memberid,$allProducts){
           $query = $this->link->prepare("UPDATE `purchase_log` SET `product_id`='$allProducts',`membership_id`='$memberid', `price`='$totalPrice' WHERE order_id = '$orderId'");
           $query->execute();
           return $query->rowcount();
                       
        }
        
        /*
         * to get the maxpick value of a particular product 
         */
         
        function getValueWhereIn($table_name,$value,$row_value,$valueList)
        {
            try{
                $query = $this->link->prepare("SELECT $value from $table_name where $row_value IN $valueList");
                
                $query->execute();
                $rowcount = $query->rowCount();
                if($rowcount > 0){
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }
                else{
                    return $rowcount;
                }
            }
            catch(Exception $e)
            {
                throw "Result Not Found";
            }
            
            
           
        }
        
        /*
         * Insert 1 for activated user
         *  Auth vasu naman
        */
        function activateUser($membership_id,$email){
            $query = $this->link->prepare("UPDATE `member_table` SET `membership_validiation`=1 WHERE membership_id = '$membership_id'");
            $query->execute();
            return $query->rowCount();
        }
        
        
        
        /* ====== codes written by vasu end here ========== */
	}
?>