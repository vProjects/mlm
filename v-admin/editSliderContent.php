<?php
	$pageTitle = "Edit Slider Content";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Edit Slider Content</p>
            <small>
                <cite title="Source Title">Edit slider content of your website.</cite>
            </small>
        </blockquote>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.editSliderContent.php" method="post" enctype="multipart/form-data">
           		<?php $product = $manageData->getSliderContent(); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>