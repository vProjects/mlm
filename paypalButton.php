<!-- paypal checkout button -->
                          <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypalform" method="post" target="_top" style="display: none">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="business" value="UPPNK3Q86Q6JS">
                            <input type="hidden" name="lc" value="SI">
                            <input type="hidden" name="item_name" value="product">
                            <input type="hidden" name="amount" id="paypal_amount" value="<?php echo $getProductAmount ?>">
                            <input type="hidden" name="currency_code" value="EUR">
                            <input type="hidden" name="button_subtype" value="services">
                            <input type="hidden" name="no_note" value="0">
                            <input type="hidden" name="cn" value="Add special instructions to the seller:">
                            <input type="hidden" name="no_shipping" value="2">
                            <input type="hidden" name="rm" value="1">
                            <input type="hidden" name="return"  id="returnvalue" value="http://www.mojlife.com/paymentByPaypal.php?total_price=<?php echo $getProductAmount?>&m_id=<?php if(!isset($_SESSION['memberId'])) echo 'guest'; else echo $_SESSION['memberId'] ?>
                            ">
                            <input type="hidden" name="cancel_return" value="http://www.mojlife.com/cancel.php">
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                          </form>
                          <!-- paypal checkout button ends here -->
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          <form action="https://www.paypal.com/cgi-bin/webscr" id="paypalform" method="post" target="_top" style="display: none">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="4P259Y7QS4H7N">
<input type="hidden" name="lc" value="SI">
<input type="hidden" name="item_name" value="product">
<input type="hidden" name="amount" id="paypal_amount" value="<?php echo $getProductAmount ?>">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="cn" value="Add special instructions to the seller:">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return"  id="returnvalue" value="http://www.mojlife.com/paymentByPaypal.php?total_price=<?php echo $getProductAmount?>&m_id=<?php if(!isset($_SESSION['memberId'])) echo 'guest'; else echo $_SESSION['memberId'] ?>">
<input type="hidden" name="cancel_return" value="http://www.mojlife.com/cancel.php">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>