<?php
	$pageTitle = "Edit Footer Bottom Text";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Edit Footer Bottom Text</p>
            <small>
                <cite title="Source Title">Edit footer bottom text of your website.</cite>
            </small>
        </blockquote>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.editFooterBottomText.php" method="post">
           		<?php $product = $manageData->getFooterBottomText(); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>