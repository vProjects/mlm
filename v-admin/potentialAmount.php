<?php
	$pageTitle = "Potential Amount";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>
<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Potential Amount</p>
            <small>
                <cite title="Source Title">Potential Amount of your website.</cite>
            </small>
        </blockquote>
       
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>SL No.</th>
                    <th>Member Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Amount Debited</th>
                </tr>
            </thead>
            <?php
				//call the method from BLL to get product list
				$potentialMoney = $manageData->getPotentialAmount();							
			?>
                       
        </table>
        
         
        <div class="row-fluid">
        	<p class="trust_balence_outline"><span class="trust_balance">Total Balance:</span>
            <span class="trust_amount"> $ <?php echo $potentialMoney; ?></span></p>
        </div>
        
        
    </div>
</div>
<!--body main container ends here-->
   


<?php
	//get footer
	include('v-templates/footer.php');
?>
