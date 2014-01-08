<?php
	session_start();
	//include the DAL library for the method to insert the details
	include('../library/library.DAL.php');
	$manageData = new manageContent_DAL();
	//taking the values from form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$product_id = $_POST['product_id'];
		$product_name = $_POST['product_name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$discount = $_POST['discount'];
		$stock = $_POST['stock'];
	}
	
	//fetching the id value of database
	$table_id = $manageData->getValueWhere("membership_product","id","product_id",$product_id);
	$id = $table_id[0]['id'];
	
	//updating the selected values
	if(isset($product_name))
	{
		$result = $manageData->updateValueWhere("membership_product","product_name",$product_name,"id",$id);	
	}
	
	if(isset($description))
	{
		$result = $manageData->updateValueWhere("membership_product","product_description",$description,"id",$id);	
	}
	
	if(isset($price))
	{
		$result = $manageData->updateValueWhere("membership_product","price",$price,"id",$id);	
	}
	
	if(isset($discount))
	{
		$result = $manageData->updateValueWhere("membership_product","discount",$discount,"id",$id);	
	}
	
	if(isset($stock))
	{
		$result = $manageData->updateValueWhere("membership_product","stock",$stock,"id",$id);
		
		if($stock > 5)
		{
			$result = $manageData->updateValueWhere("membership_product","status",1,"id",$id);
		}
		else
		{
			$result = $manageData->updateValueWhere("membership_product","status",0,"id",$id);
		}	
	}
	
	
	header("Location: ../../membershipProductList.php");
?>