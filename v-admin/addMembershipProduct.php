<?php
	$pageTitle = "Add Membership Product";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
        <blockquote>
            <p>Add a Membership Product</p>
            <small>
                <cite title="Source Title">Please add a membership product to your signup page.</cite>
            </small>
        </blockquote>
        <?php
			if(!empty($GLOBALS['_GET']))
			{
				if($GLOBALS['_GET']['msg'] == 9874)
				{
					echo '<div class="alert alert-error" id="warning_msg">Discount Section Must Be Filled</div>';
				}
				elseif($GLOBALS['_GET']['msg'] == 1010)
				{
					echo '<div class="alert alert-success" id="success_msg">Your Product Is Added Properly</div>';
				}
				
			}
		?>
        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.addMembershipProduct.php" method="post" enctype="multipart/form-data">
                <div class="form-control v-form">
                	<label class="control-label">Product Name:</label>
                    <input type="text" placeholder="Product Name" class="textbox1" name="product_name"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Description</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description"></textarea>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Price:</label>
                    <input type="text" placeholder="Price for Guest" class="textbox1" name="price"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Discount:</label>
                    <input type="text" placeholder="discount" class="textbox1" name="discount"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Stock of Product:</label>
                    <input type="text" placeholder="Stock of Product" class="textbox1" name="stock"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Upload Image of Product</label>
                    <input type="file" class="textbox1" name="photo"/>
                </div>
                <div class="form-control v-form">
                	<div class="function_result"></div>
                	<input type="submit" value="SUBMIT" class="btn btn-large btn-inverse btn1" />
                    <div class="clearfix"></div>
                </div>
           </form>
        </div> 
        
        
        </div>
</div>
<!--body main container ends here-->



<?php
	//get footer
	include('v-templates/footer.php');
?>