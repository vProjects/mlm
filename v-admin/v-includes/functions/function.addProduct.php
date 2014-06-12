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
		$product_name = $_POST['product_name'];
		$description = $_POST['description'];
		$references = $_POST['references'];
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
	/* creating product id for new product */
	//getting last value of product id
	$p_id = $manageData->getLastValue("product_table","product_id","product_id");
	if($p_id[0]['product_id'] != "")
	{
		//setting the new product id increamented by 1
		$new_p_id = (substr($p_id[0]['product_id'],2) + 1);
		//product id for new product
		$product_id = "P_".$new_p_id;
	}
	else
	{
		$product_id = "P_1001";
	}
	/* product id is set*/	
		
	//getting current date/time
	$getdate = getdate();
	$date = $getdate['year']."-".$getdate['mon']."-".$getdate['mday'];
	//move the uploaded file to the UI Layer img folder of main image
	$result_upload = $uploadFile->upload_file($product_id,'photo','../../../img/');
	//photo_name variable saves the image location
	$photo_name = "img/".$result_upload;
	if(!empty($photo1))
	{
		//1st other image upload
		$result_upload_1st = $uploadFile->upload_file($product_id.'_1st','photo1','../../../img/');
		//photo_name variable saves the image location
		$photo_name1 = "img/".$result_upload_1st;	
	}
	else
	{
		$photo_name1 = "";
	}
	if(!empty($photo2))
	{
		//2nd other image upload
		$result_upload_2nd = $uploadFile->upload_file($product_id.'_2nd','photo2','../../../img/');
		//photo_name variable saves the image location
		$photo_name2 = "img/".$result_upload_2nd;
	}
	else
	{
		$photo_name2 = "";
	}
	if(!empty($photo3))
	{
		//3rd other image upload
		$result_upload_3rd = $uploadFile->upload_file($product_id.'_3rd','photo3','../../../img/');
		//photo_name variable saves the image location
		$photo_name3 = "img/".$result_upload_3rd;
	}
	else
	{
		$photo_name3 = "";
	}
	if(!empty($photo4))
	{
		//4th other image upload
		$result_upload_4th = $uploadFile->upload_file($product_id.'_4th','photo4','../../../img/');
		//photo_name variable saves the image location
		$photo_name4 = "img/".$result_upload_4th;	
	}
	else
	{
		$photo_name4 = "";
	}
	/*checking the number of product is more than '5' or not
	* setting the database value for stock column
	*/
	if($stock > 5)
	{
		$status = 1;
	}
	else
	{
		$status = 0;
	}
	//varriable which will contain the category in string format
	$category_string = ""; 
	
	if(!empty($GLOBALS['_POST']['category']) && $GLOBALS['_POST'] > 0)
	{
		$category = $GLOBALS['_POST']['category'];
		//convert array to string seperated by commas
		foreach($category as $cate)
		{
			$category_string = $category_string.",".$cate ;
		}
		/*
		- remove the first word from the $category_string sa it
		- it contains a comma
		*/
		
		$category_string = substr($category_string,1);
	}
	
	//discount is set or not
	if(!empty($discount))
	{
		//insert values in product table
		$result = $manageData->insertProduct($product_id,$category_string,$product_name,$description,$references,$old_price,$price_guest,$price_members,$tax,$discount,$stock,$date,$expiration_date,$maxpick,$status,$photo_name,$photo_name1,$photo_name2,$photo_name3,$photo_name4);
		
		if($result == 1)
		{
			header("Location: ../../addProduct.php?msg=1111");
		}
		else if($result == 0)
		{
			header("Location: ../../addProduct.php?msg=7777");
		}
	}
	else
	{
		header("Location: ../../addProduct.php?msg=9999");
	}
	
?>