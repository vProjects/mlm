<?php
	include 'v-includes/BLL.getData.php';
	$manageContent = new BLL_manageData();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel='shortcut icon' href='img/mojlife.ico'/> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" />

<script src="js/add_to_cart.js" type="text/javascript"></script>
<script src="js/validate_function.js" type="text/javascript"></script>
<script src="js/v_function.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script>
    //calls carousel automatically
    $('.carousel').carousel()
</script>
<!-- code added by vasu naman  starts here -->
<script type="text/javascript">
$(document).ready(function(){
    
 
    
    $('#newaddress').click(function(){
        
        var data;
        if($("#existing_address").is(":checked")){
            var address = $('.uneditable-textarea').val();
            if(address == "Please fill your address by selecting new address "){
                alert('Please Enter you address by selecting the "I want to use new address"');
                $('.check_out_radio')[1].click();
                return false;
            }
            else
                data = 'refData=olddata&u=uni';
        }
        else{
			var validiateEmail = validiateCheckoutForm();
			if(validiateEmail == 0)
			{
				return false;
			}
            data = 'f_name='+ $('#billing_details .controls input[name=f_name]').val()+
                    '&l_name='+$('#billing_details .controls input[name=l_name]').val()+
                    '&company_name='+$('#billing_details .controls input[name=company_name]').val()+
                    '&company_id='+$('#billing_details .controls input[name=company_id]').val()+
                    '&address_1='+$('#billing_details .controls input[name=address_1]').val()+
                    '&address_2='+$('#billing_details .controls input[name=address_2]').val()+
                    '&city='+$('#billing_details .controls input[name=city]').val()+
                    '&p_code='+$('#billing_details .controls input[name=p_code]').val()+
                    '&country='+$('#billing_details .controls input[name=country]').val()+
                    '&state='+$('#billing_details .controls input[name=state]').val()+
					'&email_id='+$('#billing_details .controls input[name=email_id]').val()+
                    '&refData=newdata&u=uni';
         }       
                
        
        $.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: data,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
                $('.checkoutForm2').css({'pointer-events':'fill','background':'#F8F8F8','opacity':'1'});
				console.log(result);
                $("").html('');
                return false;
            }});
         
    });
    
    
    $('#shipping-comments').click(function(){
        
        var shippingComment = $('#shipping_textarea').val();
        var shipdata = 'shipcom='+shippingComment+'&refData=shipdata&u=unk';
        
        $.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: shipdata,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
                $('.checkoutForm3').css({'pointer-events':'fill','background':'#F8F8F8','opacity':'1'});
				console.log(result);
                $("").html('');
                return false;
        }});

        
    });
    
    
    $('#payment_method_button').click(function(){
        var payment_method = $("#payment_method input[name=wayofpayment]:checked").val();
        var order_comments = $('#order_comments').val();
        if(!$("#payment_method input[name=terms]").is(':checked')){
            alert('Please accept the terms and condition');
            return false;
        }
        
        if(payment_method == 'paypal'){
            document.getElementById('paypalform').style.display = "block";
            document.getElementById('checkoutdone').style.display = "none";
            document.getElementById('checkoutdonebymyaccount').style.display = "none";
        }
        else if(payment_method == 'account'){
            document.getElementById('paypalform').style.display = "none";
            document.getElementById('checkoutdonebymyaccount').style.display = "none";
            document.getElementById('checkoutdone').style.display = "block";            
        }
        else if(payment_method == 'myaccount'){
            document.getElementById('paypalform').style.display = "none";
            document.getElementById('checkoutdone').style.display = "none"; 
            document.getElementById('checkoutdonebymyaccount').style.display = "block";           
		}
        
        var paymentData = 'paymentMethod='+payment_method+'&orderCom='+order_comments+'&refData=paymentOption&u=unk';

        $.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: paymentData,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
                $('.checkoutForm4').css({'pointer-events':'fill','background':'#F8F8F8','opacity':'1'});
				// adding the order id in the paypal form
					var paypalString = $('#paypalform input[name=return]').val();
					paypalString = paypalString.trim();
					paypalString = paypalString + '&order_id='+result;
					$('#paypalform input[name=return]').val(paypalString);
                $("").html('');
                return false;
        }});
        
        
    });
    
    
    $('#checkoutdone').click(function(){
        var allProducts = checkAllProduct();
        allProducts = allProducts.substr(0,allProducts.length-1);
        var memberId = document.getElementById('userid').innerHTML;
        var totalPrice = document.getElementById('totalProductprice').innerHTML;
        
        payment = 'totalPrice='+totalPrice+'&memberid='+memberId+'&allProducts='+allProducts+'&refData=payment&u=unk';
        
         $.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: payment,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
                $("").html('');
                 window.location = 'paymentByAccount.php';
                 deleteAllCookies();
                return false;
        }});

    });
    
    $('#checkoutdonebymyaccount').click(function(){
        var allProducts = checkAllProduct();
        allProducts = allProducts.substr(0,allProducts.length-1);
        var memberId = document.getElementById('userid').innerHTML;
        var totalPrice = document.getElementById('totalProductprice').innerHTML;
        
        payment = 'totalPrice='+totalPrice+'&memberid='+memberId+'&allProducts='+allProducts+'&refData=mypayment&u=unk';
        
         $.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: payment,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
                $("").html('');
                 window.location = 'paymentByAccount.php';
                 deleteAllCookies();
                return false;
        }});

    });    
    
    
    
    
    // to change the slider images in the product details page
    $('.prductSmallImage').click(function(){
        var clickedImage = $(this).attr('src');
        var mainImage = $('.product_img').attr('src');
        $('.product_img').attr('src',clickedImage);
        $(this).attr('src',mainImage);
        event.preventDefault();
    });
    
    
    
    // at the time of page load this codes takes the value of the total price at this page and then stores for future use
    var price = document.getElementById('paypal_amount').value;
    
    $( "#paypalform" ).submit(function( event ) {
        document.getElementById('paypal_amount').value = price;
    });
    
    
    
	
	
    
  });
  
  
    
</script>
<!-- ends here  -->
<title><?php echo $page_title; ?></title>
<meta name="google-translate-customization" content="a7a7a56517a26ced-dddd86859be5e0cd-g7094797fa66a94b4-c"></meta>
</head>

<body>
<!-- body container starts here -->
<div class="container body_container">
	<!--- header part starts here --->
	<div class="row-fluid">
    	<div class="span6">
        	<a href="index.php"><img src="img/logo.png" class="logo"/></a>
        </div>
        
        <div class="span5 offset1">
        	<ul class="nav navbar_small pull-right">
            	<li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Moj račun<b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                    	<?php if(isset($_SESSION['memberId'])) { echo '<li><a href="ewallet.php">My Account</a></li>'; } else echo '';?>
                        <li><a href="view_cart.php">Nakupovalni voziček</a></li>
                        <li><a href="check_out.php">Blagajna</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="view_cart.php">Moj voziček</a></li>
                <li class="dropdown"><a href="login.php"><?php if(isset($_SESSION['memberId'])){ echo '<a href="v-includes/functions/function.logout.php">Odjava</a>';} else echo 'Prijava'; ?></a></li>
                <li class="dropdown"><a href="sign_up.php">Registracija</a></li>
            </ul>
            <div class="input-prepend search_box pull-right">
                <div id="google_translate_element" class="pull-left"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'bs,de,el,es,fr,hr,hu,it,mk,pt,ru,sl,sq,sr,tr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
        </div>
    </div>
    <!--- header part ends here --->