<?php
	$pageTitle = "Extend Membership Mail";
	//get header
	include('v-templates/header.php');
	//include sidebar
	include('v-templates/sidebar.php');
?>
<!--container for content of the website-->
	<div class="span9" id="content_container">
    	<blockquote>
            <p>Sending Mail For Extend Membership</p>
            <small>
                <cite title="Source Title">Sending Mail For Extend Membership of System.</cite>
            </small>
        </blockquote>
        <?php
			if(!empty($GLOBALS['_GET']))
			{
				$m_id = $GLOBALS['_GET']['m_id'];				
		?>
        <!--form for adding the product-->
        <div class="form-horizontal">
           <form action="v-includes/functions/function.membership_extend_mail.php" method="post">
                
                <div class="form-control v-form">
                	<label class="control-label">Mail Description</label><br><br>
                    <textarea type="text" id="editor1" placeholder="Description" class="textbox1 textarea" name="mail_body"></textarea>
                </div>
                
                <div class="form-control v-form">
                	<div class="function_result"></div>
                    <input type="hidden" name="m_id" value="<?php echo $m_id; ?>" />
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
	} else { echo 'No page found'; }
?>