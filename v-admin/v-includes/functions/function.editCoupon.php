<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//include the library for uploading the files
	include('../library/class.upload_file.php');
	$uploadFile = new FileUpload();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$coupon_id = $_POST['coupon_id'];
		$coupon_name = $_POST['coupon_name'];
		$description = $_POST['description'];
		$references = $_POST['references'];
		$coupon_code = $_POST['coupon_code'];
		$old_price = $_POST['old_price'];
		$price_guest = $_POST['price_guest'];
		$price_members = $_POST['price_members'];
		$tax = $_POST['tax'];
		$discount = $_POST['discount'];
		$stock = $_POST['stock'];
		$expiration_date = $_POST['expiration_date'];
		$maxpick = $_POST['maxpick'];
		$photo = $_FILES['photo']['name'];
		$photo1 = $_FILES['photo1']['name'];
		$photo2 = $_FILES['photo2']['name'];
		$photo3 = $_FILES['photo3']['name'];
		$photo4 = $_FILES['photo4']['name'];
	}
	//varriable which will contain the category in string format
	$category_string = ""; 
	
	if(!empty($GLOBALS['_POST']['category']) && isset($GLOBALS['_POST']['category']))
	{
		$category = $GLOBALS['_POST']['category'];
		if( $category != "" )
		{
			//convert array to string seperated by commas
			foreach($category as $cate)
			{
				$category_string = $category_string.",".$cate ;
			}
		}
		/*
		- remove the first word from the $category_string sa it
		- it contains a comma
		*/
		
		$category_string = substr($category_string,1);
	}
	
	//fetching the id value of database
	$table_id = $manageData->getValueWhere("coupon_table","id","coupon_id",$coupon_id);
	$id = $table_id[0]['id'];
	
	//updating the selected values
	if(isset($coupon_name))
	{
		$result = $manageData->updateValueWhere("coupon_table","coupon_name",$coupon_name,"id",$id);	
	}
	
	if(isset($category_string) && !empty($category_string))
	{
		$result = $manageData->updateValueWhere("coupon_table","category",$category_string,"id",$id);	
	}
	
	if(isset($description))
	{
		$result = $manageData->updateValueWhere("coupon_table","coupon_description",$description,"id",$id);	
	}
	
	if(isset($references))
	{
		$result = $manageData->updateValueWhere("coupon_table","references",$references,"id",$id);	
	}
	
	if(isset($coupon_code))
	{
		$result = $manageData->updateValueWhere("coupon_table","coupon_code",$coupon_code,"id",$id);	
	}
	
	if(isset($price_guest))
	{
		$result = $manageData->updateValueWhere("coupon_table","price_guest",$price_guest,"id",$id);	
	}
	
	if(isset($old_price))
	{
		$result = $manageData->updateValueWhere("coupon_table","old_price",$old_price,"id",$id);	
	}
	
	if(isset($price_members))
	{
		$result = $manageData->updateValueWhere("coupon_table","price_members",$price_members,"id",$id);	
	}
	
	if(isset($tax))
	{
		$result = $manageData->updateValueWhere("coupon_table","tax",$tax,"id",$id);	
	}
	
	if(isset($discount))
	{
		$result = $manageData->updateValueWhere("coupon_table","discount",$discount,"id",$id);	
	}
	
	if(isset($stock))
	{
		$result = $manageData->updateValueWhere("coupon_table","stock",$stock,"id",$id);
	
		if($stock > 5)
		{
			$result = $manageData->updateValueWhere("coupon_table","status",1,"id",$id);
		}
		else
		{
			$result = $manageData->updateValueWhere("coupon_table","status",0,"id",$id);
		}
	}
	
	if(isset($expiration_date) && $expiration_date != "")
	{
		$result = $manageData->updateValueWhere("coupon_table","expiration_date",$expiration_date,"id",$id);	
	}
	
	if(isset($maxpick))
	{
		$result = $manageData->updateValueWhere("coupon_table","maxpick",$maxpick,"id",$id);	
	}
	
	if(!empty($photo))
	{
		//move the uploaded file to the UI Layer img folder of main image
		$result_upload = $uploadFile->upload_file($coupon_id,'photo','../../../img/');
		//photo_name variable saves the image location
		$photo_name = "img/".$result_upload;
		$result = $manageData->updateValueWhere("coupon_table","image",$photo_name,"id",$id);
	}
	if(!empty($photo1))
	{
		//1st other image upload
		$result_upload_1st = $uploadFile->upload_file($coupon_id.'_1st','photo1','../../../img/');
		//photo_name variable saves the image location
		$photo_name1 = "img/".$result_upload_1st;
		$result = $manageData->updateValueWhere("coupon_table","image1",$photo_name1,"id",$id);
	}
	if(!empty($photo2))
	{
		//2nd other image upload
		$result_upload_2nd = $uploadFile->upload_file($coupon_id.'_2nd','photo2','../../../img/');
		//photo_name variable saves the image location
		$photo_name2 = "img/".$result_upload_2nd;
		$result = $manageData->updateValueWhere("coupon_table","image2",$photo_name2,"id",$id);
	}
	if(!empty($photo3))
	{
		//3rd other image upload
		$result_upload_3rd = $uploadFile->upload_file($coupon_id.'_3rd','photo3','../../../img/');
		//photo_name variable saves the image location
		$photo_name3 = "img/".$result_upload_3rd;
		$result = $manageData->updateValueWhere("coupon_table","image3",$photo_name3,"id",$id);
	}
	if(!empty($photo4))
	{
		//4th other image upload
		$result_upload_4th = $uploadFile->upload_file($coupon_id.'_4th','photo4','../../../img/');
		//photo_name variable saves the image location
		$photo_name4 = "img/".$result_upload_4th;	
		$result = $manageData->updateValueWhere("coupon_table","image4",$photo_name4,"id",$id);
	}
	
	header("Location: ../../listCoupon.php");
?>