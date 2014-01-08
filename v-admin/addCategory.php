<?php
	$pageTitle = "Add Product Category";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Add Product Category</p>
            <small>
                <cite title="Source Title">Please add a product category to your home page.</cite>
            </small>
        </blockquote>
        
    	<!--form for adding the product-->
        <div class="form-horizontal">
        	<form action="v-includes/functions/function.addProductCategory.php" method="post">
            	<div class="form-control v-form">
                	<label class="control-label">Product Category:</label>
                    <input type="text" placeholder="Product Category" class="textbox1" name="category"/>
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