<?php
	$pageTitle = "Due Payment My Account";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Due Payment By My Account</p>
            <small>
                <cite title="Source Title">due payments of your page.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Order Id</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            
			<?php
				//call the method from BLL to get members list
				$manageData->getDuePaymentsMyAccount(NULL);
            ?>           
        </table>
        
     </div>
</div>
<!--body main container ends here--> 

<?php
	//get footer
	include('v-templates/footer.php');
?>