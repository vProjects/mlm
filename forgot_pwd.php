<?php
    session_start();
	$page_title = 'FORGOT PASSWORD';
    if(!isset($_SESSION['memberId'])){
        $_SESSION['guestId'] = 'guest';
    }
    else {
        header('Location: ewallet.php');
    }
	// include header section
	include ('v-templates/header.php');
            
?>

<?php
	//include navbar section
	include ('v-templates/navbar.php');
?>

    <!-- body starts here -->
    <div class="row-fluid">
    	<?php
			//include navbar section
			include 'v-templates/left_sidebar.php';
		?>
        <!-- rightcontainer starts here -->
        <div class="span9">
        	<div class="row-fluid">
        		<h2 class="page_heading">Forgot Password</h2>
            </div>
            <div class="row-fluid">
            <div class="alert alert-error" style="display: <?php if(isset($_SESSION['error'])){echo 'block';} else echo 'none'; ?>"><?php if(isset($_SESSION['error'])){ print_r($_SESSION['error']); } ?></div>
            <div class="alert alert-success" style="display: <?php if(isset($_SESSION['message'])){echo 'block';} else echo 'none'; ?>"><?php if(isset($_SESSION['message'])){ print_r($_SESSION['message']); } ?></div>
           		<form method="post" action="v-includes/functions/function.forgotPwd.php">
                    <fieldset>
                        <label>Type Your Email Id:</label>
                        <input type="text" placeholder="Please Type Your Email ID" name="email_id" />
                        <p><button type="submit" class="btn btn-inverse btn-large">SUBMIT</button></p>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- rightcontainer ends here -->
    </div>
    <!-- body ends here --> 
    
<?php
	//include footer section
    unset($_SESSION['login_error']);
	include ('v-templates/footer.php');
?>  