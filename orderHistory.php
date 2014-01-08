<?php
	session_start();
	$page_title = 'ORDER HISTORY';
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
                <h2 class="page_heading">Purchase History</h2>
            </div>
            
            <div class="row-fluid">
            		<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $purchase_details = $manageContent->getPurchaseHistory($membership_id); ?> 
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
