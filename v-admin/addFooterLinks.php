<?php
	$pageTitle = "Add Footer Links";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>

<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Add Footer Links</p>
            <small>
                <cite title="Source Title">Please add a footer links to your home page.</cite>
            </small>
        </blockquote>
        
    	<!--form for adding the product-->
        <div class="form-horizontal">
        	<form action="v-includes/functions/function.addFooterLinks.php" method="post">
            	<div class="form-control v-form">
                	<label class="control-label">Name:</label>
                    <input type="text" placeholder="Footer Link Name" class="textbox1" name="name"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Link:</label>
                    <input type="text" placeholder="Footer Link" class="textbox1" name="link"/>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Footer Column:</label>
                    <select name="column" class="textbox1">
                    	<option value="1st_column">1st</option>
                        <option value="2nd_column">2nd</option>
                        <option value="3rd_column">3rd</option>
                    </select>
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