<?php
	$pageTitle = "Successfull Withdrawal Request";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Successfull Withdrawal Request</p>
            <small>
                <cite title="Source Title">successfull withdrawal request of your home page.</cite>
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
                </tr>
            </thead>
            
			<?php
				//selecting the values according to search method
				if(!empty($GLOBALS['_GET']))
				{
					//getting the key field by which data will fetched
					if(isset($GLOBALS['_GET']['name']))
					{
						$search_key = $GLOBALS['_GET']['name'];
						$column_name = "name";
					}
					else if(isset($GLOBALS['_GET']['membership_id']))
					{
						$search_key = $GLOBALS['_GET']['membership_id'];
						$column_name = "membership_id";
					}
				}
				else
				{
					$search_key = "";
					$column_name = "";
				}
		   		//for successful withdrawals 
				$status = 1;
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