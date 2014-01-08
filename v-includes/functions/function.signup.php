<?php
    session_start();
	//include the DAL library to use the model layer methods
	include '../class.DAL.php'; 
	//creating object of DAL
	$managedata = new ManageContent_DAL();
    
    
    //include the mail class to send the mails to new sign up
	include '../class.mail.php';
    $mail = new Mail();
	//getting cookies value set
	if($GLOBALS['_COOKIE']['membership'] == 1)
	{
		$cookie = $GLOBALS['_COOKIE'];
		//checking the key word 'M_' for finding the selected product
		foreach($cookie as $key => $value){
			if(substr($key,10,2) == "M_")
			{
				//extracting the product id
				$membership_product_id = substr($key,10);
			}
		}
		//checking that membership product is selected or not
		if(!empty($membership_product_id))
		{
			//getting values from signup page
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$firstname = $_POST['f_name'];
				$lastname = $_POST['l_name'];
				$email_id = $_POST['email_id'];
				$contact_no = $_POST['contact_no'];
				$Senior_id = $_POST['Senior_id'];
				$address1 = $_POST['address1'];
				$address2 = $_POST['address2'];
				$city = $_POST['city'];
				$postal_code = $_POST['postal_code'];
				$state = $_POST['state'];
				$country = $_POST['country'];
				$password = $_POST['password'];
				$confirm_password = $_POST['confirm_password'];
			}
			//checking for same password
			if($password == $confirm_password)
			{
				//checking for valid email id
				$all_email_id = $managedata->getValue_where("member_table","*","email_id",$email_id);
				if(empty($all_email_id[0]))
				{
					//checking for valid senior id
					$valid_senior_id = $managedata->getValue_where("member_table","*","membership_id",$Senior_id);
					if(!empty($valid_senior_id[0]['membership_id']))
					{
						//make the name,address by concatening f_name,l_name AND address1, address2
						$name = $firstname." ".$lastname;
						$address = $address1."<br>".$address2;
						
						//creting memebership id using unique id with prefix member
						$membership_id = uniqid('member');
						
						//getting current date/time and expiration date
						$getdate = getdate();
						$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
						$expiration_date = date('Y-m-d', strtotime('+1 years'));
						
						//make membership_id as username of the user
						$username = $email_id;
						
						//inserting values in member_table
						$result = $managedata->insertMember($name,$email_id,$contact_no,$address,$city,$postal_code,$state,$country,$username,$password,$membership_id,$date,$expiration_date);
						
						//inserting membership id in mlm_table
						$result_mlm = $managedata->insertMembershipId($membership_id,$date);
						
						//checking for valid senior membership id
						if(isset($Senior_id) && !empty($Senior_id) && $result_mlm == 1)
						{
							//finding id value of memberdhip_id
							$member_id = $managedata->getValue_where("mlm_info","id","membership_id",$membership_id);
							//getting child ids of senior id
							$child_id = $managedata->getValue_where("mlm_info","*","membership_id",$Senior_id);
							//update parent id value of new member
							if(!empty($child_id[0]['id']))
							{
								$update_parent_id = $managedata->updateValueWhere("mlm_info","parent_id",$child_id[0]['id'],"membership_id",$membership_id);
							}
							//adding child id value
							if($child_id[0]['child_id'] != "")
							{
								$new_child_id = $child_id[0]['child_id'].",".$member_id[0]['id'];
							}
							else
							{
								$new_child_id = $member_id[0]['id'];
							}
							//update child_id value of senior member
							$update_child_id = $managedata->updateValueWhere("mlm_info","child_id",$new_child_id,"membership_id",$Senior_id);
							
						}
						
						$_SESSION['memberId'] = $membership_id;
						$mail->getDataForRegistration($email_id,$membership_id);
						//to purchase the membership product	
						header("Location: ../../view_cart.php");
					}
					else
					{
						$message = "Senior Id Does Not Exists";
						header("Location: ../../sign_up.php?msg=".$message);
					}
					
				}
				else
				{
					$message = "Email Id Exists,Register With Different Email ID";
					header("Location: ../../sign_up.php?msg=".$message);
				}
			}
			else
			{
				$message = "Password fields are not matched";
				header("Location: ../../sign_up.php?msg=".$message);
			}
			
		}
		else
		{
			$message = "Select Atleast One Product For Membership";
			header("Location: ../../sign_up.php?msg=".$message);
		}
	}
	else
	{
		$message = "Select Atleast One Product For Membership";
		header("Location: ../../sign_up.php?msg=".$message);
	}
	
?>