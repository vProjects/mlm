<?php
	$pageTitle = "Product List";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container" style="width:80%;">
    	<blockquote>
            <p>Product List</p>
            <small>
                <cite title="Source Title">List of product of your website.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Old Price</th>
                    <th>Guest Price</th>
                    <th>Members Price</th>
                    <th>Tax</th>
                    <th>Discount</th>
                    <th>Stock</th>
                    <th>Expiration Date</th>
                    <th>Maximum Product</th>
                    <th>Edit</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <?php
				//call the method from BLL to get product list
				$manageData->getProductList();							
			?>
                       
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>