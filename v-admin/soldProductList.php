<?php
	$pageTitle = "Sold Product List";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Sold Product List</p>
            <small>
                <cite title="Source Title">List of sold product of your website.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Order Id</th>
                    <th>Member Name</th>
                    <th>Product List</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                </tr>
            </thead>
            
			<?php
				//call the method from BLL to get members list
				$manageData->soldProductList();							
            ?>           
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>