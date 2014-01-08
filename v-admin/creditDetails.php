<?php
	$pageTitle = "Credit Details";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>
<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Credit Details of the System</p>
            <small>
                <cite title="Source Title">Credit Details of your website.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Member Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Time</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <?php
				//call the method from BLL to get product list
				$creditAmount = $manageData->creditDetails();							
			?>
                       
        </table>
        
        <div class="row-fluid">
        	<p class="trust_balence_outline"><span class="trust_balance">Total Credit Balance:</span>
            <span class="trust_amount"> $ <?php echo $creditAmount; ?></span></p>
        </div>
        
    </div>
</div>
<!--body main container ends here-->
   


<?php
	//get footer
	include('v-templates/footer.php');
?>
