<?php
	$pageTitle = "Order History";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container" style="width:80%;">
    	<blockquote>
            <p>Member Order History</p>
            <small>
                <cite title="Source Title">order history of a member.</cite>
            </small>
        </blockquote>
        <?php $membership_id = $_GET['m_id']; ?>
        <table class="table table-hover">
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
            <?php
				//call the method from BLL to get coupon list
				$manageData->getPurchaseHistory($membership_id);							
			?>
                       
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>