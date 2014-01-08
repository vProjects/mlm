<?php
	$pageTitle = "Edit Coupon";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Edit Coupon</p>
            <small>
                <cite title="Source Title">Edit coupon details of your website.</cite>
            </small>
        </blockquote>
        
		<?php	$coupon_id = $GLOBALS['_GET']['coupon_id']; ?>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.editCoupon.php" method="post" enctype="multipart/form-data">
           		<?php $product = $manageData->getCouponDetails($coupon_id); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>