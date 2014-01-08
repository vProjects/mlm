<?php
	$pageTitle = "Withdraw History";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container" style="width:80%;">
    	<blockquote>
            <p>Member Withdraw History</p>
            <small>
                <cite title="Source Title">withdraw history of a member.</cite>
            </small>
        </blockquote>
        <?php $membership_id = $_GET['m_id']; ?>
        <table class="table table-hover">
        	<thead>
                <tr>
                    <th>Withdraw Id</th>
                    <th>Date</th>
                    <th>Frozen Money</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <?php
				//call the method from BLL to get coupon list
				$manageData->getWithdrawHistory($membership_id);							
			?>
                       
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>