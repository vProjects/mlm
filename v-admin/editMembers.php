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
            <p>Edit Member</p>
            <small>
                <cite title="Source Title">Edit member details of your website.</cite>
            </small>
        </blockquote>
        
		<?php	$membership_id = $GLOBALS['_GET']['m_id']; ?>

        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="#" method="post">
           		<?php $members = $manageData->getMembersDetails($membership_id); ?>
           </form>
        </div>
        
    </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>