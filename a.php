<?php

$amount = 20;

?>


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="UPPNK3Q86Q6JS">
<input type="hidden" name="lc" value="SI">
<input type="hidden" name="item_name" value="product">
<input type="hidden" name="amount" value="<?php echo $amount ?>">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="kuchbhi" value="main tera dost hun">
<input type="hidden" name="kuchbhi1" value="main tera dost hun1">
<input type="hidden" name="kuchbhi2" value="main tera dost hun2">
<input type="hidden" name="kuchbhi3" value="main tera dost hun3">
<input type="hidden" name="cn" value="Add special instructions to the seller:">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://www.vyrazu.com/running-projects/mlm/thanku.php?kuchbhiho=kuchnhi&kuchbhi=kuchibhinhi">
<input type="hidden" name="cancel_return" value="http://www.vyrazu.com/running-projects/mlm/cancel.php">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">

//$( document ).ready(function() {    
  //  $( "#E_form" ).submit(function( event ) {
  //alert( "Handler for .submit() called." );
//});

//});

  // Handler for .ready() called.


</script>