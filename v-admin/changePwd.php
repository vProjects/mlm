<?php
	$pageTitle = "Change Password";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Change Password</p>
            <small>
                <cite title="Source Title">Please change password of admin panel.</cite>
            </small>
        </blockquote>
        
    	<!--form for adding the product-->
        <div class="form-horizontal">
        	<form action="v-includes/functions/function.changePassword.php" method="post">
            	<div class="form-control v-form">
                	<label class="control-label">Old Password:</label>
                    <input type="text" placeholder="Old Password" class="textbox1" name="old_password"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">New Password:</label>
                    <input type="text" placeholder="New Password" class="textbox1" name="new_password"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Confirm New Password:</label>
                    <input type="text" placeholder="Confirm New Password" class="textbox1" name="confirm_new_password"/>
                </div>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="SUBMIT" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>
                <div style="color:red;"><?php if(isset($_SESSION['p_msg'])){ echo '**'.$_SESSION['p_msg']; unset($_SESSION['p_msg']);} ?></div>
            </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>