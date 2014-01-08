<?php
	$pageTitle = "Member Orders List";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Member Orders List</p>
            <small>
                <cite title="Source Title">Member Orders List of your website.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Order Id</th>
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                </tr>
            </thead>
            
			<?php
				//call the method from BLL to get members list
				$manageData->productOrderDetails("member");							
            ?>           
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>