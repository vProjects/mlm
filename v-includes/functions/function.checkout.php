<?php 
        session_start();
		include('../BLL.getData.php');
		
		$bllGetData = new BLL_manageData();
        /* array which will store the cart values provided by the user this will help us to manipulate the values if a user has incremented
         * the cart values by changing the functions of js_cart.js
         */
         
         $userArray = array();
         
         
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$userCart = $GLOBALS['_COOKIE'];
			checkCart($userCart,$bllGetData,$userArray);
		}
		
		function checkCart($userCart,$bllGetData,$userArray){
		    
            $queryString = '';  //string will be used to do db query
            
		    //checks whether the usercart is filled or not, this step is for malicious request done on this page
			if($userCart['cart_is_selected'] == 'yes' && count($userCart) >3){
			    
                foreach($userCart as $key=>$userProduct){
                        if(substr($key, 0, 10) == 'no_product'){
                            
                            /* pushes only those values which is in the cart
                             * in the format of 
                             * $userArray = Array
                                (
                                    [0] => no_productP_001
                                    [1] => 1
                                    [2] => no_productP_002
                                    [3] => 1
                                    [4] => no_productP_003
                                    [5] => 7
                                )
                             */ 
                            
                            array_push($userArray, $key,$userProduct );
                            
                            // creates the ('P_001','P_002') structure of string to do db call 
                            $queryString =  $queryString.','.'\''.substr($key, 10, 15).'\'';
                        }
						
                    } //foreach ends here 
                    // getting the actual maximum limit of choosing a product from the database 
                    $actualMaxpick = $bllGetData->getmaxpick($queryString);
                    
                    $i = 1;
                    // checking all maximum selecting limits from the users entered data
                    
					if(!empty($actualMaxpick)){ 
						foreach ($actualMaxpick as $key => $value) {
							if($value['maxpick'] >= $userArray[$i]){
								
								header('Location: ../../check_out.php');
							}
							else {
								header('Location: ../../view_cart.php?record=cart value changed');
							}
							$i = $i+2;
						}
					}
					else
					{
						header('Location: ../../check_out.php');
					}
                    
			}
			else{
				header('Location: ../../view_cart.php?value=no product in cart');
			}
		}



?>