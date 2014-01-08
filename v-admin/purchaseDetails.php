<?php
	$pageTitle = "Search Purchase Details";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Purchase Details</p>
            <small>
                <cite title="Source Title">Purchase Details of your website.</cite>
            </small>
        </blockquote>
        
        <!--form for adding the product-->
        <div class="form-horizontal">
        	<form action="v-includes/functions/function.searchPurchaseDetails.php" method="post">
            	<div class="form-control v-form">
                	<label class="control-label">Search By:</label>
                    <select class="selectbox1" name="search_key">
                    	<option value="product_name">Product Name</option>
                        <!--<option value="payment_method">Payment Method</option>-->
                        <option value="membership_product_name">Membership Product Name</option>
                    </select>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Input Value:</label>
                    <input type="text" placeholder="Search Element" class="textbox1" name="value"/>
                </div>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                    <input type="hidden" name="redirect_page" value="purchaseDetails" />
                	<input type="submit" value="SEARCH" class="btn btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        
			<?php
				//selecting the values according to search method
				if(!empty($GLOBALS['_GET']))
				{
					echo '<table class="table table-hover">
							<thead>
								<tr>
									<th>Order Id</th>
									<th>Name</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Date</th>
									<th>Payment Method</th>
									<th>Payment Status</th>
								</tr>
							</thead>';
					//getting the key field by which data will fetched
					if(isset($GLOBALS['_GET']['product_name']))
					{
						$search_key = $GLOBALS['_GET']['product_name'];
						$manageData->productPurchaseDetails("product_name",$search_key,"product_table");
					}
					else if(isset($GLOBALS['_GET']['membership_product_name']))
					{
						$search_key = $GLOBALS['_GET']['membership_product_name'];
						$manageData->productPurchaseDetails("product_name",$search_key,"membership_product");
					}
					echo '</table>';
				}
				else
				{
					$search_key = "";
					$column_name = "";
				}
		   
            ?>           
        
        
    </div>
</div>
<!--body main container ends here-->


<?php
	//get footer
	include('v-templates/footer.php');
?>