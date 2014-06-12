<?php

    session_start();
    //include the DAL library for the method to insert the details
    include('../library/library.DAL.php');
    $manageData = new manageContent_DAL();
    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $status = 1;
        $pageName = $_POST['category'];
        $pageContent = $_POST['description'];
        $insertPage = $manageData->insertPage($pageName,$pageContent,$status);
    }
	header("Location: ../../mypage.php");

?>