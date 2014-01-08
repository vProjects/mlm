<?php
	session_start();
	$page_title = 'CHANGE PASSWORD';
	if(!isset($_SESSION['memberId'])){
        header("Location: sign_up.php");
    }
	//include header section
	include 'v-templates/header.php';
	$membership_id = $_SESSION['memberId'];
?>

<?php
	//include navbar section
	include 'v-templates/navbar.php';
?>

<!-- body starts here -->
    <div class="row-fluid">
    	<?php
			//include left sidebar section
			include 'v-templates/left_sidebar.php';
		?>
        
     <!--- rightcontainer starts here --->
        <div class="span9">
            <div class="row-fluid">
                <h2 class="page_heading">Change Password</h2>
            </div>
            
            <div class="row-fluid">
            	<form action="v-includes/functions/function.changePassword.php" class="form-horizontal" method="post">
                	<h4 class="form_caption">Your Password Details</h4>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Password:</label>
                        <div class="controls">
                        	<input type="password" placeholder="Your Password" name="password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">New Password:</label>
                        <div class="controls">
                        	<input type="password" placeholder="Your New Password" name="new_password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Retype New Password:</label>
                        <div class="controls">
                        	<input type="password" placeholder="Retype Your New Password" name="re_new_password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                        	<input type="hidden" name="membership_id" value="<?php echo $membership_id; ?>">
                            <input type="submit" class="btn btn-inverse btn-large" id="btn_submit" value="SUBMIT">
                        </div>
                    </div>
                    <div class="function_result">
						<?php if(isset($_SESSION['result'])){echo $_SESSION['result'];unset($_SESSION['result']);} ?>
                    </div>
                </form>
            </div>
        </div>
    <!--- rightcontainer ends here --->
	</div>
<!--- body ends here --->

<?php
	//include footer
	include ('v-templates/footer.php');
?>
