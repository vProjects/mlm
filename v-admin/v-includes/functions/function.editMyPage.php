<?php

    session_start();
    //include the DAL library for the method to insert the details
    include('../library/library.DAL.php');
    $manageData = new manageContent_DAL();
    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $page_id = $_POST['id'];
		$pageName = $_POST['category'];
        $pageContent = $_POST['description'];
    }
	
	if(isset($pageName))
	{
		$result = $manageData->updateValueWhere("mypage","name",$pageName,"id",$page_id);
	}
	
	if(isset($pageContent))
	{
		$result = $manageData->updateValueWhere("mypage","content",$pageContent,"id",$page_id);
	}
	
	header("Location: ../../listmypage.php");

?>