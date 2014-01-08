<?php
	$pageTitle = "Edit Coupon Category";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Edit Coupon Category</p>
            <small>
                <cite title="Source Title">Edit category details of your website.</cite>
            </small>
        </blockquote>
        
		<?php	$category_id = $GLOBALS['_GET']['c_id']; ?>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.editCouponCategory.php" method="post">
           		<?php $product = $manageData->getCouponCategoryDetails($category_id); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>