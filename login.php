<?php
    session_start();
	$page_title = 'LOGIN';
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
        		<h2 class="page_heading">Account Login</h2>
            </div>
            <div class="row-fluid">
            	<div class="span5">
                	<h4 class="form_caption">New Customer</h4>
                    <div class="row-fluid login_page">
                        <p class="login_text">Register Account</p>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <a href="sign_up.php" class="btn btn-danger">Continue</a>
                    </div>    
                </div>
                <div class="span6">
                	<h4 class="form_caption">Returning Customer</h4>
                	 <div class="alert alert-error" style="display: <?php if(isset($_SESSION['login_error'])){echo 'block';} else echo 'none'; ?>"><?php if(isset($_SESSION['login_error'])){ print_r($_SESSION['login_error']); } ?></div>
                    <div class="row-fluid login_page">
                    	<p>I am a returning customer</p>
                        <form method="post" action="v-includes/functions/function.login.php">
                        	<fieldset>
                            	<label>Email Id</label>
    							<input type="text" placeholder="Please Type Your Email ID" name="email_id" />
                                <label>Password:</label>
    							<input type="password" placeholder="Password" name="password" />
                                <p><a href="forgot_pwd.php">Forgotten Password</a></p>
                                <button type="submit" class="btn btn-inverse btn-large">SUBMIT</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
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