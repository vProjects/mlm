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
            <p>Add free member</p>
            <small>
                <cite title="Source Title">Please add free member to your website.</cite>
            </small>
        </blockquote>
        
        <!--form for adding the product-->
        <div class="form-horizontal">
        	<form action="v-includes/functions/function.addFreeMember.php" method="post">
                <h4 class="form_caption">Personal Details</h4>
                <div class="form-control v-form">
                	<label class="control-label">First Name:</label>
                    <input type="text" placeholder="" class="textbox1" name="f_name" id="v_f_name">
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Last Name:</label>
                    <input type="text" placeholder="" class="textbox1" name="l_name">
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Email:</label>
                    <input type="text" placeholder="" class="textbox1" name="email_id" id="v_email">
                </div>
                <div class="form-control v-form">
                    <label class="control-label">DOB:</label>
                    <input type="text" placeholder="" name="dob" id="calender_date" class="textbox1">
                </div>
                <div class="form-control v-form">
                    <label class="control-label">Gender:</label>
                    <input type="radio" name="gender" value="male" checked="checked"  style="margin-left:15px;"/> Male
                    <input type="radio" name="gender" value="female" /> Female
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Contact No:</label>
                    <input type="text" placeholder="" class="textbox1" name="contact_no" id="v_contact_no">
                </div>
                <h4 class="form_caption">Address</h4>
                <div class="form-control v-form">
                	<label class="control-label">Address1:</label>
                    <input type="text" placeholder="" class="textbox1" name="address1" id="v_address">
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Address2:</label>
                    <input type="text" placeholder="" class="textbox1" name="address2">
                </div>
                <div class="form-control v-form">
                	<label class="control-label">City:</label>
                    <input type="text" placeholder="" class="textbox1" name="city">
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Postal Code:</label>
                    <input type="text" placeholder="" class="textbox1" name="postal_code">
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Country:</label>
                    <select name="country_id" id="addMember_country" class="textbox1">
                    	<?php $manageData->getCountryList('Slovenia'); ?>
                    </select>
                </div>
                <div class="form-control v-form">
                	<label class="control-label">Region/State:</label>
                    <select name="state_id" id="addMember_state" class="textbox1">
						<?php $manageData->getStateList(''); ?>
                    </select>
                </div>
                <h4 class="form_caption">Password</h4>
                <div class="form-control v-form">
                	<label class="control-label">Password:</label>
                    <input type="password" placeholder="" class="textbox1" name="password" id="v_password">
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