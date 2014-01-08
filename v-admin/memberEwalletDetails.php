<?php
	$pageTitle = "Ewallet Details";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container" style="width:80%;">
    	<blockquote>
            <p>Member Ewallet Details</p>
            <small>
                <cite title="Source Title">Ewallet Details of a member.</cite>
            </small>
        </blockquote>
        <?php $membership_id = $_GET['m_id']; ?>
        <table class="table table-hover">
        <caption class="table_caption"><b>Direct Money</b></caption>
        	<thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Amount Debited</th>
                </tr>
            </thead>
            <?php
				//call the method from BLL to get coupon list
				$manageData->getEwalletValue($membership_id,0);							
			?>
                       
        </table>
        
        <table class="table table-hover">
        <caption class="table_caption"><b>Frozen Money</b></caption>
        	<thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Amount Debited</th>
                </tr>
            </thead>
            <?php
				//call the method from BLL to get coupon list
				$manageData->getEwalletValue($membership_id,1);							
			?>
                       
        </table>
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>