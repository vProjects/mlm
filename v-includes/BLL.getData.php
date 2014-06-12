<?php
	//include the DAL library to use the model layer methods
	include 'class.DAL.php';
	
	// business layer class starts here
	class BLL_manageData
	{
		public $manage_content;
		
		/*
		 method for constructing DAL class
		 Auth: Dipanjan
		*/

		function __construct()
		{	
			$this->manage_content = new ManageContent_DAL();
			//checking for all member expiry date
			$allMembers = $this->manage_content->getValue_where("member_table","*","membership_activation",1);
			if(!empty($allMembers[0]))
			{
				foreach($allMembers as $allMember)
				{
					//checking for expiry date
					$expiry = $this->checkingDate($allMember['expiration_date']);
					if($expiry == 0)
					{
						//update member activation field to 0
						$terminate_member = $this->manage_content->updateValueWhere("member_table","membership_activation",0,"membership_id",$allMember['membership_id']);
					}
				}
			}
			return $this->manage_content;
		}
		
		/*
			method for getting product list
			Auth: Dipanjan
		*/
		
		function getProducts($category){
			//get value from database
			$products = $this->manage_content->getValue_likely_descending("product_table","*","category",$category);
			//variable for maintaining row-fluid
			$row_element = 0;
			$span_element = 1;
			//checking for products for given category
			if(!empty($products[0]['product_id']))
			{
				// fetching all values one by one
				foreach($products as $product){
					//checking for date expiry
					$expire_date = $this->checkingDate($product['expiration_date']);
					//checking product availablity
					if($product['status'] == 1 && $expire_date == 1){
						//maintain no of elements in a row
						if($row_element%4 == 0){
							echo '<div class="row-fluid">
									<ul class="thumbnails">';
						}
						//create UI element
						echo '<li class="span3 thumbnail right_container_object">
								<a href="product.php?product='.$product['product_id'].'"><img src="'.$product['image'].'" id="product_image" />
								<p id="product_name">'.$product['product_name'].'</p>
								<p> Redna cena: <span class="old_price" id="price_guest">  €'.$product['old_price'].' </span></p>
								<p> Akcijska cena:  €'.$product['price_guest'].' </p>
								<p> MojLife cena:  €'.$product['price_members'].' </p></a>
								
								<button class="btn btn-primary" value="'.$product['product_name'].'" name="'.$product['product_id'].'" onclick = "setProductCookie(this.value,this.name,'.$product['maxpick'].');">Dodaj v voziček</button>
							 </li>';
							 
							 
						if($span_element%4 == 0){	
							echo '</ul>
								</div>';		
						}
						$row_element++;
						$span_element++;
					}
					
				}
				//closing the ul and div
				if($row_element%4 != 0)
				{
					echo '</ul>
						</div>';
				}
			}
			else
			{
				echo '<h2>NO PRODUCTS FOUND FOR THIS CATEGORY</h2>';
			}
		}
		
		/*
			method for getting coupon list
			Auth: Dipanjan
		*/
		
		function getCoupons($category){
			if($category == 'Latest')
			{
				//get value from database
				$coupons = $this->manage_content->getValue_latestDate("coupon_table","*",8);
			}
			else
			{
				//get value from database
				$coupons = $this->manage_content->getValue_likely_descending("coupon_table","*","category",$category);
			}
			
			//variable for maintaining row-fluid
			$row_element = 0;
			$span_element = 1;
			//checking for products for given category
			if(!empty($coupons[0]['coupon_id']))
			{
				// fetching all values one by one
				foreach($coupons as $coupon){
					//checking for date expiry
					$expire_date = $this->checkingDate($coupon['expiration_date']);
					//checking product availablity
					if($coupon['status'] == 1 && $expire_date == 1){
						//maintain no of elements in a row
						if($row_element%4 == 0){
							echo '<div class="row-fluid">
									<ul class="thumbnails">';
						}
						//create UI element
						echo '<li class="span3 thumbnail right_container_object">
								<a href="coupon.php?coupon='.$coupon['coupon_id'].'"><img src="'.$coupon['image'].'" id="product_image" />
								<p id="product_name">'.$coupon['coupon_name'].'</p>
								<p> Redna cena: <span class="old_price" id="price_guest">  €'.$coupon['old_price'].' </span></p>
								<p> Akcijska cena:  €'.$coupon['price_guest'].' </p>
								<p> MojLife cena:  €'.$coupon['price_members'].' </p></a>
								
								<button class="btn btn-primary" value="'.$coupon['coupon_name'].'" name="'.$coupon['coupon_id'].'" onclick = "setCouponCookie(this.value,this.name,'.$coupon['maxpick'].');">Dodaj v voziček</button>
							 </li>';
					
						if($span_element%4 == 0){	
							echo '</ul>
								</div>';		
						}
						$row_element++;
						$span_element++;
					}
				}
				
				//closing the ul and div
				if($row_element%4 != 0)
				{
					echo '</ul>
						</div>';
				}
			}
			else
			{
				echo '<h2>NO COUPONS FOUND FOR THIS CATEGORY</h2>';
			}
		}
		
		/*
			method for getting product details of given product_id
			Auth: Dipanjan
		*/
		
		function getProductDetails($product_id){
			if(isset($product_id)){
				//get product details
				$product = $this->manage_content->getValue_where("product_table","*","product_id",$product_id);
				if(count($product) > 0){
					//changing the date format
					$date = explode("-",$product[0]['expiration_date']);
					//create UI element
					echo '<div class="row-fluid">
							<div class="span5">
								<img src="'.$product[0]['image'].'" class="product_img"/>
								<div class="row-fluid" style="margin-top:10px;">';
								if(!empty($product[0]['image1']))
								{
									echo '<div class="span3">
											<img class="prductSmallImage" src="'.$product[0]['image1'].'" />
										</div>';
								}
								if(!empty($product[0]['image2']))
								{
									echo '<div class="span3">
											<img class="prductSmallImage" src="'.$product[0]['image2'].'" />
										</div>';
								}
								if(!empty($product[0]['image3']))
								{
									echo '<div class="span3">
											<img class="prductSmallImage" src="'.$product[0]['image3'].'" />
										</div>';
								}
								if(!empty($product[0]['image4']))
								{
									echo '<div class="span3">
											<img class="prductSmallImage" src="'.$product[0]['image4'].'" />
										</div>';
								}
									
							echo '</div>
							</div>
							<div class="span6">
								<h2 class="page_heading">'.$product[0]['product_name'].'</h2>
								<div class="row-fluid product_page">
									<p><span class="product_name">Koda izdelka:</span> '.$product[0]['product_id'].' </p>
									<p><span class="product_name">Maksimalna količina:</span> '.$product[0]['maxpick'].'</p>
									<p><span class="product_name">Datum poteka ponudbe:</span> '.$date[2].'.'.$date[1].'.'.$date[0].'</p>
								</div>
								<div class="row-fluid product_page product_price_tag">
									<p> <span class="product_price_text price_before">Cena pred:</span> <span class="product_price">  €'.$product[0]['old_price'].'</span></p>
									<p> <span class="product_price_text members_price">MojLife cena:</span> <span class="product_price members_price">  €'.$product[0]['price_members'].'</span></p>
									<p> <span class="product_price_text guest_price">Akcijska cena:</span> <span class="product_price">  €'.$product[0]['price_guest'].'</span></p>
								</div>
								<div class="row-fluid product_page product_price_tag">
									<p><span class="product_name">Količina:</span><input type="text" class="input-mini product_qty" id="'.$product[0]['product_id'].'" value="1"/></p>
									<button class="btn btn-danger btn-large product_addcart" 
									onclick="setProductQuantity(\''.$product[0]['product_id'].'\',\''.$product[0]['product_name'].'\','.$product[0]['maxpick'].')">Dodaj v voziček</button>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<h4 class="product_description">Predstavitev</h4>
							<p class="product_description_section">'.$product[0]['product_description'].'</p>
						</div>';
				}
			}
		}
		
		/*
			method for getting coupon details of a given coupon id
			Auth: Dipanjan
		*/
		
		function getCouponDetails($coupon_id){
			if(isset($coupon_id)){
				//get product details
				$coupon = $this->manage_content->getValue_where("coupon_table","*","coupon_id",$coupon_id);
				if(count($coupon[0]) > 0){
					//changing the date format
					$date = explode("-",$coupon[0]['expiration_date']);
					//create UI element
					echo '<div class="row-fluid">
							<div class="span5">
								<img src="'.$coupon[0]['image'].'" class="product_img"/>
								<div class="row-fluid" style="margin-top:10px;">';
								if(!empty($coupon[0]['image1']))
								{
									echo '<div class="span3">
											<img class="prductSmallImage" src="'.$coupon[0]['image1'].'" />
										</div>';
								}
								if(!empty($coupon[0]['image2']))
								{
									echo '<div class="span3">
											<img class="prductSmallImage" src="'.$coupon[0]['image2'].'" />
										</div>';
								}
								if(!empty($coupon[0]['image3']))
								{
									echo '<div class="span3">
											<img class="prductSmallImage" src="'.$coupon[0]['image3'].'" />
										</div>';
								}
								if(!empty($coupon[0]['image4']))
								{
									echo '<div class="span3">
											<img class="prductSmallImage" src="'.$coupon[0]['image'].'" />
										</div>';
								}
									
							echo '</div>
							</div>
							<div class="span6">
								<h2 class="page_heading">'.$coupon[0]['coupon_name'].'</h2>
								<div class="row-fluid product_page">
									<p><span class="product_name">Kupon Id:</span> '.$coupon[0]['coupon_id'].' </p>
									<p><span class="product_name">Maksimalna količina:</span> '.$coupon[0]['maxpick'].'</p>
									<p><span class="product_name">Datum poteka ponudbe:</span> '.$date[2].'.'.$date[1].'.'.$date[0].'</p>
								</div>
								<div class="row-fluid product_page product_price_tag">
									<p> <span class="product_price_text price_before">Cena pred:</span> <span class="product_price">  €'.$coupon[0]['old_price'].'</span></p>
									<p> <span class="product_price_text members_price">MojLife cena:</span> <span class="product_price members_price">  €'.$coupon[0]['price_members'].'</span></p>
									<p> <span class="product_price_text guest_price">Akcijska cena:</span> <span class="product_price">  €'.$coupon[0]['price_guest'].'</span></p>
								</div>
								<div class="row-fluid product_page product_price_tag">
									<p><span class="product_name">Količina:</span><input type="text" class="input-mini product_qty" id="'.$coupon[0]['coupon_id'].'" value="1"/></p>
									<button class="btn btn-danger btn-large product_addcart" 
									onclick="setCouponQuantity(\''.$coupon[0]['coupon_id'].'\',\''.$coupon[0]['coupon_name'].'\','.$coupon[0]['maxpick'].')">Dodaj v voziček</button>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<h4 class="product_description">Predstavitev</h4>
							<p class="product_description_section">'.$coupon[0]['coupon_description'].'</p>
						</div>';
				}
			}
		}
		
		/*
			method for getting the products selected in view_cart page
			Auth: Dipanjan
		*/
		
		function getSelectedProducts($member){
			if($member == 'guest')
			{
				$price = 'price_guest';
			}
			else
			{
				$price = 'price_members';
			}
			//taking all the cookie value to an array 
			$arr = $GLOBALS['_COOKIE'];
			//variable for adding the total amount
			$totalAmount = 0;
			$totalMemberAmount = 0;
			/*echo '<pre>';
			print_r($arr);
			echo '</pre>';*/
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
						//fetching the values from database according to product id
						$product = $this->manage_content->getValue_where("membership_product","*","product_id",$product_id);
						//showing the values in table
						if(count($product) > 0){
							echo '<tr>
								  <td class="cart_image"><img src="'.$product[0]['image'].'"/></td>
								  <td>'.$product[0]['product_name'].'</td>
								  <td><input type="text" class="input-mini" id="'.$product[0]['product_id'].'" value="'.$value.'"/>
								  <a onclick="deleteMembership(\''.$product[0]['product_id'].'\',\''.$product[0]['product_name'].'\')"><img src="img/remove.png" /></a>
								  </td>
								  <td>  €'.$product[0]['price'].'</td>
								  <td>  €'.($value*$product[0]['price']).'</td>
								</tr>';
								$totalMemberAmount = $totalMemberAmount + $value*$product[0]['price'];
						}
					}
					else
					{
						//fetching the values from database according to product id
						$product = $this->manage_content->getValue_where("product_table","*","product_id",$product_id);
						//showing the values in table
						if(count($product) > 0){
							echo '<tr>
								  <td class="cart_image"><a href="product.php?product='.$product[0]['product_id'].'"><img src="'.$product[0]['image'].'"/></a></td>
								  <td>'.$product[0]['product_name'].'</td>
								  <td>
									<input type="text" class="input-mini" id="'.$product[0]['product_id'].'" value="'.$value.'"/>
									
									<a onclick="sendQuantity(\''.$product[0]['product_id'].'\','.$product[0]['maxpick'].')"><img src="img/update.png"/></a>
									<a onclick="deleteProduct(\''.$product[0]['product_id'].'\',\''.$product[0]['product_name'].'\')"><img src="img/remove.png" /></a>  
								  </td>
								  <td>  €'.$product[0][$price].'</td>
								  <td>  €'.($value*$product[0][$price]).'</td>
								</tr>';
								$totalAmount = $totalAmount + $value*$product[0][$price];
						}
					}
				}
				//adding section for coupon selected
				else if($value == 'mojolife')
				{
					//getting the coupon id
					$coupon_id = substr($key,0,11);
					//fetching the values from coupon table
					$coupon = $this->manage_content->getValue_where("coupon_table","*","coupon_id",$coupon_id);
					//showing the values in table
					if(count($coupon) > 0){
						echo '<tr>
							  <td class="cart_image"><a href="coupon.php?coupon='.$coupon[0]['coupon_id'].'"><img src="'.$coupon[0]['image'].'"/></a></td>
							  <td>'.$coupon[0]['coupon_name'].'</td>
							  <td>
								<input type="text" class="input-mini" id="'.$coupon[0]['coupon_id'].'" value="1"/>
								<a onclick="deleteCouponProduct(\''.$coupon[0]['coupon_id'].'\',\''.$coupon[0]['coupon_name'].'\')"><img src="img/remove.png" /></a>
							  </td>
							  <td>  €'.$coupon[0][$price].'</td>
							  <td>  €'.(1*$coupon[0][$price]).'</td>
							</tr>';
							$totalAmount = $totalAmount + 1*$coupon[0][$price];
					}
					
				}
			}
		
		$Amount = $totalAmount + $totalMemberAmount;
		return $Amount;
		}
		
		/*
			method for getting the voucher section and total amount section in view_cart page
			Auth: Dipanjan
		*/
		
		function getAmount($totalAmount){
			//checking for guest or member
			if(isset($_SESSION['memberId'])){
                $buttonValue = 'Naprej na plačila'; 
		    }
            else{
                $buttonValue = 'Naprej na plačila';
            }
			echo '<div class="row-fluid">
					<h4 class="form_caption">Skupni znesek naročila</h4>
					<p><span class="product_name">Vmesna vsota:</span>  €'.$totalAmount.'</p>
					<p><span class="product_name">Skupaj:</span>  €'.$totalAmount.'</p>
					<a href="index.php" class="btn btn-danger">Nazaj po nakupih</a>
					<a href="v-includes/functions/function.checkout.php" class="btn btn-inverse cart_checkout">'.$buttonValue.'</a>';
			
		}
		
		/*
			method for getting slider content
			Auth: Dipanjan
		*/
		
		function getSliderContent($id){
			//checking getting values of slider content
			$slider = $this->manage_content->getValue_where("slider_content","*","id",$id);
			//checking the link
			if(!empty($slider[0]['link']))
			{
				$slider_link = $slider[0]['link'];
			}
			else
			{
				$slider_link = '#';
			}
			echo '<img src="'.$slider[0]['image'].'" alt="">
                    <div class="carousel-caption">
                      <h4><a href="'.$slider_link.'" class="slider_anchor">'.$slider[0]['heading'].'</a></h4>
                      <p>'.$slider[0]['description'].'</p>
                    </div>';
			
		}

		/*
			method for getting membership product
			Auth: Dipanjan
		*/
		
		function getMembershipProduct(){
			//get value from database
			$membership_products = $this->manage_content->getValue("membership_product","*");
			//variable for maintaining row-fluid
			$row_element = 0;
			$span_element = 1;
			// fetching all values one by one
			foreach($membership_products as $membership_product){
				//maintain no of elements in a row
				if($row_element%4 == 0){
					echo '<div class="row-fluid">
            				<ul class="thumbnails">';		
				}
				//checking product availablity
				if($membership_product['status'] == 1){
					//create UI element
					echo '<li class="span3 thumbnail right_container_object">
							<img src="'.$membership_product['image'].'" class="membership_product_img"/>
							<p>'.$membership_product['product_name'].'</p>
							<p>Cena:  €'.$membership_product['price'].'</p>
							<a name="membership_product" onclick="setMembershipProductCookie(\''.$membership_product['product_name'].'\',\''.$membership_product['product_id'].'\');" class="btn btn-primary">SELECT</a>
						</li>';
				}
				if($span_element%4 == 0){	
					echo '</ul>
            			</div>';		
				}
				
				$row_element++;
				$span_element++;
			}
		}
		
        /* Method for logging in by users 
        * Author: Vasu Naman
        */
    
          function login_users($email_Id,$password){
              $passwordRow = $this->manage_content->getValue_where("member_table","*","email_id",$email_Id);
              //checking for membership validiation
			  if($password == $passwordRow[0]['password'])
			  {
				  /*if($passwordRow[0]['membership_validiation'] == 1 && $passwordRow[0]['membership_activation'] == 1){
					   return array('success',$passwordRow[0]['membership_id']);
				  }
				  else {
					  return array('failed','invalid',$passwordRow[0]['membership_id']);
				  }*/
				  
				  if($passwordRow[0]['membership_activation'] == 1 && $passwordRow[0]['membership_validiation'] == 1)
				  {
					  return array('success',$passwordRow[0]['membership_id']);
				  }
				  elseif($passwordRow[0]['membership_activation'] == 1 && $passwordRow[0]['membership_validiation'] == 0)
				  {
					  return array('failed','invalid_email',$passwordRow[0]['membership_id']);
				  }
				  elseif($passwordRow[0]['membership_activation'] == 0 && $passwordRow[0]['membership_validiation'] == 1)
				  {
					  return array('failed','invalid_user',$passwordRow[0]['membership_id']);
				  }
				  else
				  {
					  return array('failed','invalid_all',$passwordRow[0]['membership_id']);
				  }
			  }
			  else
			  {
				  return array('failed','incorrect');
			  }
            }
			
		/* Method for logging in by users 
		* Author: Vasu Naman
		*/
    
          function forgot_pwd($email_Id){
              $password = $this->manage_content->getValue_where("member_table","password","email_id",$email_Id);
              if(!empty($password[0]['password'])){
                   return array('success',$password[0]['password']);
              }
              else {
                  return array('failed',0);
              }
            }	
          
         /* Method to get the logged in users data form database
          * like its address and his basic info
          * Author: Vasu Naman
          */ 
          
         function getUserData($memberId){
             $userData = $this->manage_content->getValue_where("member_table","*","membership_id",$memberId);
             return $userData;
         }
         
         
         /* Mehotds to get the actual values of maxpic and prices of products for the users or for the guest
          * Author: Vasu Naman
          */
         
         function getmaxpick($queryString){
                 
             $valueList = '('.substr($queryString, 1,strlen($queryString)).')';
             
             if(substr($queryString,2,1) == 'M'){
                $userData = $this->manage_content->getValueWhereIn('membership_product','maxpick','product_id',$valueList);
                return $userData; 
             }
             else{
                $userData = $this->manage_content->getValueWhereIn('product_table','maxpick','product_id',$valueList);
                return $userData;
             }
             
         }
         
         
         /*
         * Insert 1 for activated user
         *  Auth vasu naman
        */
        function activateUser($membership_id,$email){
            $userActivate = $this->manage_content->activateUser($membership_id,$email);
            
            return $userActivate;
        }
        
        
        /*
         * check whether a user is activated or not 
         */
         function checkActivation($mid){
             $userActivated = $this->manage_content->getValue_where('member_table','membership_validiation','membership_id',$mid);
             return $userActivated;
         }
         
          
         
         
         /* method which inserts the value of the users new address or old address at the time of check out */
         function insertAddressValue($userShippingAddress,$datatype,$deliveryStatus,$ipaddress,$orderid){
            $insertAddressSuccessful = $this->manage_content->insertAddress($userShippingAddress,$datatype,$deliveryStatus,$ipaddress,$orderid);
             return $insertAddressSuccessful;
         }
         
         function insertShipComment($orderId,$shipComment){
             $insertShipCon = $this->manage_content->insertShipCon($orderId,$shipComment);
             return $insertShipCon;
         }
         
         function insertpaymentComm($orderId,$paymentMethod,$orderCom){
             $insertPaymentCon = $this->manage_content->insertPaymentCon($orderId,$paymentMethod,$orderCom);
             return $insertPaymentCon;
         }
         
         /*method which inserts users final value at the time of payment through account
		 	Auth Dipanjan
		 */
         function insertPaymentConfirm($orderId,$totalPrice,$memberid,$allProducts){
             $insertPaymentConf = $this->manage_content->insertPayment($orderId,$totalPrice,$memberid,$allProducts);
             //taking all the cookie value to an array 
            $arr = $GLOBALS['_COOKIE'];
			//getting payment method from purchase log table
			$payment_method = $this->manage_content->
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
					//setting payment status
					$payment_status = 0;
					//inserting values in payment status
					$result = $this->manage_content->insertPurchaseInfo($orderId,$product_id,$value,$date,$payment_method[0]['payment_method'],$payment_status);
                }
				//checking for coupon name
				else if($value == 'mojolife')
				{
					//getting the coupon id
					$coupon_id = substr($key,0,11);
					//setting payment status
					$payment_status = 0;
					//inserting values in payment status
					$result = $this->manage_content->insertPurchaseInfo($orderId,$coupon_id,1,$date,$payment_method[0]['payment_method'],$payment_status);
				}
            }
			if($memberid == 'guest')
			{
				$email_id = $payment_method[0]['email_id'];
			}
			else
			{
				$member = $this->manage_content->getValue_where("member_table","*","membership_id",$memberid);
				$email_id = $member[0]['email_id'];
			}
			//getting the product and quantity details
			$all_products = $this->manage_content->getValue_where("purchase_info","*","order_id",$orderId);
			//initialize parameter
			$cate = "";
			$quantity = "";
			foreach($all_products as $all_product){
				$val = $all_product['product_id'];
				if(substr($val,0,1) == 'M')
				{
					$product = $this->manage_content->getValue_where("membership_product","*","product_id",$val);
					$cate = $cate.$product[0]['product_name']."<br>";
					
				}
				else if(substr($val,0,1) == 'C')
				{
					$product = $this->manage_content->getValue_where("coupon_table","*","coupon_id",$val);
					
					$cate = $cate.$product[0]['coupon_name']."<br>";
				}
				else
				{
					$product = $this->manage_content->getValue_where("product_table","*","product_id",$val);
					$cate = $cate.$product[0]['product_name']."<br>";
				}
				$sl_no++;
				//llisting the quantity of products
				$quantity = $quantity.$all_product['quantity']."<br>";
			}
			 return array($result,$insertPaymentConf,$email_id,$payment_method[0]['price'],$cate,$quantity);
         }
		 
		 /*method which inserts users final value at the time of payment through myaccount
		 	Auth Dipanjan
		 */
         function insertPaymentConfirmAccount($orderId,$totalPrice,$memberid,$allProducts){
             $insertPaymentConf = $this->manage_content->insertPayment($orderId,$totalPrice,$memberid,$allProducts);
             //taking all the cookie value to an array 
            $arr = $GLOBALS['_COOKIE'];
			//getting payment method from purchase log table
			$payment_method = $this->manage_content->
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
					//setting payment status
					$payment_status = 0;
					//inserting values in payment status
					$result = $this->manage_content->insertPurchaseInfo($orderId,$product_id,$value,$date,$payment_method[0]['payment_method'],$payment_status);
                }
				//checking for coupon name
				else if($value == 'mojolife')
				{
					//getting the coupon id
					$coupon_id = substr($key,0,11);
					//setting payment status
					$payment_status = 0;
					//inserting values in payment status
					$result = $this->manage_content->insertPurchaseInfo($orderId,$coupon_id,1,$date,$payment_method[0]['payment_method'],$payment_status);
				}
            }
			if($memberid == 'guest')
			{
				$email_id = $payment_method[0]['email_id'];
			}
			else
			{
				$member = $this->manage_content->getValue_where("member_table","*","membership_id",$memberid);
				$email_id = $member[0]['email_id'];
			}
			//getting the product and quantity details
			$all_products = $this->manage_content->getValue_where("purchase_info","*","order_id",$orderId);
			//initialize parameter
			$cate = "";
			$quantity = "";
			foreach($all_products as $all_product){
				$val = $all_product['product_id'];
				if(substr($val,0,1) == 'M')
				{
					$product = $this->manage_content->getValue_where("membership_product","*","product_id",$val);
					$cate = $cate.$product[0]['product_name']."<br>";
					
				}
				else if(substr($val,0,1) == 'C')
				{
					$product = $this->manage_content->getValue_where("coupon_table","*","coupon_id",$val);
					
					$cate = $cate.$product[0]['coupon_name']."<br>";
				}
				else
				{
					$product = $this->manage_content->getValue_where("product_table","*","product_id",$val);
					$cate = $cate.$product[0]['product_name']."<br>";
				}
				$sl_no++;
				//llisting the quantity of products
				$quantity = $quantity.$all_product['quantity']."<br>";
			}
			 return array($result,$insertPaymentConf,$email_id,$payment_method[0]['price'],$cate,$quantity);
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
			$payment_method = $this->manage_content->
			getValue_where("purchase_log","payment_method","order_id",$orderId);
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
					//setting payment status
					$payment_status = 1;
					//setting all products variable
					$product_string = $product_string.",".$product_id;
					//inserting values in payment status
					$result = $this->manage_content->insertPurchaseInfo($orderId,$product_id,$value,$date,$payment_method[0]['payment_method'],$payment_status);
                }
				//checking for coupon name
				else if($value == 'mojolife')
				{
					//getting the coupon id
					$coupon_id = substr($key,0,11);
					//setting payment status
					$payment_status = 1;
					//setting all products variable
					$product_string = $product_string.",".$coupon_id;
					//inserting values in payment status
					$result = $this->manage_content->insertPurchaseInfo($orderId,$coupon_id,1,$date,$payment_method[0]['payment_method'],$payment_status);
				}
            }
			/*
			- remove the first word from the $category_string sa it
			- it contains a comma
			*/
			$product_string = substr($product_string,1);
			//insert values in purchase log
			$insertPaymentConf = $this->manage_content->insertPayment($orderId,$totalPrice,$memberid,$product_string);
			return $result.$insertPaymentConf;
         }
		 
		 /* method for inserting values in add money info
		 	Auth Dipanjan
		 */
		 function addMoneyToEWallet($membership_id,$money_id){
			//current date
			$curdate = $this->getDate();
			//creating the column name array
			$column_name = array("membership_id","money_id","date");
			//creating table value
			$values = array($membership_id,$money_id,$curdate);
			//inserting user values to database user_info table
			$insert = $this->manage_content->insertValue("addmoney_info",$column_name,$values);
			
			$member = $this->manage_content->getValue_where("member_table","*","membership_id",$membership_id);
			$email_id = $member[0]['email_id'];
			return array($insert,$email_id,$this->changeDateFormat($curdate));
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
				//getting system balance from money transfer log
				$system_balance = $this->manage_content->getLastValue("money_transfer_log","system_balence","id");
                //checking the key name for identifying the cookies
                if(substr($key,0,10) == 'no_product')
                {
                    //separating the product id from cookies name
                    $product_id = substr($key,10);
					//checking for membership product
                    if(substr($product_id,0,1) == 'M')
                    {
                        //fetching the values from database according to product id
                        $product = $this->manage_content->getValue_where("membership_product","*","product_id",$product_id);
						//setting amount credited
						$amount = $value*$product[0]['price'];
						//new system balance
						$new_system_balence = $system_balance[0]['system_balence'] + $amount;	
						//insert values in money transfer log
						$result = $this->manage_content->insertCreditAmount($memberid,$product_id,$value,$date,$amount,$new_system_balence,0,"");					
                    }
                    else
                    {
                        //fetching the values from database according to product id
                        $product = $this->manage_content->getValue_where("product_table","*","product_id",$product_id);
						//setting amount credited
						$amount = $value*$product[0][$price];
						//new system balance
						$new_system_balence = $system_balance[0]['system_balence'] + $amount;
						//insert values in money transfer log
						$result = $this->manage_content->insertCreditAmount($memberid,$product_id,$value,$date,$amount,$new_system_balence,0,"");
                    }
                }
				//checking for coupon value
				else if($value == 'mojolife')
				{
					//getting coupon id
					$coupon_id = substr($key,0,11);
					//getting coupon details
					$coupon = $this->manage_content->getValue_where("coupon_table","*","coupon_table",$coupon_id);
					//setting amount credited
					$amount = 1*$coupon[0]['price'];
					//new system balance
					$new_system_balence = $system_balance[0]['system_balence'] + $amount;
					//insert values in money transfer log
					$result = $this->manage_content->insertCreditAmount($memberid,$coupon_id,1,$date,$amount,$new_system_balence,0,"");
				}
            }
         }

        
        /*
          *  method for getting the products selected in checkout page
            Auth: Dipanjan edited by Vasu Naman
        */
        
        function getSelectedProductsInCheckoutPage($member){
            if($member == 'guest')
			{
				$price = 'price_guest';
			}
			else
			{
				$price = 'price_members';
			}
			//taking all the cookie value to an array 
            $arr = $GLOBALS['_COOKIE'];
            //variable for adding the total amount
            $totalAmount = 0;
            $totalMemberAmount = 0;
            /*echo '<pre>';
            print_r($arr);
            echo '</pre>';*/
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
                        //fetching the values from database according to product id
                        $product = $this->manage_content->getValue_where("membership_product","*","product_id",$product_id);
                        //showing the values in table
                        if(count($product) > 0){
                            echo '<tr>
                                  <td>'.$product[0]['product_name'].'</td>
                                  <td>'.$value.'</td>
                                  <td>  €'.$product[0]['price'].'</td>
                                  <td>  €'.($value*$product[0]['price']).'</td>
                                </tr>';
                                $totalMemberAmount = $totalMemberAmount + $value*$product[0]['price'];
                        }
                    }
                    else
                    {
                        //fetching the values from database according to product id
                        $product = $this->manage_content->getValue_where("product_table","*","product_id",$product_id);
                        //showing the values in table
                        if(count($product) > 0){
                            echo '<tr>
                                  <td>'.$product[0]['product_name'].'</td>
                                  <td>'.$value.'</td>
                                  <td>  €'.$product[0][$price].'</td>
                                  <td>  €'.($value*$product[0][$price]).'</td>
                                </tr>';
                                $totalAmount = $totalAmount + $value*$product[0][$price];
                        }
                    }
                }
				//adding section for coupon selected
				else if($value == 'mojolife')
				{
					//getting the coupon id
					$coupon_id = substr($key,0,11);
					//fetching the values from coupon table
					$coupon = $this->manage_content->getValue_where("coupon_table","*","coupon_id",$coupon_id);
					//showing the values in table
					if(count($coupon) > 0){
						echo '<tr>
							  <td>'.$coupon[0]['coupon_name'].'</td>
							  <td>1</td>
							  <td>  €'.$coupon[0][$price].'</td>
							  <td>  €'.(1*$coupon[0][$price]).'</td>
							</tr>';
							$totalAmount = $totalAmount + 1*$coupon[0][$price];
					}
					
				}
				
            }
        
        $Amount = $totalAmount + $totalMemberAmount;
        echo    '<tr>
                  <td></td>
                  <td></td>
                  <td class="product_name"> Skupni znesek: </td>
                  <td>  €'.$Amount.'</td>
                </tr>';
        return $Amount;
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
			getting child elements of given member from database table
			Auth: Dipanjan
		*/
		function getChildElements($membership_id){
			//fetching values from database
			$child_id = $this->manage_content->getValue_where("mlm_info","child_id","membership_id",$membership_id);
			//checking membership validiation of parent member
			$parent_validiation = $this->manage_content->getValue_where("member_table","*","membership_id",$membership_id);
			//checking for child element
			if($child_id[0]['child_id'] != "")
			{
				//separating the values and storing in an array
				$id = explode(",",$child_id[0]['child_id']);
				$id_reverse = array_reverse($id);
				foreach($id_reverse as $child)
				{
					//getting child membership id
					$child_membership_id = 
					$this->manage_content->getValue_where("mlm_info","*","id",$child);
					//getting no of child of every child member
					$no_of_child = count(explode(",",$child_membership_id[0]['child_id']));
					//counting the no of child pesent in array
					if($no_of_child == 1)
					{
						//taking child id's in an array
						$no_child = explode(",",$child_membership_id[0]['child_id']);
						//checking for empty value
						if(!empty($no_child[0]))
						{
							$child_no = 1;
						}
						else
						{
							$child_no = 0;
						}
					}
					//setting the child no as no of child
					else
					{
						$child_no = $no_of_child;
					}
					//getting child member details from member table
					$child_member = $this->manage_content->getValue_where("member_table","*","membership_id",$child_membership_id[0]['membership_id']);
					//checking membership validiation of parent member
					if($parent_validiation[0]['membership_validiation'] == 1 && $parent_validiation[0]['membership_activation'] == 1)
					{
						//checking membership validiation of child members
						if($child_member[0]['membership_validiation'] == 1 && $child_member[0]['membership_activation'] == 1)
						{
							$validiate = 'VIP Member';
						}
						else
						{
							$validiate = '';
						}
					}
					else
					{
						$validiate = '';
					}
						
					//showing the values in UI layer page
					echo '<div class="row">  
							  <div class="span12 mlm-chlid">  
							   <img class="img-polaroid img-mlm" src="img/p-c_connector.gif">
							   <img class="img-polaroid mlm_icon_img" src="http://placehold.it/100X100&text=user%20icon">
							   <div class="thumbnail mlm_child_info pull-right">
									 <h4 class="child_name">'.$child_member[0]['name'].'</h4>
									 <p><span class="product_name">Membership Id:</span> '.$child_membership_id[0]['membership_id'].'</p>
									 <p><span class="product_name">No. of Child:</span> '.$child_no.'</p>
									 <p><span class="product_name"></span> '.$validiate.'</p>
								</div>
							  </div>
							</div>';
				}
			}
			else
			{
				echo '<div class="row">  
						<div class="no_found_text"> No Child Element </div>
					</div>';
			}
		}
		
		/*
			getting members purchase history
			Auth: Dipanjan
		*/
		function getPurchaseHistory($membership_id){
			//fetching values from database
			$purchases = $this->manage_content->getValueWhere_descending("purchase_log","*","membership_id",$membership_id);
			//checking for empty result
			if(!empty($purchases[0]))
			{
				foreach($purchases as $purchase){
					//getting purchase info values
					$purchase_info = $this->manage_content->getValue_where("purchase_info","*","order_id",$purchase['order_id']);
					//checking for payment status
					if($purchase_info[0]['payment_status'] == 0)
					{
						$payment_status = 'Not Confirmed';
					}
					else
					{
						$payment_status = 'Confirmed';
					}
					//checking for delivary status
					if($purchase['delivery_status'] == 1)
					{
						$delivery_status = 'Delivered';
					}
					else if($purchase['delivery_status'] == 0 && $purchase_info[0]['payment_request'] == 'Undo')
					{
						$delivery_status = 'Product Returned';
					}
					else
					{
						$delivery_status = 'Not Delivered';
					}
					//showing them in table
					echo '<tr>
							<td>'.$purchase['order_id'].'</td>
							<td>'.$this->anOrderProductList($purchase['order_id']).'</td>
							<td>'.$this->anOrderQuantityList($purchase['order_id']).'</td>
							<td>  €'.$purchase['price'].'</td>
							<td>'.$this->changeDateFormat($purchase['date']).'</td>
							<td>'.$payment_status.'</td>
							<td>'.$delivery_status.'</td>
						</tr>';
				}
			}
			else
			{
				echo 'NO ORDER LIST';
			}
		}
		
		/*
			getting members withdraw history
			Auth: Dipanjan
		*/
		function getWithdrawHistory($membership_id){
			//fetching values from database
			$withdraws = $this->manage_content->getValueWhere_descending("withdraw_log","*","membership_id",$membership_id);
			//checking for empty result
			if(!empty($withdraws[0]))
			{
				foreach($withdraws as $withdraw){
					//checking for frozen money
					if($withdraw['frozen_money'] == 1)
					{
						$frozen_money = 'Yes';
					}
					else
					{
						$frozen_money = 'No';
					}
					//checking for withdraw confirmation
					if($withdraw['status'] == 1)
					{
						$confirm = 'Confirmed';
					}
					else
					{
						$confirm = 'Processing';
					}
					//showing them in table
					echo '<tr>
							<td>'.$withdraw['withdraw_order_id'].'</td>
							<td>'.$this->changeDateFormat($withdraw['date']).'</td>
							<td>'.$frozen_money.'</td>
							<td>  €'.$withdraw['withdraw_amount'].'</td>
							<td>'.$confirm.'</td>
						</tr>';
				}
			}
			else
			{
				echo 'NO WITHDRAW LIST';
			}
		}
		
		/*
			getting sold products list of an order
			Auth: Dipanjan
		*/
		function anOrderProductList($order_id){
			//fetching values from database
			$products = $this->manage_content->getValue_where("purchase_info","product_id","order_id",$order_id);
			//initialize a product list string
			$list = "";
			foreach($products as $product){
				//getting product name
				if(substr($product['product_id'],0,1) == 'M')
				{
					$product_name = $this->manage_content->getValue_where("membership_product","product_name","product_id",$product['product_id']);
					$name = $product_name[0]['product_name'];
				}
				else if(substr($product['product_id'],0,1) == 'C')
				{
					$coupon_name = $this->manage_content->getValue_where("coupon_table","coupon_name","coupon_id",$product['product_id']);
					$name = $coupon_name[0]['coupon_name'];
				}
				else
				{
					$product_name = $this->manage_content->getValue_where("product_table","product_name","product_id",$product['product_id']);
					$name = $product_name[0]['product_name'];
				}
				$list = $list."<br>".$name;
			}
			//cancelling 1st space from list
			$list = substr($list,4);
			return($list);
		}
		
		/*
			getting sold quantity list of an order
			Auth: Dipanjan
		*/
		function anOrderQuantityList($order_id){
			//fetching values from database
			$products = $this->manage_content->getValue_where("purchase_info","quantity","order_id",$order_id);
			//initialize a product list string
			$list = "";
			foreach($products as $product){
				$list = $list."<br>".$product['quantity'];
			}
			//cancelling 1st space from list
			$list = substr($list,4);
			return($list);
		}
		
		/*
			inserting values to withdraw log table
			Auth: Dipanjan
		*/
		function insertWithdrawValue($membership_id,$amount,$order_id){
			$date = $this->getDate();
			//inserting values
			$insert = $this->manage_content->insertWithdrawalAmount($membership_id,$amount,0,$order_id,$date,0);
		}
		/*
			getting net balence of member
			Auth: Dipanjan
		*/
		function getNetAmount($membership_id,$total_price){
			//checking for invalid member or not
			$member_validity = $this->manage_content->getValue_where("member_table","*","membership_id",$membership_id);
			//getting all transaction of a member
			$transaction = $this->manage_content->
			getValue_twoCoditions("money_transfer_log","*","membership_id",$membership_id,"frozen_money",0);
			//initialize a variable for total amount calculation
			$total_amount = 0;
			$withdraw_amount = 0;
			$withdraw_requested_amount = 0;
			$purchase_by_account = 0;
			$net_amount = 0;
			$add_money = 0;
			if(count($transaction[0]) > 0)
			{  
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{		
						// total amount calculation
						$total_amount = $total_amount + $transactions['debit'];
					}
				}
				//getting the withdrawal amount from database
				$withdraws = $this->manage_content->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",0);
				//getting the amount withdrawal to that member
				if(!empty($withdraws[0]))
				{
					foreach($withdraws as $withdrawal)
					{
						if(substr($withdrawal['withdraw_order_id'],0,8) == 'withdraw')
						{
							//checking for status of money transfer
							if($withdrawal['status'] == 1)
							{
								$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
							}
							//checking for requested amount
							else
							{
								$withdraw_requested_amount = $withdraw_requested_amount + $withdrawal['withdraw_amount'];
							}
						}
						else
						{
							$purchase_by_account = $purchase_by_account + $withdrawal['withdraw_amount'];
						}
					}
				}
			}
			//calculating add money to ewallet
			$add_money_details = $this->manage_content->getValue_twoCoditions_descending("addmoney_info","*","membership_id",$membership_id,"status",1);
			if(!empty($add_money_details[0]))
			{
				foreach($add_money_details as $add_money_detail)
				{
					$add_money = $add_money + $add_money_detail['amount'];
				}
			}
			//checking for net amount greater than total price or not
			$wallet_balance = (($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
			if($wallet_balance > $total_price)
			{
				return $wallet_balance;
			}
			else
			{
				echo 'You have not Sufficient balance!!';
			}
			
		}
		
		/*
			getting ewallet details of member from database table
			Auth: Dipanjan
		*/
		function getEwalletValue($membership_id){
			//getting all transaction of a member
			$transaction = $this->manage_content->
			getValue_twoCoditions_descending("money_transfer_log","*","membership_id",$membership_id,"frozen_money",0);
			//initialize a variable for serial no calculation
			$sl_no = 1;
			//initialize a variable for total amount calculation
			$total_amount = 0;
			$withdraw_amount = 0;
			$withdraw_requested_amount = 0;
			$purchase_by_account = 0;
			$net_amount = 0;
			$add_money = 0;
			if(count($transaction[0]) > 0)
			{ 
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{	
						if(substr($transactions['product_id'],0,1) == 'C')
						{
							//fetching the name of product from product table
							$coupon_details = $this->manage_content->
							getValue_where("coupon_table","*","coupon_id",$transactions['product_id']);
							//showing the details of money debited in detail
							/*echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$coupon_details[0]['coupon_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';*/
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
						else
						{
							//checking for membership product or not
							if(substr($transactions['product_id'],0,2) == 'M_')
							{
								$table_name = 'membership_product';
							}
							else
							{
								$table_name = 'product_table';
							}
							//fetching the name of product from product table
							$product_details = $this->manage_content->
							getValue_where($table_name,"*","product_id",$transactions['product_id']);
							//showing the details of money debited in detail
							/*echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$product_details[0]['product_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';*/
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
						
					}
				}
				//getting the withdrawal amount from database
				$withdraws = $this->manage_content->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",0);
				//getting the amount withdrawal to that member
				if(!empty($withdraws[0]))
				{
					foreach($withdraws as $withdrawal)
					{
						if(substr($withdrawal['withdraw_order_id'],0,8) == 'withdraw')
						{
							//checking for status of money transfer
							if($withdrawal['status'] == 1)
							{
								$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
							}
							//checking for requested amount
							else
							{
								$withdraw_requested_amount = $withdraw_requested_amount + $withdrawal['withdraw_amount'];
							}
						}
						else
						{
							$purchase_by_account = $purchase_by_account + $withdrawal['withdraw_amount'];
						}
					}
				}
			}
			else
			{
				echo "";
			}
			//calculating add money to ewallet
			$add_money_details = $this->manage_content->getValue_twoCoditions_descending("addmoney_info","*","membership_id",$membership_id,"status",1);
			if(!empty($add_money_details[0]))
			{
				foreach($add_money_details as $add_money_detail)
				{
					$add_money = $add_money + $add_money_detail['amount'];
				}
			}
			
			echo '</tbody>';

			//showing total amount in table
			echo '<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Gross Amount: </td>
					<td>  € '.$total_amount.'</td>
				</tr>';
			
			echo  '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Withdrew Amount: </td>
					<td>  € '.$withdraw_amount.'</td>
				</tr>';
			
			if(!empty($withdraw_requested_amount))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Amount Requested for Withdrawal: </td>
						<td>  € '.$withdraw_requested_amount.'</td>
					</tr>';
			}
			if(!empty($purchase_by_account))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Product Purchase Amount: </td>
						<td>  € '.$purchase_by_account.'</td>
					</tr>';
			}
			if(!empty($add_money))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Add Money To ML Wallet: </td>
						<td>  € '.$add_money.'</td>
					</tr>';
			}
			if((($total_amount + $add_money) - 
			($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)) != 0)
			{
				echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Net Amount: </td>
					<td>  € '.(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)).'</td>
				</tr>';
				return (($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
			}
			else
			{
				echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Net Amount: </td>
					<td>  € '.(int)(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)).'</td>
				</tr>';
				return (int)(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
			}
			
		}
		
		/*
			getting ewallet details of member from database table
			Auth: Dipanjan
		*/
		function getEwalletTransaction($membership_id){
			//getting all transaction of a member
			$transaction = $this->manage_content->
			getValue_twoCoditions_descending("money_transfer_log","*","membership_id",$membership_id,"frozen_money",0);
			//initialize a variable for serial no calculation
			$sl_no = 1;
			//initialize a variable for total amount calculation
			/*$total_amount = 0;
			$withdraw_amount = 0;
			$withdraw_requested_amount = 0;
			$purchase_by_account = 0;
			$net_amount = 0;
			$add_money = 0;*/
			if(count($transaction[0]) > 0)
			{ 
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']) && $sl_no <= 20)
					{	
						if(substr($transactions['product_id'],0,1) == 'C')
						{
							//fetching the name of product from product table
							$coupon_details = $this->manage_content->
							getValue_where("coupon_table","*","coupon_id",$transactions['product_id']);
							//showing the details of money debited in detail
							echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$coupon_details[0]['coupon_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';
								
								//increment of serial_no variable
								$sl_no++;
								
						}
						else
						{
							//checking for membership product or not
							if(substr($transactions['product_id'],0,2) == 'M_')
							{
								$table_name = 'membership_product';
							}
							else
							{
								$table_name = 'product_table';
							}
							//fetching the name of product from product table
							$product_details = $this->manage_content->
							getValue_where($table_name,"*","product_id",$transactions['product_id']);
							//showing the details of money debited in detail
							echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$product_details[0]['product_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';
								
								//increment of serial_no variable
								$sl_no++;
						}
						
					}
				}
				
			}
			else
			{
				echo "";
			}
		}
		
		/*
			getting ewallet details of member from database table where money is frozen money
			Auth: Dipanjan
		*/
		function getEwalletFrozen($membership_id){
			//getting all transaction of a member
			$transaction = $this->manage_content->
			getValue_twoCoditions_descending("money_transfer_log","*","membership_id",$membership_id,"frozen_money",1);
			//initialize a variable for serial no calculation
			$sl_no = 1;
			//initialize a variable for total amount calculation
			$total_amount = 0;
			$withdraw_amount = 0;
			$withdraw_requested_amount = 0;
			if(count($transaction[0]) > 0)
			{
				
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{	
						if(substr($transactions['product_id'],0,1) == 'C')
						{
							//fetching the name of product from product table
							$coupon_details = $this->manage_content->
							getValue_where("coupon_table","*","coupon_id",$transactions['product_id']);
							//showing the details of money debited in detail
							/*echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$coupon_details[0]['coupon_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';*/
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
						else
						{
							//checking for membership product or not
							if(substr($transactions['product_id'],0,2) == 'M_')
							{
								$table_name = 'membership_product';
							}
							else
							{
								$table_name = 'product_table';
							}
							//fetching the name of product from product table
							$product_details = $this->manage_content->
							getValue_where($table_name,"*","product_id",$transactions['product_id']);
							//showing the details of money debited in detail
							/*echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$product_details[0]['product_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';*/
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
					}
				}
				//getting the withdrawal amount from database
				$withdraws = $this->manage_content->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",1);
				//getting the amount withdrawal to that member
				if(!empty($withdraws[0]))
				{
					foreach($withdraws as $withdrawal)
					{
						//checking for status of money transfer
						if($withdrawal['status'] == 1)
						{
							$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
						}
						//checking for requested amount
						else
						{
							$withdraw_requested_amount = $withdraw_requested_amount + $withdrawal['withdraw_amount'];
						}
					}
				}
			}
			else
			{
				echo "";
			}

			//showing total amount in table
			echo '<tr>
					<td class="total_amount"> Gross Amount: </td>
					<td>  € '.$total_amount.'</td>
				</tr>
				<tr>
					<td class="total_amount"> Withdrew Amount: </td>
					<td>  € '.$withdraw_amount.'</td>
				</tr>';
			if(!empty($withdraw_requested_amount))
			{
				echo '<tr>
					<td class="total_amount"> Amount Requested for Withdrawal: </td>
					<td>  € '.$withdraw_requested_amount.'</td>
				</tr>';
			}
			if(($total_amount - ($withdraw_requested_amount + $withdraw_amount)) != 0)
			{
				echo '<tr>
					<td class="total_amount"> Net Amount: </td>
					<td>  € '.($total_amount - ($withdraw_requested_amount + $withdraw_amount)).'</td>
				</tr>';
				return ($total_amount - ($withdraw_requested_amount + $withdraw_amount));
			}
			else
			{
				echo '<tr>
					<td class="total_amount"> Net Amount: </td>
					<td>  € '.(int)($total_amount - ($withdraw_requested_amount + $withdraw_amount)).'</td>
				</tr>';
				return (int)($total_amount - ($withdraw_requested_amount + $withdraw_amount));
			}
			
		}
		
		/*
		 method for calculating potential money
		 Auth: Dipanjan
		*/
		function getPotentialMoney($membership_id){
			//getting all transaction of a member
			$transaction = $this->manage_content->getValue_twoCoditions("money_transfer_log","*","membership_id","potentialMoney","notes",$membership_id); 
			//initialize a variable for serial no calculation
			$sl_no = 1;
			//initialize a variable for total amount calculation
			$total_amount = 0;
			if(count($transaction[0]) > 0)
			{
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{	
						if(substr($transactions['product_id'],0,1) == 'C')
						{
							//fetching the name of product from product table
							$coupon_details = $this->manage_content->
							getValue_where("coupon_table","*","coupon_id",$transactions['product_id']);
							//showing the details of money debited in detail
							echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$coupon_details[0]['coupon_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
						else
						{
							//checking for membership product or not
							if(substr($transactions['product_id'],0,2) == 'M_')
							{
								$table_name = 'membership_product';
							}
							else
							{
								$table_name = 'product_table';
							}
							//fetching the name of product from product table
							$product_details = $this->manage_content->
							getValue_where($table_name,"*","product_id",$transactions['product_id']);
							//showing the details of money debited in detail
							echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$product_details[0]['product_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
					}
				}
			}
			else
			{
				echo '';
			}
			
			//checking from invalid potential money table
			$invalid_potentials = $this->manage_content->getValue_where("invalid_potential_money","*","membership_id",$membership_id);
			if(!empty($invalid_potentials[0]))
			{
				foreach($invalid_potentials as $invalid_potential)
				{
					if(substr($invalid_potential['product_id'],0,1) == 'C')
					{
						//fetching the name of product from product table
						$coupon_details = $this->manage_content->
						getValue_where("coupon_table","*","coupon_id",$invalid_potential['product_id']);
						//showing the details of money debited in detail
						echo '<tr>
								<td>'.$sl_no.'</td>
								<td>'.$coupon_details[0]['coupon_name'].'</td>
								<td>'.$invalid_potential['product_quantity'].'</td>
								<td>'.$this->changeDateFormat($invalid_potential['date']).'</td>
								<td>  € '.$invalid_potential['amount'].'</td>
							</tr>';
							
							// total amount calculation
							$total_amount = $total_amount + $invalid_potential['amount'];
							//increment of serial_no variable
							$sl_no++;
					}
					else
					{
						//checking for membership product or not
						if(substr($invalid_potential['product_id'],0,2) == 'M_')
						{
							$table_name = 'membership_product';
						}
						else
						{
							$table_name = 'product_table';
						}
						//fetching the name of product from product table
						$product_details = $this->manage_content->
						getValue_where($table_name,"*","product_id",$invalid_potential['product_id']);
						//showing the details of money debited in detail
						echo '<tr>
								<td>'.$sl_no.'</td>
								<td>'.$product_details[0]['product_name'].'</td>
								<td>'.$invalid_potential['product_quantity'].'</td>
								<td>'.$this->changeDateFormat($invalid_potential['date']).'</td>
								<td>  € '.$invalid_potential['amount'].'</td>
							</tr>';
							
							// total amount calculation
							$total_amount = $total_amount + $invalid_potential['amount'];
							//increment of serial_no variable
							$sl_no++;
					}
				}
			}
			
			//showing total amount in table
			echo '<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Total Amount: </td>
						<td>  € '.$total_amount.'</td>
					</tr>';
		}
		
		/*
			getting ewallet details of member from database table
			Auth: Dipanjan
		*/
		function getMyWalletValue($membership_id){
			//getting all transaction of a member
			$transaction = $this->manage_content->
			getValue_twoCoditions_descending("money_transfer_log","*","membership_id",$membership_id,"frozen_money",0);
			//initialize a variable for serial no calculation
			$sl_no = 1;
			//initialize a variable for total amount calculation
			$total_amount = 0;
			$withdraw_amount = 0;
			$withdraw_requested_amount = 0;
			$purchase_by_account = 0;
			$net_amount = 0;
			$add_money = 0;
			if(count($transaction[0]) > 0)
			{ 
				foreach($transaction as $transactions){
					//checking for only debited amount
					if(!empty($transactions['debit']))
					{	
						if(substr($transactions['product_id'],0,1) == 'C')
						{
							//fetching the name of product from product table
							$coupon_details = $this->manage_content->
							getValue_where("coupon_table","*","coupon_id",$transactions['product_id']);
							//showing the details of money debited in detail
							echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$coupon_details[0]['coupon_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
						else
						{
							//checking for membership product or not
							if(substr($transactions['product_id'],0,2) == 'M_')
							{
								$table_name = 'membership_product';
							}
							else
							{
								$table_name = 'product_table';
							}
							//fetching the name of product from product table
							$product_details = $this->manage_content->
							getValue_where($table_name,"*","product_id",$transactions['product_id']);
							//showing the details of money debited in detail
							echo '<tr>
									<td>'.$sl_no.'</td>
									<td>'.$product_details[0]['product_name'].'</td>
									<td>'.$transactions['product_quantity'].'</td>
									<td>'.$this->changeDateFormat($transactions['date']).'</td>
									<td>  € '.$transactions['debit'].'</td>
								</tr>';
								
								// total amount calculation
								$total_amount = $total_amount + $transactions['debit'];
								//increment of serial_no variable
								$sl_no++;
						}
						
					}
				}
				//getting the withdrawal amount from database
				$withdraws = $this->manage_content->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",0);
				//getting the amount withdrawal to that member
				if(!empty($withdraws[0]))
				{
					foreach($withdraws as $withdrawal)
					{
						if(substr($withdrawal['withdraw_order_id'],0,8) == 'withdraw')
						{
							//checking for status of money transfer
							if($withdrawal['status'] == 1)
							{
								$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
							}
							//checking for requested amount
							else
							{
								$withdraw_requested_amount = $withdraw_requested_amount + $withdrawal['withdraw_amount'];
							}
						}
						else
						{
							$purchase_by_account = $purchase_by_account + $withdrawal['withdraw_amount'];
						}
					}
				}
			}
			else
			{
				echo "";
			}
			//calculating add money to ewallet
			$add_money_details = $this->manage_content->getValue_twoCoditions_descending("addmoney_info","*","membership_id",$membership_id,"status",1);
			if(!empty($add_money_details[0]))
			{
				foreach($add_money_details as $add_money_detail)
				{
					$add_money = $add_money + $add_money_detail['amount'];
				}
			}
			
			echo '</tbody>';

			//showing total amount in table
			echo '<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Gross Amount: </td>
					<td>  € '.$total_amount.'</td>
				</tr>';
			
			if(!empty($withdraw_amount))
			{
				echo  '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Withdrew Amount: </td>
						<td>  € '.$withdraw_amount.'</td>
					</tr>';
			}
			
			if(!empty($withdraw_requested_amount))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Amount Requested for Withdrawal: </td>
						<td>  € '.$withdraw_requested_amount.'</td>
					</tr>';
			}
			if(!empty($purchase_by_account))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Product Purchase Amount: </td>
						<td>  € '.$purchase_by_account.'</td>
					</tr>';
			}
			if(!empty($add_money))
			{
				echo '<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="total_amount"> Add Money To ML Wallet: </td>
						<td>  € '.$add_money.'</td>
					</tr>';
			}
			if((($total_amount + $add_money) - 
			($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)) != 0)
			{
				echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Net Amount: </td>
					<td>  € '.(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)).'</td>
				</tr>';
				return (($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
			}
			else
			{
				echo '<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="total_amount"> Net Amount: </td>
					<td>  € '.(int)(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)).'</td>
				</tr>';
				return (int)(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
			}
			
		}
		
		
		/*
		 method for checking expire date
		 Auth: Dipanjan
		*/
		function checkingDate($expiry_date){
			//exploding the date to seperate year, month, date
			$date = explode("-",$expiry_date);
			//getting todays date
			$getdate = getdate();
			//checking for date expires or not
			if($date[0] > $getdate['year'])
			{
				return 1;
			}
			else if($date[0] == $getdate['year'])
			{
				if($date[1] > $getdate['mon'])
				{
					return 1;
				}
				else if($date[1] == $getdate['mon'])
				{
					if($date[2] >= $getdate['mday'])
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
		
		/*
		 method for getting category list in left sidebar
		 Auth: Dipanjan
		*/
		function getCategoryList(){
			//getting product category list from database
			$categories = $this->manage_content->getValue("product_category","*");
			//fetching them in left sidebar
			foreach($categories as $category){
				echo '<li><a href="product.php?category='.$category['category'].'">'.$category['category'].'</a></li>';
			}
		}
		
		/*
		 method for getting coupon category list in left sidebar
		 Auth: Dipanjan
		*/
		function getCouponCategoryList(){
			//getting product category list from database
			$categories = $this->manage_content->getValue("coupon_category","*");
			//fetching them in left sidebar
			foreach($categories as $category){
				echo '<li><a href="coupon.php?category='.$category['category'].'">'.$category['category'].'</a></li>';
			}
		}
		
		/*
		 method for getting coupon category list in left sidebar
		 Auth: Dipanjan
		*/
		function getMemberName($member_id){
			//getting product category list from database
			$member = $this->manage_content->getValue_where("member_table","*","membership_id",$member_id);
			return $member[0]['name'];
		}
		
		/*
		 method for getting latest product in left sidebar
		 Auth: Dipanjan
		*/
		function getLatestProducts(){
			//checking for latest category in category table
			$category = $this->manage_content->getValue_where("product_category","*","category","Novo v ponudbi");
			//checking for latest products availability
			if(!empty($category[0]) && $category[0]['status'] == 1)
			{
				//getting latest product list from database
				$latests = $this->manage_content->getValue_likely_descending("product_table","*","category","Novo v ponudbi");
				echo '<h4 class="left_container_heading"><span class="heading_text">Novo v ponudbi</span></h4>';
				//fetching them in left sidebar
				foreach($latests as $latest){
					//checking for date expiry
					$expire_date = $this->checkingDate($latest['expiration_date']);
					if($latest['status'] == 1 && $expire_date == 1)
					{
						echo '<div class="row-fluid left_container_product">
								<div class="span3"><a href="product.php?product='.$latest['product_id'].'"><img src="'.$latest['image'].'"/></a></div>
								<div class="span7 offset1">
									<p><a href="product.php?product='.$latest['product_id'].'">'.$latest['product_name'].'</a></p>
									<p class="left_container_product_amount"><a href="product.php?product='.$latest['product_id'].'"> € '.$latest['price_members'].'</a></p>
								</div>
							</div>';
					}
				}
			}
		}
		
		/*
		 method for getting custom page element
		 Auth: Dipanjan
		*/
		function getPageElement($id){
			//checking for latest category in category table
			$content = $this->manage_content->getValue_where("mypage","*","id",$id);
			//checking for latest products availability
			if(!empty($content[0]) && $content[0]['status'] == 1)
			{
				echo '<h4 class="left_container_heading"><span class="heading_text">'.$content[0]['name'].'</span></h4>
					<div class="row-fluid">'.$content[0]['content'].'</div>';
				
			}
			else
			{
				'Content Is Empty';
			}
		}
		
		/*
		 method for checking account details availability
		 Auth: Dipanjan
		*/
		function accountAvailable($membership_id){
			//getting account details of given membership id
			$account = $this->manage_content->getValue_where("member_account_details","*","membership_id",$membership_id);
			if(!empty($account[0]))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		/*
		 method for getting account details of a member
		 Auth: Dipanjan
		*/
		function updatePersonalDetails($membership_id){
			//getting account details of given membership id
			$personal_details = $this->manage_content->getValue_where("member_table","*","membership_id",$membership_id);
			//separating the address values
			$address1 =  substr($personal_details[0]['address'],0,strpos($personal_details[0]['address'],"<br>"));
			$address2 = substr($personal_details[0]['address'],strpos($personal_details[0]['address'],"<br>")+4);
			//showing the details in form
			echo '<div class="control-group">
                        <label class="control-label" id="form_label">Polno ime:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="name" id="v_f_name" 
							value="'.$personal_details[0]['name'].'">
                            <div id="err_f_name"></div>
                        </div>
                    </div>
					 <div class="control-group">
                        <label class="control-label" id="form_label">DOB:</label>
                        <div class="controls">
                            <input type="text" placeholder="" name="dob" id="calender_date" value="'.$personal_details[0]['dob'].'">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Gender:</label>
                        <div class="controls">
                            <input type="radio" name="gender" value="male"'; 
							if($personal_details[0]['gender'] == 'male') { echo 'checked="checked"'; } echo '/> Male
                            <input type="radio" name="gender" value="female"'; 
							if($personal_details[0]['gender'] == 'female') { echo 'checked="checked"'; } echo ' /> Female
                        </div>
                    </div>
					<div class="control-group">
                        <label class="control-label" id="form_label">Kontaktna št:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="contact_no" id="v_contact_no" 
							value="'.$personal_details[0]['contact_no'].'">
                            <div id="err_cntct"></div>
                        </div>
                    </div>
					<div class="control-group">
                        <label class="control-label" id="form_label">Naslov 1:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="address1" id="v_address" 
							value="'.$address1.'">
                            <div id="err_address"></div>
                        </div>
                    </div>
					<div class="control-group">
                        <label class="control-label" id="form_label">Naslov 2:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="address2" 
							value="'.$address2.'">
                        </div>
                    </div>
					<div class="control-group">
                        <label class="control-label" id="form_label">Mesto:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="city" 
							value="'.$personal_details[0]['city'].'">
                        </div>
                    </div>
					<div class="control-group">
                        <label class="control-label" id="form_label">Poštna številka:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="postal_code" 
							value="'.$personal_details[0]['postal_code'].'">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Država:</label>
                        <div class="controls">
                        	<select name="country_id" id="signup_country">';
							if(!empty($personal_details[0]['country']))
							{
								$this->getCountryList($personal_details[0]['country']);
							}
						echo '</select>
                        </div>
                    </div>
					<div class="control-group">
                        <label class="control-label" id="form_label">Regija/država:</label>
                        <div class="controls">
                        	<select name="state_id" id="signup_state">';
							if(!empty($personal_details[0]['state']))
							{
								$this->getStateList($personal_details[0]['state']);
							}
						echo '</select>
                        </div>
                    </div>
					<div class="control-group">
                        <div class="controls">
                        	<input type="hidden" name="membership_id" value="'.$membership_id.'">
                            <input type="submit" class="btn btn-inverse btn-large" id="btn_submit" value="PREDLOŽI">
                        </div>
                    </div>';
		}
		
		/*
		 method for getting account details of a member
		 Auth: Dipanjan
		*/
		function getAccountDetails($membership_id){
			//getting account details of given membership id
			$account = $this->manage_content->getValue_where("member_account_details","*","membership_id",$membership_id);
			//showing the details in form
			echo  '<div class="control-group">
                        <label class="control-label" id="form_label">A/C Holder Name:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Account Holder Name" name="ac_name" id="update_ac_name" 
							value="'.$account[0]['ac_name'].'">
                            <div id="err_update_ac_name"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">A/C Number:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Account Number" name="ac_no" id="update_ac_no" 
							value="'.$account[0]['ac_no'].'">
                            <div id="err_update_ac_no"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Bank Name:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Bank Name" name="bank" id="update_bank" 
							value="'.$account[0]['bank'].'">
                            <div id="err_update_bank"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Branch Name:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Branch Name" name="branch" id="update_branch" 
							value="'.$account[0]['branch'].'">
                            <div id="err_update_branch"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Tax Number:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Tax Number" name="ifsc_code" id="v-ifsc_code" 
							value="'.$account[0]['ifsc_code'].'">
                            <div id="err_f_name"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                        	<input type="hidden" name="membership_id" value="'.$membership_id.'">
                            <input type="button" class="btn btn-inverse btn-large" id="btn_submit" value="POSODOBITEV" onclick="validiateUpdateAccountForm()">
                        </div>
                    </div>';
		}
		
		/*
		 method for getting footer element
		 Auth: Dipanjan
		*/
		function getFooterLinks($column_name){
			//getting footer links from database
			$footer_links = $this->manage_content->getValue_twoCoditions("footer_content","*",$column_name,1,"status",1);
			//checking for empty result
			if(!empty($footer_links))
			{
				foreach($footer_links as $footer_link){
					echo '<li class="footerLinks"><a href="'.$footer_link['link'].'">'.$footer_link['name'].'</a></li>';
				}
			}
			else
			{
				echo '';
			}
		}
		
		/*
		 method for getting footer bottom text
		 Auth: Dipanjan
		*/
		function getFooterBottomText(){
			//getting footer links from database
			$footer_text = $this->manage_content->getValue_twoCoditions("footer_content","*","name","bottom_text","status",1);
			//checking for empty result
			if(!empty($footer_text))
			{
				echo $footer_text[0]["bottom_text"];
			}
			else
			{
				echo '';
			}
		}
		
		/*
		 method for getting invalid conditions
		 Auth: Dipanjan
		*/
		function getInvalidConditions($membership_id){
			//getting footer links from database
			$member = $this->manage_content->getValue_where("member_table","*","membership_id",$membership_id);
			//fetching the membership invalid conditions
			return array($member[0]['membership_validiation'],$member[0]['membership_activation']);
		}
		
		/*
		 method for getting invalid member text
		 Auth: Dipanjan
		*/
		function getInvalidMemberContent($invalid_condition){
			//getting footer links from database
			$invalid = $this->manage_content->getValue_where("invalid_member_content","*","id",$invalid_condition);
			//fetching the membership invalid text
			echo '<p>'. $invalid[0]['description'].'</p>';
		}
		
		/*
		 method for getting members a/c details
		 Auth: Dipanjan
		*/
		function getMembersAccountDetails($membership_id){
			//getting footer links from database
			$member = $this->manage_content->getValue_where("member_account_details","*","membership_id",$membership_id);
			//checking for fields are empty or not
			if(!empty($member[0]['ac_no']) && !empty($member[0]['ac_name']))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		/*
		 method for getting country list
		 Auth: Dipanjan
		*/
		function getCountryList($country_name){
			//getting value from database
			$country_list = $this->manage_content->getValue_where("country","*","status",1);
			if(!empty($country_list[0]))
			{
				foreach($country_list as $country)
				{
					if($country['name'] == $country_name)
					{
						echo '<option value="'.$country['name'].'" selected="selected">'.$country['name'].'</option>';
					}
					else
					{
						echo '<option value="'.$country['name'].'">'.$country['name'].'</option>';
					}
				}
			}
		}
		
		/*
		 method for getting state list
		 Auth: Dipanjan
		*/
		function getStateList($state_name){
			//getting value from database
			if(!empty($state_name))
			{
				$zone_list = $this->manage_content->getValue_twoCoditions("zone","*","status",1,"name",$state_name);
			}
			else
			{
				$zone_list = $this->manage_content->getValue_twoCoditions("zone","*","status",1,"country_id",190);
			}
			
			if(!empty($zone_list[0]))
			{
				foreach($zone_list as $zone)
				{
					echo '<option value="'.$zone['name'].'">'.$zone['name'].'</option>';
					
				}
			}
		}
		
		/*
		 method for getting state list of given country name
		 Auth: Dipanjan
		*/
		function getStateListOfCountry($country_name){
			//getting value from database
			$country_id = $this->manage_content->getValue_where("country","*","name",$country_name);
			//getting state list
			$state_list = $this->manage_content->getValue_where("zone","*","country_id",$country_id[0]['country_id']);
			foreach($state_list as $state)
			{
				echo '<option value="'.$state['name'].'">'.$state['name'].'</option>';
			}
		}
		
		/*
		 method for modifying date format
		 Auth: Dipanjan
		*/
		function changeDateFormat($input_date){
			//separating the day month year
			$date = explode("-",$input_date);
			//return date as dd-mm-yyyy format
			$return_date = $date[2]."-".$date[1]."-".$date[0];
			return $return_date;
		}
		
		/*
		 method for getting money details for header
		 Auth: Dipanjan
		*/
		function getMoneyDetails($membership_id){
			//checking for member validiation
			$member_valid = $this->getInvalidConditions($membership_id);
			if($member_valid[1] == 0)
			{
				/* For My Wallet Money */
				
				//getting all transaction of a member
				$transaction = $this->manage_content->
				getValue_twoCoditions_descending("money_transfer_log","*","membership_id",$membership_id,"frozen_money",0);
				
				//initialize a variable for total amount calculation
				$total_amount = 0;
				$withdraw_amount = 0;
				$withdraw_requested_amount = 0;
				$purchase_by_account = 0;
				$net_amount = 0;
				$add_money = 0;
				$my_wallet_amount = 0;
				if(count($transaction[0]) > 0)
				{ 
					foreach($transaction as $transactions){
						//checking for only debited amount
						if(!empty($transactions['debit']))
						{
							// total amount calculation
							$total_amount = $total_amount + $transactions['debit'];
						}
					}
					//getting the withdrawal amount from database
					$withdraws = $this->manage_content->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",0);
					//getting the amount withdrawal to that member
					if(!empty($withdraws[0]))
					{
						foreach($withdraws as $withdrawal)
						{
							if(substr($withdrawal['withdraw_order_id'],0,8) == 'withdraw')
							{
								//checking for status of money transfer
								if($withdrawal['status'] == 1)
								{
									$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
								}
								//checking for requested amount
								else
								{
									$withdraw_requested_amount = $withdraw_requested_amount + $withdrawal['withdraw_amount'];
								}
							}
							else
							{
								$purchase_by_account = $purchase_by_account + $withdrawal['withdraw_amount'];
							}
						}
					}
				}
				//calculating add money to ewallet
				$add_money_details = $this->manage_content->getValue_twoCoditions_descending("addmoney_info","*","membership_id",$membership_id,"status",1);
				if(!empty($add_money_details[0]))
				{
					foreach($add_money_details as $add_money_detail)
					{
						$add_money = $add_money + $add_money_detail['amount'];
					}
				}
				
				if((($total_amount + $add_money) - 
				($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)) != 0)
				{
					$my_wallet_amount = (($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
				}
				else
				{
					$my_wallet_amount = (int)(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
				}
				
				/* For Potential Money */
				
				//getting all transaction of a member
				$transaction_po = $this->manage_content->getValue_twoCoditions("money_transfer_log","*","membership_id","potentialMoney","notes",$membership_id); 
				
				//initialize a variable for total amount calculation
				$total_po_amount = 0;
				$potential_money = 0;
				if(count($transaction_po[0]) > 0)
				{
					foreach($transaction_po as $transactions_po){
						//checking for only debited amount
						if(!empty($transactions_po['debit']))
						{	
							// total amount calculation
							$total_po_amount = $total_po_amount + $transactions_po['debit'];
						}
					}
				}
				
				//checking from invalid potential money table
				$invalid_potentials = $this->manage_content->getValue_where("invalid_potential_money","*","membership_id",$membership_id);
				if(!empty($invalid_potentials[0]))
				{
					foreach($invalid_potentials as $invalid_potential)
					{
						// total amount calculation
						$total_po_amount = $total_po_amount + $invalid_potential['amount'];
					}
				}
				
				if($total_po_amount != 0)
				{
					$potential_money = $total_po_amount;
				}
				else
				{
					$potential_money = (int)$total_po_amount;
				}
				return array($my_wallet_amount,$potential_money);
				//echo '€ '.$my_wallet_amount.'/ € '.$potential_money;
				
			}
			else if($member_valid[1] == 1)
			{
				/* For My Wallet Money */
				
				//getting all transaction of a member
				$transaction = $this->manage_content->
				getValue_twoCoditions_descending("money_transfer_log","*","membership_id",$membership_id,"frozen_money",0);
				
				//initialize a variable for total amount calculation
				$total_amount = 0;
				$withdraw_amount = 0;
				$withdraw_requested_amount = 0;
				$purchase_by_account = 0;
				$net_amount = 0;
				$add_money = 0;
				$my_wallet_amount = 0;
				if(count($transaction[0]) > 0)
				{ 
					foreach($transaction as $transactions){
						//checking for only debited amount
						if(!empty($transactions['debit']))
						{
							// total amount calculation
							$total_amount = $total_amount + $transactions['debit'];
						}
					}
					//getting the withdrawal amount from database
					$withdraws = $this->manage_content->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",0);
					//getting the amount withdrawal to that member
					if(!empty($withdraws[0]))
					{
						foreach($withdraws as $withdrawal)
						{
							if(substr($withdrawal['withdraw_order_id'],0,8) == 'withdraw')
							{
								//checking for status of money transfer
								if($withdrawal['status'] == 1)
								{
									$withdraw_amount = $withdraw_amount + $withdrawal['withdraw_amount'];
								}
								//checking for requested amount
								else
								{
									$withdraw_requested_amount = $withdraw_requested_amount + $withdrawal['withdraw_amount'];
								}
							}
							else
							{
								$purchase_by_account = $purchase_by_account + $withdrawal['withdraw_amount'];
							}
						}
					}
				}
				//calculating add money to ewallet
				$add_money_details = $this->manage_content->getValue_twoCoditions_descending("addmoney_info","*","membership_id",$membership_id,"status",1);
				if(!empty($add_money_details[0]))
				{
					foreach($add_money_details as $add_money_detail)
					{
						$add_money = $add_money + $add_money_detail['amount'];
					}
				}
				
				if((($total_amount + $add_money) - 
				($withdraw_requested_amount + $purchase_by_account + $withdraw_amount)) != 0)
				{
					$my_wallet_amount = (($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
				}
				else
				{
					$my_wallet_amount = (int)(($total_amount + $add_money) - ($withdraw_requested_amount + $purchase_by_account + $withdraw_amount));
				}
				
				
				/* Ewallet frozen money */
				//getting all transaction of a member
				$transaction = $this->manage_content->
				getValue_twoCoditions_descending("money_transfer_log","*","membership_id",$membership_id,"frozen_money",1);
				
				//initialize a variable for total amount calculation
				$vip_total_amount = 0;
				$vip_withdraw_amount = 0;
				$vip_withdraw_requested_amount = 0;
				$vip_total_frozen_money = 0;
				if(count($transaction[0]) > 0)
				{
					
					foreach($transaction as $transactions){
						//checking for only debited amount
						if(!empty($transactions['debit']))
						{	
							// total amount calculation
							$vip_total_amount = $vip_total_amount + $transactions['debit'];
						}
					}
					//getting the withdrawal amount from database
					$withdraws = $this->manage_content->getValue_twoCoditions("withdraw_log","*","membership_id",$membership_id,"frozen_money",1);
					//getting the amount withdrawal to that member
					if(!empty($withdraws[0]))
					{
						foreach($withdraws as $withdrawal)
						{
							//checking for status of money transfer
							if($withdrawal['status'] == 1)
							{
								$vip_withdraw_amount = $vip_withdraw_amount + $withdrawal['withdraw_amount'];
							}
							//checking for requested amount
							else
							{
								$vip_withdraw_requested_amount = $vip_withdraw_requested_amount + $withdrawal['withdraw_amount'];
							}
						}
					}
				}
				
				if(($vip_total_amount - ($vip_withdraw_requested_amount + $vip_withdraw_amount)) != 0)
				{
					$vip_total_frozen_money = ($vip_total_amount - ($vip_withdraw_requested_amount + $vip_withdraw_amount));
				}
				else
				{
					$vip_total_frozen_money = (int)($vip_total_amount - ($vip_withdraw_requested_amount + $vip_withdraw_amount));
				}
				return array($my_wallet_amount,$vip_total_frozen_money);
				//echo '€ '.$my_wallet_amount.'/ € '.$total_frozen_money;
			}
		}
	
	}
	
?>