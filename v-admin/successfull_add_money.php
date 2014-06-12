<?php
	$pageTitle = "Successfull Add Money";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Successfull Add Money Details</p>
            <small>
                <cite title="Source Title">Successfull Add Money of your page.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Money Id</th>
                    <th>Membership Id</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            
			<?php
				//call the method from BLL to get members list
				$manageData->getSuccessfullAddMoneyDetails();
            ?>           
        </table>
        
     </div>
</div>
<!--body main container ends here--> 

<?php
	//get footer
	include('v-templates/footer.php');
?>