<?php
    session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
    
    
    //include the mail class to send the mails to new sign up
	include '../../../v-includes/class.mail.php';
    $mail = new Mail();
		
	//getting values from signup page
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$firstname = $_POST['f_name'];
		$lastname = $_POST['l_name'];
		$email_id = $_POST['email_id'];
		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
		$contact_no = $_POST['contact_no'];
		$Senior_id = $_POST['Senior_id'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$postal_code = $_POST['postal_code'];
		$state = $_POST['state_id'];
		$country = $_POST['country_id'];
		$password = $_POST['password'];
	}
	
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
	$result = $managedata->insertMember($name,$email_id,$dob,$gender,$contact_no,$address,$city,$postal_code,$state,$country,$username,$password,$membership_id,$date,$expiration_date);
	
	//inserting membership id in mlm_table
	$result_mlm = $manageData->insertMembershipId($membership_id,$date);
	
	//checking for valid senior membership id
	if(isset($Senior_id) && !empty($Senior_id) && $result_mlm == 1)
	{
		//finding id value of memberdhip_id
		$member_id = $manageData->getValueWhere("mlm_info","id","membership_id",$membership_id);
		//getting child ids of senior id
		$child_id = $manageData->getValueWhere("mlm_info","*","membership_id",$Senior_id);
		//update parent id value of new member
		if(!empty($child_id[0]['id']))
		{
			$update_parent_id = $manageData->updateValueWhere("mlm_info","parent_id",$child_id[0]['id'],"membership_id",$membership_id);
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
		$update_child_id = $manageData->updateValueWhere("mlm_info","child_id",$new_child_id,"membership_id",$Senior_id);
		
	}
	
	$_SESSION['memberId'] = $membership_id;
	$mail->getDataForRegistration($email_id,$membership_id);
	//update membership activation field
	//$update_field = $manageData->updateValueWhere("member_table","membership_activation",1,"membership_id",$membership_id);
		
	header("Location: ../../addFreeMember.php");
		
	
	
?>