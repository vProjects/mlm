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
	if($invalid_conditions[1] == 1)
	{
		header("Location: ewallet.php");
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
       
            <h4 class="left_container_heading"><span class="heading_text">ML Wallet Details</span></h4>
            <div class="row-fluid">
            	<table class="table table-bordered">
                	<caption class="table_caption">My Money</caption>
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
                    	<?php $total_amount = $manageContent->getMyWalletValue($membership_id); ?>
                    </tbody>
                </table>
            </div>
            
            <div class="row-fluid">
            	<table class="table table-bordered">
                	<caption class="table_caption">Potential Money</caption>
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
                    	<?php $total_amount = $manageContent->getPotentialMoney($membership_id); ?>
                    </tbody>
                </table>
            </div>
            
        </div>
        <!--- rightcontainer ends here --->
    </div>
<!--- body ends here --->



<?php
	//include footer
	include ('v-templates/footer.php');
?>
