<?php
	session_start();
	$page_title = 'EDIT PROFILE';
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
                <h2 class="page_heading">Edit Your Account</h2>
            </div>
            <?php
				//checking for existing account
				$account = $manageContent->accountAvailable($membership_id);
				if($account == 0)
				{ ?>
            
            <div class="row-fluid">
            	<form action="v-includes/functions/function.editAccount.php" id="btn_submit_account" 
                class="form-horizontal" method="post">
                	<h4 class="form_caption">Your A/C Details</h4>
                    <div class="control-group">
                        <label class="control-label" id="form_label">A/C Holder Name:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Account Holder Name" name="ac_name" id="v-ac_name">
                            <div id="err_v-ac_name"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">A/C Number:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Account Number" name="ac_no" id="v-ac_no">
                            <div id="err_v-ac_no"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Bank Name:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Bank Name" name="bank" id="v-bank">
                            <div id="err_v-bank"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Branch Name:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Branch Name" name="branch" id="v-branch">
                            <div id="err_v-branch"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Tax Number:</label>
                        <div class="controls">
                        	<input type="text" placeholder="Tax Number" name="ifsc_code">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                        	<input type="hidden" name="membership_id" value="<?php echo $membership_id; ?>">
                            <input type="button" class="btn btn-inverse btn-large" value="PREDLOŽI" onclick="validiateAccountInformation('btn_submit_account')">
                        </div>
                    </div>
                </form>
            </div>
            <?php }  else  { ?>
            
				<div class="row-fluid">
                    <form action="v-includes/functions/function.updateAccount.php" class="form-horizontal" id="updateAccountForm" method="post">
                        <h4 class="form_caption">Your A/C Details</h4>
                        
			<?php	$account_details = $manageContent->getAccountDetails($membership_id); ?>
            
                    </form>
                </div>
                
			<?php } ?>
            
        </div>
    <!--- rightcontainer ends here --->
	</div>
<!--- body ends here --->

<?php
	//include footer
	include ('v-templates/footer.php');
?>