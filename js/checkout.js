// JavaScript Document
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
			
			 var memberId = document.getElementById('userid').value;
			 var totalPrice = document.getElementById('totalProductprice').value;
			 data = 'totalPrice='+totalPrice+'&memberid='+memberId+'&refData=memberbalancecheck&u=unk';
			
			$.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: data,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
				if(result == 'You have not Sufficient balance!!')
				{
					alert(result);
					return false;
				}
				else
				{
					document.getElementById('paypalform').style.display = "none";
					document.getElementById('checkoutdone').style.display = "none"; 
					document.getElementById('checkoutdonebymyaccount').style.display = "block";
				}
                $("").html('');
        		}});          
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
        var memberId = document.getElementById('userid').value;
        var totalPrice = document.getElementById('totalProductprice').value;
        
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
        var memberId = document.getElementById('userid').value;
        var totalPrice = document.getElementById('totalProductprice').value;
        
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
	
	//to select the country and state dropdown list
	$('#signup_country').change(function() {
		var country_name = $(this).val();
		
		data = 'country='+country_name+'&refData=country&u=unk';
		
		$.ajax({
            type: "POST",
            url:"v-includes/functions/function.saveData.php",
            data: data,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
                $('#signup_state').html(result);
                return false;
        }});
		
    });
	
    
  });
  