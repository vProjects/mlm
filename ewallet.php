<?php
	session_start();
	$page_title = 'ML WALLET';
	if(!isset($_SESSION['memberId'])){
        header("Location: sign_up.php");
    }
	//include header section
	include 'v-templates/header.php';
	$membership_id = $_SESSION['memberId'];
	
	//checking the invalid conditions
	$invalid_conditions = $manageContent->getInvalidConditions($_SESSION['memberId']);
	if($invalid_conditions[1] == 0)
	{
		header("Location: my_wallet.php");
	}
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
        <?php
			if(!empty($GLOBALS['_GET']))
			{
				if($GLOBALS['_GET']['msg'] == 7788)
				{
					echo '<div class="alert alert-error">You Have Filled More Than Due Money</div>';
				}
				else if($GLOBALS['_GET']['msg'] = 1212)
				{
					echo '<div class="alert alert-success">Your Request Is Send Successfully</div>';
				}
			}
			else
			{
				echo "";
			}
		?>
            <h4 class="left_container_heading"><span class="heading_text">ML Wallet Details</span></h4>
            <div class="row-fluid">
            	<table class="table table-bordered">
                	<caption class="table_caption">My Balance</caption>
                    <thead>
                    	<tr>
                        	<th>Sl No.</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Amount Debited</th>
                        </tr>
                    </thead>
                    <tbody class="table_list_ewallet">
                    	<?php 
							$total_amount = $manageContent->getEwalletValue($membership_id);
							$transactionDetails = $manageContent->getEwalletTransaction($membership_id);	
						 ?>
                    </tbody>
                </table>
            </div>
            <div class="row-fluid">
            	<form action="withdraw.php" method="post">
                	<input type="hidden" name="amount" value="<?php echo $total_amount; ?>" />
                    <input type="hidden" name="frozen" value="0" />
                    <input type="submit" class="btn btn-inverse pull-right" value="WITHDRAW" />
                </form>
            </div>
            <!-- section for frozen money --->
            <div class="row-fluid">
            	<table class="table table-bordered">
                	<caption class="table_caption">Bonus</caption>
                    <thead>
                    	<tr>
                        	<th>Category</th>
                            <th>Amount Debited</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $total_amount_frozen = $manageContent->getEwalletFrozen($membership_id); ?>
                    </tbody>
                </table>
            </div>
            <div class="row-fluid">
            	<form action="withdraw.php" method="post">
                	<input type="hidden" name="amount" value="<?php echo $total_amount_frozen; ?>" />
                    <input type="hidden" name="frozen" value="1" />
                    <input type="submit" class="btn btn-inverse pull-right" value="WITHDRAW FROZEN MONEY" />
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
