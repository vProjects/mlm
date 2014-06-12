<?php
	//include the connection class
	include('class.database.php');
	
	class manageContent_DAL
	{
		private $link;
		
		//variable to store the date 
		private $presentDate;
		
		//construct function
		function __construct()
		{
			$db_Connection = new dbConnection();
			$this->link = $db_Connection->connect();
			return $this->link;
		}
		
		/*
		- function to get the value
		- auth: Dipanjan
		*/
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
		
		/*
		- function to get the value in descending order
		- auth: Dipanjan
		*/
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
		
		/*
		- function to get the sorted value
		- auth: Dipanjan
		*/
		function getValue_latest($table_name,$value,$sortBy)
		{
			$query = $this->link->query("SELECT $value from $table_name pet ORDER BY `$sortBy` DESC");
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
		- function to get the sorted value
		- auth: Dipanjan
		*/
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
		
		/*
		- method for inserting the product category
		- auth: Dipanjan
		*/
		function insertCategory($category,$date,$status)
		{
			$query = $this->link->prepare("INSERT INTO `product_category`(`category`, `date`, `status`) VALUES (?,?,?)");
			$values = array($category,$date,$status);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*
		- method for inserting the coupon category
		- auth: Dipanjan
		*/
		function insertCouponCategory($category,$date,$status)
		{
			$query = $this->link->prepare("INSERT INTO `coupon_category`(`category`, `date`, `status`) VALUES (?,?,?)");
			$values = array($category,$date,$status);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*
		- method for inserting footer links
		- auth: Dipanjan
		*/
		function insertFooterLinks($name,$link,$column_name,$status)
		{
			$query = $this->link->prepare("INSERT INTO `footer_content`(`name`, `link`, $column_name, `status`) VALUES (?,?,?,?)");
			$values = array($name,$link,1,$status);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*
		- method for inserting the product sub category
		- auth: Dipanjan
		*/
		function insertSubCategory($category,$sub_category,$date,$status)
		{
			$query = $this->link->prepare("INSERT INTO `product_sub_category`(`category`, `sub_category`, `date`, `status`) VALUES (?,?,?,?)");
			$values = array($category,$sub_category,$date,$status);
			$query->execute($values);
			return $query->rowCount();
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
		
		/*
		- method for getting the values using where clause
		- auth: Dipanjan
		*/
		function getValueWhere($table_name,$value,$row_value,$value_entered)
		{
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
		
		/*
		- method for getting the values using where clause
		- auth: Dipanjan
		*/
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
		
		/*
		- method for getting the values using where and between limits
		- auth: Dipanjan
		*/
		function getValueBetween($table_name,$value,$row_value,$value_first,$value_second)
		{
			$query = $this->link->query("SELECT $value from $table_name where $row_value BETWEEN '$value_first' AND '$value_second'");
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
		- method for getting the values using where and between limits in descending order
		- auth: Dipanjan
		*/
		function getValueBetweenDescending($table_name,$value,$row_value,$value_first,$value_second)
		{
			$query = $this->link->query("SELECT $value from $table_name where $row_value BETWEEN '$value_first' AND '$value_second' ORDER BY `id` DESC");
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
		- method for inserting the product
		- auth: Dipanjan
		*/
		function insertProduct($product_id,$category,$product_name,$description,$references,$old_price,$price_guest,$price_members,$tax,$discount,$stock,$date,$expiration_date,$maxpick,$status,$image,$image1,$image2,$image3,$image4)
		{
			$query = $this->link->prepare("INSERT INTO `product_table`(`product_id`, `category`, `product_name`, `product_description`, `references`, `old_price`, `price_guest`, `price_members`, `tax`, `discount`, `stock`, `date`, `expiration_date`, `maxpick`, `status`, `image`, `image1`, `image2`, `image3`, `image4`)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$values = array($product_id,$category,$product_name,$description,$references,$old_price,$price_guest,$price_members,$tax,$discount,$stock,$date,$expiration_date,$maxpick,$status,$image,$image1,$image2,$image3,$image4);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*
		- method for inserting the coupon
		- auth: Dipanjan
		*/
		function insertCoupon($coupon_id,$category,$coupon_name,$description,$references,$coupon_code,$old_price,$price_guest,$price_members,$tax,$discount,$stock,$date,$expiration_date,$maxpick,$status,$image,$image1,$image2,$image3,$image4)
		{
			$query = $this->link->prepare("INSERT INTO `coupon_table`(`coupon_id`, `category`, `coupon_name`, `coupon_description`, `references`, `coupon_code`, `old_price`, `price_guest`, `price_members`, `tax`, `discount`, `stock`, `date`, `expiration_date`, `maxpick`, `status`, `image`, `image1`, `image2`, `image3`, `image4`)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$values = array($coupon_id,$category,$coupon_name,$description,$references,$coupon_code,$old_price,$price_guest,$price_members,$tax,$discount,$stock,$date,$expiration_date,$maxpick,$status,$image,$image1,$image2,$image3,$image4);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*
		- method for inserting the membership product
		- auth: Dipanjan
		*/
		function insertMembershipProduct($product_id,$product_name,$description,$coupon_code,$price,$discount,$stock,$status,$image)
		{
			$query = $this->link->prepare("INSERT INTO `membership_product`(`product_id`, `product_name`, `product_description`, `price`, `discount`, `stock`, `status`, `image`)
VALUES (?,?,?,?,?,?,?,?)");
			$values = array($product_id,$product_name,$description,$price,$discount,$stock,$status,$image);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*
		- method to insert into gallery_info table
		- Auth: Dipanjan
		*/
		function insertGalleryInfo($galleryId,$path,$category,$model,$date,$view,$rating,$status)
		{
			$query = $this->link->prepare("INSERT INTO `gallery_info`(`gallery_id`, `path`, `category`, `model`, `date`,  `view`, `rating`,`status`) VALUES (?,?,?,?,?,?,?,?)");
			$values = array($galleryId,$path,$category,$model,$date,$view,$rating,$status);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*
		- method to insert into movie_info table
		- Auth: Dipanjan
		*/
		function insertMovieInfo($galleryId,$category,$model,$path,$vid_format_1,$vid_format_2,$vid_format_3,$duration,$date,$status)
		{
			$query = $this->link->prepare("INSERT INTO `movie_info`(`gallery_id`, `category`, `model`, `path`, `vid_format_1`, `vid_format_2`, `vid_format_3`, `duration`, `date`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?)");
			$values = array($galleryId,$category,$model,$path,$vid_format_1,$vid_format_2,$vid_format_3,$duration,$date,$status);
			$query->execute($values);
			return $query->rowCount();
		}
		
		/*
		- method to delete the values 
		- Auth: Dipanjan
		*/
		function deleteValue($table_name,$column_name,$column_value)
		{
			if(is_string($column_value))
			{
				$queryString = "DELETE FROM $table_name WHERE $column_name = '$column_value'";
			}
			else
			{
				$queryString = "DELETE FROM $table_name WHERE $column_name = $column_value";
			}
			$query = $this->link->prepare($queryString);
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
		- function to get the values from two tables using FULL JOIN
		- auth: Dipanjan
		*/
		function getValue_fullJoin($table_name1,$table_name2,$value,$column_name,$column_value)
		{
			$query = $this->link->prepare("SELECT $value FROM $table_name1 FULL OUTER JOIN $table_name2 ON $column_name=$column_value");
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
		- function to get the last value of a column
		- auth: Dipanjan
		*/
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
        
        /* ----------- Method written by Vasu Naman starts here */
        
        /*
         * method to insert the value of user generated page and by defauld it
         * makes it activated
         * Auth: Vasu Naman
         */
		
		function insertPage($pageName,$pageContent,$status){
		    $query = $this->link->prepare("INSERT INTO `mypage`( `name`, `content`, `status`) VALUES ('$pageName','$pageContent',$status)");
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
		
		
		
	}

?>