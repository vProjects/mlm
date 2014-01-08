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
		$price = $_POST['price'];
		$discount = $_POST['discount'];
		$stock = $_POST['stock'];
		$photo = $_FILES['photo']['name'];
	}
	/* creating product id for new product */
	//getting last value of product id
	$p_id = $manageData->getLastValue("membership_product","product_id","product_id");
	if($p_id[0]['product_id'] != "")
	{
		//setting the new product id increamented by 1
		$new_p_id = (substr($p_id[0]['product_id'],2) + 1);
		//product id for new product
		$product_id = "M_".$new_p_id;
	}
	else
	{
		$product_id = "M_1001";
	}
	/* product id is set*/	
	
	if(!empty($photo))
	{
		//move the uploaded file to the UI Layer img folder
		$result_upload = $uploadFile->upload_file($product_id,'photo','../../../img/');
		//photo_name variable saves the image location.
		$photo_name = "img/".$result_upload;
	}
	else
	{
		$photo_name = "";
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
	
	//discount is set or not
	if(!empty($discount))
	{
		$result = $manageData->insertMembershipProduct($product_id,$product_name,$description,$price,$discount,$stock,$status,$photo_name);
		
		header("Location: ../../addMembershipProduct.php?msg=1010");
	}
	else
	{
		header("Location: ../../addMembershipProduct.php?msg=9874");
	}
	
?>