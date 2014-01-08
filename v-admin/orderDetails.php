<?php
	$pageTitle = "Order Details";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Order Details</p>
            <small>
                <cite title="Source Title">order details of your website.</cite>
            </small>
        </blockquote>
			<?php
				//selecting the values according to search method
				if(!empty($GLOBALS['_GET']))
				{
					$order_id = $GLOBALS['_GET']['o_id'];
					$manageData->getOrderDetails($order_id);
				}
				else
				{
					echo 'No Order Id Selected';
				} 
            ?>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>