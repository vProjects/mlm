<?php
	$page_title = 'CHECKOUT';
    session_start();
    //include header section
	include 'v-templates/header.php';
    if(!isset($_SESSION['memberId'])){
        $_SESSION['guestId'] = 'guest';
        
    }
    else{
        $userData =  $manageContent ->getUserData($_SESSION['memberId']);
    }
        
?>

<?php
	//include navbar section
	include 'v-templates/navbar.php';
?>

<!-- body starts here -->
    <div class="row-fluid">
    	<?php
			//include navbar section
			include 'v-templates/left_sidebar.php';
		?>
        <!--- rightcontainer starts here --->
        <div class="span9">
        	<div class="row-fluid">
        		<h2 class="page_heading">Blagajna</h2>
            </div>
            <div class="row-fluid">
            	<div class="accordion" id="accordion2">
                  <div class="accordion-group checkout_accordian">
                    <div class="accordion-heading">
                      <a class="accordion-toggle accordian_text" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        Korak 1: Kam želite prejeti naročilo
                      </a>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse in">
                      <div class="accordion-inner">
                        <form class="form-horizontal" id="billing_details">
                        	<label class="radio check_out_radio">
                              <input type="radio" name="part_1" id="existing_address" checked="checked" value="option1" onclick="selectedForm('address_form','new_address_form')">
                               Želim uporabiti obstoječi naslov
                            </label>
                            <div id="address_form">
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Address:</label>
                                    <div class="controls">
                                        <textarea rows="8" cols="70" class="uneditable-textarea unedited_textarea" readonly="readonly" name="recent_address"><?php if(isset($_SESSION['memberId'])){ echo $userData[0]['address']; } else echo 'Please fill your address by selecting new address'; ?> </textarea>
                                    </div>
                                </div>
                            </div>
                        
                            <label class="radio check_out_radio">
                              <input type="radio" name="part_1" id="new_address_checkbox" value="option2" onclick="selectedForm('new_address_form','address_form')">
                              Želim uporabiti drugi naslov
                            </label>
                            <div id="new_address_form">
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Ime:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="f_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Priimek:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="l_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Podjetje:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="company_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Matična številka:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="company_id">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">E-pošta:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="email_id" id="checkoutEmail">
                                        <div id="v-checkoutEmail"></div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Naslov vrstico1:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="address_1">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Naslov vrstico2:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="address_2">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Mesto:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="city">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Poštna številka:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="p_code">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Država:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="country">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="form_label">Regija/država:</label>
                                    <div class="controls">
                                        <input type="text" placeholder="" name="state">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="button" id="newaddress" class="btn btn-inverse" data-toggle="collapse" data-parent="#accordion2"  data-target="#collapseThree"  value="POTRDI">
                                </div>
                            </div>
                        </form>
                        <!-- first form ends here -->
                      </div>
                    </div>
                  </div>
                  <div class="accordion-group checkout_accordian checkoutForm2">
                    <div class="accordion-heading">
                      <a class="accordion-toggle accordian_text" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                        Korak 2: Način dostave 
                      </a>
                    </div>
                    <div id="collapseThree" class="accordion-body collapse">
                      <div class="accordion-inner">
                        <p>V primeru da želite posebno dostavo prosimo vpišite v komentar.</p>
                        <p class="checkout_shipping_rate">Poštnina</p>
                        <form method="post"  id="shipping_details">
                        	<label class="radio check_out_radio">
                              <input type="radio" name="" id="" value="option1" checked="checked">
                              Poštnina: Brezplačna dostava
                            </label>
                            <label>Napišite komentar o vašem naročilu</label>
    						<textarea rows="6" cols="30" class="input-block-level" id="shipping_textarea" name="comments"></textarea>
                            <input type="button" id="shipping-comments" class="btn btn-inverse pull-right" data-toggle="collapse" data-parent="#accordion2"  data-target="#collapseFour" value="POTRDI">
                            <div class="clearfix"></div>
                        </form>
                        
                        <!-- second form ends here -->
                      </div>
                    </div>
                  </div>
                  <div class="accordion-group checkout_accordian checkoutForm3">
                    <div class="accordion-heading">
                      <a class="accordion-toggle accordian_text" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                        Korak 3: Način plačila 
                      </a>
                    </div>
                    <div id="collapseFour" class="accordion-body collapse">
                      <div class="accordion-inner">
                        <p>Prosimo, izberite način plačila.</p>
                        <form method="post" id="payment_method">
                        	<label class="radio check_out_radio">
                              <input type="radio" name="wayofpayment" id="" value="account" checked="checked">
                              Plačajte z nakazilom na račun<br>
                           </label>
                           <label class="radio check_out_radio">
                              <input type="radio" name="wayofpayment" id="" value="paypal">
                               Plačajte s PayPal
                            </label>
                            <?php 
                            if(isset($_SESSION['memberId'])){
                            	print_r
                            	(' <label class="radio check_out_radio">
		                              <input type="radio" name="wayofpayment" id="" value="myaccount">
		                               Plačajte iz ML denarnice
		                            </label>
		                         ');
                              
							}
							else {}
							?>

                            <label>Napišite komentar o načinih plačila in željenih načinih plačila.</label>
    						<textarea rows="6" cols="30" class="input-block-level" id="order_comments"></textarea>
                            <label class="radio check_out_radio pull-left">
                              <input type="radio" name="terms" id="" value="terms">
                              Prebral sem in se strinjam s <a href="#">pogoji poslovanja </a>
                            </label>
                            <input type="button" href="" id="payment_method_button" class="btn btn-inverse pull-right" data-toggle="collapse" data-parent="#accordion2"  data-target="#collapseFive" value="POTRDI">
                            
                            <div class="clearfix"></div>
                        </form>
                        <!-- third form ends here -->
                        
                      </div>
                    </div>
                  </div>
                  <div class="accordion-group checkout_accordian checkoutForm4">
                    <div class="accordion-heading">
                      <a class="accordion-toggle accordian_text" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                        Korak 4: Potrdi naročilo
                      </a>
                    </div>
                    <div id="collapseFive" class="accordion-body collapse">
                      <div class="accordion-inner">
                      <form action="" method="post">
                        <table class="table table-hover checkout_table">
                              <thead>
                                <tr>
                                  <th>Ime izdelka</th>
                                  <th>Količina</th>
                                  <th>Cena na enoto</th>
                                  <th>Skupna cena</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
									if(isset($_SESSION['memberId']))
									{
										$getProductAmount = $manageContent->getSelectedProductsInCheckoutPage($_SESSION['memberId']);
									}
									else
									{
										$getProductAmount = $manageContent->getSelectedProductsInCheckoutPage('guest');
									}
								?>
                              </tbody>
                          </table>
                          <input type="hidden" id="userid" value="<?php if(isset($_SESSION['memberId'])){ echo $_SESSION['memberId']; } else echo $_SESSION['guestId']; ?>"  />
                          <input type="hidden" id="totalProductprice" value="<?php echo $getProductAmount ?>" />
                          <input type="button" href="" class="btn btn-inverse pull-right" id="checkoutdone" value="POTRDI" style="display:none;">
                          <input type="button" href="" class="btn btn-inverse pull-right" id="checkoutdonebymyaccount" value="POTRDI" style="display:none;">
                          
                          
                          <div class="clearfix"></div>
                      </form> 
                          <!-- paypal checkout button -->
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
                            <input type="hidden" name="return"  id="returnvalue" value="http://www.mojlife.com/paymentByPaypal.php?total_price=<?php echo $getProductAmount?>&m_id=<?php if(!isset($_SESSION['memberId'])) echo 'guest'; else echo $_SESSION['memberId'] ?>">
                            <input type="hidden" name="cancel_return" value="http://www.mojlife.com/cancel.php">
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    					  </form>
                          <!-- paypal checkout button ends here -->
                       
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <!--- rightcontainer ends here --->
    </div>
    <!--- body ends here --->

<script>
	// at the time of page load this codes takes the value of the total price at this page and then stores for future use
    var price = document.getElementById('paypal_amount').value;
    
    $( "#paypalform" ).submit(function( event ) {
        document.getElementById('paypal_amount').value = price;
    });

</script>


<?php
	//include footer
	include ('v-templates/footer.php');
?>