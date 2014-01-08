<?php
	$pageTitle = "Footer Links";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Footer Links</p>
            <small>
                <cite title="Source Title">List of footer links of your website.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Column Name</th>
                    <th>Edit</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <?php
				//call the method from BLL to get footer links
				$manageData->getFooterLinks();							
			?>
                       
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>