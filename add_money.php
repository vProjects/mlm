<?php
	session_start();
	$page_title = 'ADD MONEY';
	if(!isset($_SESSION['memberId'])){
        header("Location: sign_up.php");
    }
	//include header section
	include 'v-templates/header.php';
	$membership_id = $_SESSION['memberId'];
?>


<?php
	//include navbar section
	include 'v-templates/navbar.php';
?>

<!-- body starts here -->
    <div class="row-fluid">
    	<?php
			//include left sidebar section
			include 'v-templates/left_sidebar.php';
		?>
        <!--- rightcontainer starts here --->
        <div class="span9">
            <h4 class="left_container_heading"><span class="heading_text">Add Money To EWallet</span></h4>
            <div class="row-fluid">
            
            	<input type="text" class="form-control" id="add_money" />
                <div class="am_radio_section">
                    <label class="pull-left am_radio_button">Payment Throgh:</label>
                    <label class="radio-inline pull-left am_radio_button"><input type="radio" name="payment_options" id="payment_paypal" checked="checked"/>Paypal</label>
                    <label class="radio-inline pull-left am_radio_button"><input type="radio" name="payment_options" id="payment_account"/>Bank Account</label>
                    <div class="clearfix"></div>
                </div>
            	
     			<form action="https://www.paypal.com/cgi-bin/webscr" id="addMoneyToPaypal" method="post" target="_top" style="display: block;">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="4P259Y7QS4H7N">
                            <input type="hidden" name="lc" value="SI">
                            <input type="hidden" name="item_name" value="product">
                            <input type="hidden" name="amount" id="paypal_amount2">
                            <input type="hidden" name="currency_code" value="EUR">
                            <input type="hidden" name="button_subtype" value="services">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="return" id="returnvalue" value="http://www.mojlife.com/paymentByPaypal.php">
                            <input type="hidden" name="cancel_return" value="http://www.mojlife.com/cancel.php">
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                            <input type="button" id="callToaction" class="addMoney_submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    			</form> 
                
                <form action="thanku.php" id="addMoneyToBank" style="display:none;">
                	<input type="button" id="submitMoneyToBank" value="Submit" class="btn btn-success btn-large" />
                </form>
            </div>
        </div>
        <!--- rightcontainer ends here --->
    </div>
    <!--- body ends here --->
<script>
	
	$('#callToaction').click(function(){
		var valueEntered = $('#add_money').val();
		$('#paypal_amount2').val(valueEntered); 
		
		var addMoney = 'refData=addMoney&u=unk';
		$.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: addMoney,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
				console.log(result);
				$("").html('');
				return false;
        }});
		
		$('#addMoneyToPaypal').submit();
		
	});
	
	$('#submitMoneyToBank').click(function(){
		/*var valueEntered = $('#add_money').val();
		$('#paypal_amount2').val(valueEntered); */
		
		var addMoney = 'refData=addMoneyToBank&u=unk';
		$.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: addMoney,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
				console.log(result);
				$('#addMoneyToBank').submit();
				$("").html('');
				return false;
        }});
		
		
		
	});
    
</script>

<?php
	//include footer
	include ('v-templates/footer.php');
?>