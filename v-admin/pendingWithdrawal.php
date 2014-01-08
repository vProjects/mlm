<?php
	$pageTitle = "Pending Withdrawal Request";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Pending Withdrawal Request</p>
            <small>
                <cite title="Source Title">pending withdrawal request of your home page.</cite>
            </small>
        </blockquote>
        
        <table class="table table-hover">
        	<thead>
                <tr>
                	<th>SL No.</th>
                    <th>Membership Id</th>
                    <th>Name</th>
                    <th>Withdrawal Id</th>
                    <th>Frozen Money</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            
			<?php
		   		//for pending withdrawals 
				$status = 0;
				//call the method from BLL to get members list
				$manageData->getWithdrawalList($status);							
			
            ?>           
        </table>
        
     </div>
</div>
<!--body main container ends here--> 

<?php
	//get footer
	include('v-templates/footer.php');
?>