<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header('Location: index.php');
	}
	include('v-includes/library/library.BLL.php');
	//create an object to access the methods of the BLL layer
	$manageData =  new manageContent_BLL();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--Import Bootstrap CSS-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<!--Custom CSS file-->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="ckeditor/ckeditor.js"></script>
<title>ADMIN | <?php echo $pageTitle; ?></title>
</head>

<body>
	
    
    <!--body main container starts here-->
    <div id="main_container">
    	<!--header starts here-->
        <div class="container" id="wrap">
            <div class="row v_row">
                <div class="span12 nav-header nav_header">
                    <div class="span2">
                        <h3>VPanel</h3>
                    </div>
                    <!--dropdown for admin-->
                    <div class="span2 admin-btn">
                    	<!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle btn-custom" data-toggle="dropdown">
                            	Hello Admin&nbsp;&nbsp;<span class="icon-align-justify"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="../index.php"><span class="icon-globe"></span>&nbsp;&nbsp;My Site</a></li>
                                <li><a href="#"><span class="icon-wrench"></span>&nbsp;&nbsp;Manage</a></li>
                                <li class="divider"></li>
                                <li><a href="v-includes/functions/function.logout.php"><span class="icon-off"></span>&nbsp;&nbsp;Logout</a></li>
                            </ul>
                        </div>
                    </div><!--dropdown for admin ends here-->
                </div>
            </div>
        </div><!--header ends here-->