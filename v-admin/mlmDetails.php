<?php
	$pageTitle = "MLM Structure";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Mlm Details</p>
            <small>
                <cite title="Source Title">MLM Details of your website.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>SL No.</th>
                    <th>Membership Id</th>
                    <th>Parent Id</th>
                    <th>Child Id</th>
                    <th>Date</th>
                    <th>Tree Details</th>
                </tr>
            </thead>
            <?php
				//call the method from BLL to get mlm details
				$manageData->getMlmDetails();							
			?>
                       
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>