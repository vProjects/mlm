<?php
	$pageTitle = "Edit Product";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Edit Product</p>
            <small>
                <cite title="Source Title">Edit product details of your website.</cite>
            </small>
        </blockquote>
        
		<?php	$product_id = $GLOBALS['_GET']['product_id']; ?>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.editProduct.php" method="post" enctype="multipart/form-data">
           		<?php $product = $manageData->getProductDetails($product_id); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>