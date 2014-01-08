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
		$heading1 = $_POST['heading1'];
		$description1 = $_POST['description1'];
		$heading2 = $_POST['heading2'];
		$description2 = $_POST['description2'];
		$heading3 = $_POST['heading3'];
		$description3 = $_POST['description3'];
		$photo1 = $_FILES['photo1']['name'];
		$photo2 = $_FILES['photo2']['name'];
		$photo3 = $_FILES['photo3']['name'];
	}
	
	if(!empty($photo1))
	{
		//1st other image upload
		$result_upload_1st = $uploadFile->upload_file('slider_1st','photo1','../../../img/');
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
		$result_upload_2nd = $uploadFile->upload_file('slider_2nd','photo2','../../../img/');
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
		$result_upload_3rd = $uploadFile->upload_file('slider_3rd','photo3','../../../img/');
		//photo_name variable saves the image location
		$photo_name3 = "img/".$result_upload_3rd;
	}
	else
	{
		$photo_name3 = "";
	}
	
	//updating the selected values
	if(isset($heading1))
	{
		$result = $manageData->updateValueWhere("slider_content","heading",$heading1,"id",1);	
	}
	
	if(isset($description1))
	{
		$result = $manageData->updateValueWhere("slider_content","description",$description1,"id",1);	
	}
	
	if(isset($photo_name1) && !empty($photo_name1))
	{
		$result = $manageData->updateValueWhere("slider_content","image",$photo_name1,"id",1);	
	}
	
	if(isset($heading2))
	{
		$result = $manageData->updateValueWhere("slider_content","heading",$heading2,"id",2);	
	}
	
	if(isset($description2))
	{
		$result = $manageData->updateValueWhere("slider_content","description",$description2,"id",2);	
	}
	
	if(isset($photo_name2) && !empty($photo_name2))
	{
		$result = $manageData->updateValueWhere("slider_content","image",$photo_name2,"id",2);	
	}
	
	if(isset($heading3))
	{
		$result = $manageData->updateValueWhere("slider_content","heading",$heading3,"id",3);	
	}
	
	if(isset($description3))
	{
		$result = $manageData->updateValueWhere("slider_content","description",$description3,"id",3);	
	}
	
	if(isset($photo_name3) && !empty($photo_name3))
	{
		$result = $manageData->updateValueWhere("slider_content","image",$photo_name3,"id",3);	
	}
	
	header("Location: ../../editSliderContent.php");
?>