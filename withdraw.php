<?php
	session_start();
	$page_title = 'WITHDRAW';
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
            <h4 class="left_container_heading"><span class="heading_text">Withdraw Amount</span></h4>
            <?php
				//checking the invalid conditions
				$invalid_conditions = $manageContent->getInvalidConditions($membership_id);
				if($invalid_conditions[1] == 1)
				{
					$member_account = $manageContent->getMembersAccountDetails($membership_id);
					if($member_account == 1)
					{
						if($_POST['frozen'] == 0)
						{
							$amount = $_POST['amount'];
							//checking that withdrawal amount is less than 30 or not
							if($amount < 30)
							{
								echo '<h3>Your Net Amount Is Below €30,So You Can Not Withdraw Your Amount Now</h3>';
							}
							else
							{
								echo '<p> <span class="product_price_text">Total Amount In Your Account:</span> 
								<span class="product_price"> € '.$amount.'</span> </p>
								 <form action="v-includes/functions/function.withdraw.php" method="post" class="form-horizontal" id="withdraw_form">
									<div class="control-group">
										<label class="control-label" id="form_label">Withdrawal Amount:</label>
										<div class="controls">
											€ <input type="text" placeholder="withdrawal amount in figure" name="withdraw" id="withdraw_amount">
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<input type="hidden" name="frozen" value="0">
											<input type="hidden" name="membership_id" value="'.$membership_id.'">
											<input type="button" class="btn btn-inverse btn-large" value="SUBMIT" onclick="checkingWithdrawAmount();">
										</div>
									</div>
								</form>';
							}
						}
						else if($_POST['frozen'] == 1)
						{
							$frozen_amount = $_POST['amount'];
							echo '<h4>You Have To Buy 11% Of Your Net Frozen Amount To Withdraw It.</h4>
							<p> <span class="product_price_text">Total Frozen Amount In Your Account:</span> 
							<span class="product_price">€ '.$frozen_amount.'</span> </p>
							 <form action="v-includes/functions/function.withdraw.php" method="post" class="form-horizontal">
								<div class="control-group">
									<label class="control-label" id="form_label">Withdrawal Amount:</label>
									<div class="controls">
										€ <input type="text" placeholder="withdrawal amount in figure" name="withdraw">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<input type="hidden" name="frozen" value="1">
										<input type="hidden" name="membership_id" value="'.$membership_id.'">
										<input type="submit" class="btn btn-inverse btn-large" value="SUBMIT">
									</div>
								</div>
							</form>';
						}
						else
						{
							echo 'No Element Found';
						}
					}
					else
					{
						echo 'Firstly, You Have To Fill Up Your Account Information';
					}
				}
				else
				{
					echo 'You Are Not Upgraded Member!! You Are Not Able To Withdraw Your Money.';
				}
			?>
            
           
            
        </div>
        <!--- rightcontainer ends here --->
    </div>
<!--- body ends here --->


<?php
	//include footer
	include ('v-templates/footer.php');
?>