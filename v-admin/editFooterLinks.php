<?php
	$pageTitle = "Edit Footer Links";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Edit Footer Links</p>
            <small>
                <cite title="Source Title">Edit footer links of your website.</cite>
            </small>
        </blockquote>
        
		<?php	$footer_id = $GLOBALS['_GET']['id']; ?>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.editFooterLinks.php" method="post">
           		<?php $product = $manageData->getAnFooterLink($footer_id); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>