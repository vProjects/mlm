<?php
	$pageTitle = "Invoice Details";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Invoice Details</p>
            <small>
                <cite title="Source Title">Invoice Details of your site.</cite>
            </small>
        </blockquote>
        
        <!--form for selecting date duration-->
        <div class="form-horizontal">
        	<form action="v-includes/functions/function.searchInvoiceDetails.php" method="post">
            	<div class="form-control v-form">
                	<label class="control-label">From Date:</label>
                    <input type="text" class="textbox1" name="from_date" id="calender_date"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">To Date:</label>
                    <input type="text" class="textbox1" name="to_date" id="calender_date2"/>
                </div>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                    <input type="hidden" name="redirect_page" value="invoiceDetails" />
                	<input type="submit" value="SEARCH" class="btn btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        
       <?php
	   		//selecting the values according to search method
			if(!empty($GLOBALS['_GET']))
			{
				$from_date = $_GET['from_date'];
				$to_date = $_GET['to_date'];
				//fetching the values from databases
				echo '<table class="table table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>Invoice Number</th>
							<th>Order Id</th>
							<th>Tax Id Number</th>
							<th>Total Price</th>
							<th>Basic Price</th>
							<th>22% DDV</th>
							<th>9.5% DDV</th>
						</tr>
					</thead>';
					
						//call the method from BLL to get invoice list
						$manageData->getInvoiceDetails($from_date,$to_date);							
							   
				echo '</table>';
			}
			else
			{
				echo "";
			}
	   ?>
        
        
     </div>
</div>
<!--body main container ends here-->
   

<?php
	//get footer
	include('v-templates/footer.php');
?>