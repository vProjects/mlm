<?php
	$pageTitle = "Edit Membership Product";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Edit Membership Product</p>
            <small>
                <cite title="Source Title">Edit membership product details of your website.</cite>
            </small>
        </blockquote>
        
		<?php	$product_id = $GLOBALS['_GET']['product_id']; ?>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.editMembershipProduct.php" method="post" enctype="multipart/form-data">
           		<?php $product = $manageData->getMembershipProductDetails($product_id); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>