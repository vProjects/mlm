<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--Import Bootstrap CSS-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<!--Custom CSS file-->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<title>Login | ADMIN</title>
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
                </div>
            </div>
        </div><!--header ends here-->
    	<div class="container">
        	<div class="form-signin">
            	<h3>Please Login</h3>
                <form action="v-includes/functions/function.login.php" method="post">
                    <input type="text" class="form-control" placeholder="USERNAME" name="username"/>
                    <input type="password" class="form-control" placeholder="PASSWORD" name="password"/>
                    <input type="submit" class="btn btn-primary btn-submit" value="SUBMIT" />
                	<div style="color:red;"><?php if(isset($_SESSION['login_error'])){ echo '**'.$_SESSION['login_error']; unset($_SESSION['login_error']);} ?></div>
                </form>
            </div>
        </div>
    </div><!--body main container ends here-->
    
<?php
	//get footer
	include('v-templates/footer.php');
?>