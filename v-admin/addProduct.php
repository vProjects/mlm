<?php
	$pageTitle = "Add Product";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>
<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Add a Product</p>
            <small>
                <cite title="Source Title">Please add a product to your home page.</cite>
            </small>
        </blockquote>
        <?php
			if(!empty($GLOBALS['_GET']))
			{
				if($GLOBALS['_GET']['msg'] == 9999)
				{
					echo '<div class="alert alert-error" id="warning_msg">Discount Section Must Be Filled</div>';
				}
				elseif($GLOBALS['_GET']['msg'] == 1111)
				{
					echo '<div class="alert alert-success" id="success_msg">Your Product Is Added Properly</div>';
				}
				if($GLOBALS['_GET']['msg'] == 7777)
				{
					echo '<div class="alert alert-error" id="warning_msg">Product Upload Unsuccessfull!!</div>';
				}
				
			}
		?>
        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.addProduct.php" method="post" enctype="multipart/form-data">
                <div class="form-control v-form">
                	<label class="control-label">Product Name:</label>
                    <input type="text" placeholder="Product Name" class="textbox1" name="product_name"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Category:</label>
                    <select class="selectbox1" multiple="multiple" name="category[]">
                    <?php $manageData->getCategoryListSelectBox(); ?>
                    </select>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Description</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="description"></textarea>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">References:</label>
                    <input type="text" placeholder="Reference link" class="textbox1" name="references"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Old Price:</label>
                    <input type="text" placeholder="Old Price" class="textbox1" name="old_price"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Price for Guest:</label>
                    <input type="text" placeholder="Price for Guest" class="textbox1" name="price_guest"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Price for Members:</label>
                    <input type="text" placeholder="Price for Members" class="textbox1" name="price_members"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Tax:</label>
                    <input type="text" placeholder="Tax" class="textbox1" name="tax"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Discount Rate:</label>
                    <input type="text" placeholder="Discount" class="textbox1" name="discount"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Stock of Product:</label>
                    <input type="text" placeholder="Stock of Product" class="textbox1" name="stock"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Expiration Date:</label>
                    <input type="text" placeholder="date of Expiration of product" id="calender_date" class="textbox1" name="expiration_date"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Maximum No of Product:</label>
                    <input type="text" placeholder="Maximum no of product selling at one buyer" class="textbox1" name="maxpick"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Upload Main Image of Product:</label>
                    <input type="file" class="textbox1" name="photo"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo1"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo2"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo3"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Other Images:</label>
                    <input type="file" class="textbox1" name="photo4"/>
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