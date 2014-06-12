<?php
	$pageTitle = "Edit Invalid Member Content";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Edit Invalid Member Content</p>
            <small>
                <cite title="Source Title">Edit Invalid Member content of your website.</cite>
            </small>
        </blockquote>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.editInvalidMemberContent.php" method="post">
           		<?php $product = $manageData->getInvalidMemberContent(); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>