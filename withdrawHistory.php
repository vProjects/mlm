<?php
	session_start();
	$page_title = 'WITHDRAW HISTORY';
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
                <h2 class="page_heading">Withdraw History</h2>
            </div>
            
            <div class="row-fluid">
            		<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Withdraw Id</th>
                                <th>Date</th>
                                <th>Frozen Money</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $withdraw_details = $manageContent->getWithdrawHistory($membership_id); ?> 
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
