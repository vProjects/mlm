<?php

    session_start();
    //include the DAL library for the method to insert the details
    include('../library/library.DAL.php');
    $manageData = new manageContent_DAL();
    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $status = 1;
        $pageName = $_POST['pageName'];
        $pageContent = $_POST['pageContent'];
        $insertPage = $manageData->insertPage($pageName,$pageContent,$status);
    }

?>