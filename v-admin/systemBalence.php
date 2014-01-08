<?php
	$pageTitle = "System Balance";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>
<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Total System Balance</p>
            <small>
                <cite title="Source Title">Total System Balance of your website.</cite>
            </small>
        </blockquote>
        
            <?php
				//call the method from BLL to get product list
				$manageData->getSystemBalence();							
			?>
        
    </div>
</div>
<!--body main container ends here-->
   


<?php
	//get footer
	include('v-templates/footer.php');
?>
