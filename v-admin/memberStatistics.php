<?php
	$pageTitle = "Member Statistics";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container" style="width:80%;">
    	<blockquote>
            <p>Member Statistics</p>
            <small>
                <cite title="Source Title">Member Statistics of your website.</cite>
            </small>
        </blockquote>
        
            <?php
				//call the method from BLL to get member statistics
				$manageData->getMemberStatistics();							
			?>
                       
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>