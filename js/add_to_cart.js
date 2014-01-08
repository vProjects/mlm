// JavaScript Document
/*
	method for setting the product selected in cookie
	Auth: Dipanjan
*/
function setProductCookie(P_name,P_id,maxval){
  	var no_product = "no_product" + P_id;
	
	var cart_selected = getCookie('cart_is_selected');
	if(cart_selected == 'yes')
	{
		var product_id = getCookie(P_name);
		if(product_id == P_id)
		{
			var product_no = getCookie(no_product);
			if(product_no < maxval)
			{
				product_no++;
				createCookie(no_product,product_no,1);
			}
			else
			{
				createCookie(no_product,product_no,1);
				document.getElementById('warning_msg').innerHTML = '<b>Warning: Lahko izberete ta izdelek več kot' +maxval+ ' Krat</b>';
			    document.getElementById('warning_msg').style.display = 'block';
			    var body = $("body");
			    body.animate({scrollTop:170}, '500');
			    setInterval('$( "#warning_msg" ).hide()', 5000);
			    
			}
			
		}
		else
		{
			createCookie(P_name,P_id,1);
			createCookie(no_product,1,1);
		}
	}
	else
	{
		createCookie('cart_is_selected','yes',7);
		createCookie(P_name,P_id,1);
		createCookie(no_product,1,1);
	}
}

/*
	method for setting the coupon selected in cookie
	Auth: Dipanjan
*/
function setCouponCookie(C_name,C_id,maxval){
	var cookie_value = "mojolife";
  	var no_coupon = C_id + "-" + guid();
	var cart_selected = getCookie('cart_is_selected');
	if(cart_selected == 'yes')
	{
		var coupon_value = getCookie(C_name);
		if(coupon_value < maxval || coupon_value == 0)
		{
			coupon_value++;
			createCookie(C_name,coupon_value,1);
			createCookie(no_coupon,cookie_value,1);
		}
		else
		{
			document.getElementById('warning_msg').innerHTML = '<b>Warning: Lahko izberete ta kupon več kot ' +maxval+ ' Krat</b>';
			document.getElementById('warning_msg').style.display = 'block';
			var body = $("body");
			body.animate({scrollTop:170}, '500');
			setInterval('$( "#warning_msg" ).hide()', 5000);
		}
	}
	else
	{
		createCookie('cart_is_selected','yes',7);
		createCookie(C_name,1,1);
		createCookie(no_coupon,cookie_value,1);
	}
	
}

/*
	method for setting the membership product selected in cookie
	Auth: Dipanjan
*/
function setMembershipProductCookie(P_name,P_id){
  	var no_product = "no_product" + P_id;
	
	var cart_selected = getCookie('cart_is_selected');
	if(cart_selected == 'yes')
	{
		var product_id = getCookie(P_name);
		if(product_id == P_id)
		{
			/*var product_no = getCookie(no_product);*/
			document.getElementById('warning_msg').innerHTML = '<b>Warning: Lahko izberete več kot en izdelek</b>';
			document.getElementById('warning_msg').style.display = 'block';
			var body = $("body");
			body.animate({scrollTop:170}, '500');
			setInterval('$( "#warning_msg" ).hide()', 5000);
	
		}
		else
		{
			var member = getCookie('membership');
			if(member > 0)
			{
				document.getElementById('warning_msg').innerHTML = '<b>Boste morali kupiti samo en izdelek memberhsip ne izbrati več kot eno</b>';
				document.getElementById('warning_msg').style.display = 'block';
				var body = $("body");
			    body.animate({scrollTop:170}, '500');
			    setInterval('$( "#warning_msg" ).hide()', 5000);

			}
			else
			{
				createCookie(P_name,P_id,1);
				createCookie(no_product,1,1);
				createCookie('membership',1,7);
			}
		}
	}
	else
	{
		createCookie('cart_is_selected','yes',7);
		createCookie('membership',1,7);
		createCookie(P_name,P_id,1);
		createCookie(no_product,1,1);
	}
	return false;
}
/*
	method for setting the product quantity in shopping cart page
	Auth: Dipanjan
*/
function sendQuantity(product_id,maxval){
	var quantity = document.getElementById(product_id).value;
	if(quantity <= maxval)
	{
		var no_product = "no_product" + product_id;
		createCookie(no_product,quantity,1);
		location.reload();
	}
	else
	{
		document.getElementById('warning_msg').innerHTML = '<b>Warning: Lahko izberete enega izdelka več kot '+maxval+' Kosov</b>';
		document.getElementById('warning_msg').style.display = 'block';
		var body = $("body");
		body.animate({scrollTop:170}, '500');
        setInterval('$( "#warning_msg" ).hide()', 5000);
	}
}
/*
	method for delete product from product list in view_cart page
	Auth: Dipanjan
*/
function deleteProduct(product_id,product_name){
	var no_product = "no_product" + product_id;
	eraseCookie(product_name);
	eraseCookie(no_product);
	location.reload();
}

/*
	method for delete membership product from product list in view_cart page
	Auth: Dipanjan
*/
function deleteMembership(product_id,product_name){
	alert("Če ne kupujete ta članstvo izdelek, boste postali An neveljavna države!");
	alert("Ali ste prepričani, da želite izbrisati to??");
	var no_product = "no_product" + product_id;
	eraseCookie(product_name);
	eraseCookie(no_product);
	eraseCookie('membership');
	location.reload();
}

/*
	method for delete coupon from product list in view_cart page
	Auth: Dipanjan
*/
function deleteCouponProduct(C_id,C_name){
	var allCookies = document.cookie.split(";");
	var i=0;
	if(getCookie(C_name) == 1)
	{
		eraseCookie(C_name);
	}
	else
	{
		var quantity = getCookie(C_name);
		var set_quantity = quantity - 1;
		createCookie(C_name,set_quantity,1);
	}
	
	for(i=0; i<allCookies.length; i++)
	{
		var str = allCookies[i];
		var res = str.substring(0,12);
		if(res.trim() == C_id.trim())
		{
			var str_pos = allCookies[i].lastIndexOf("=");
			eraseCookie(allCookies[i].substring(0,str_pos));
			location.reload();
			break;
		}
	}
}

/*
	method for setting the product with quantity to the shopping cart
	Auth: Dipanjan
*/
function setProductQuantity(product_id,product_name,maxval){
	var quantity = document.getElementById(product_id).value;
	if(quantity <= maxval)
	{
		var no_product = "no_product" + product_id;
		if(getCookie('cart_is_selected') == 'yes')
		{
			if(getCookie(product_name) == product_id)
			{
				createCookie(no_product,quantity,1);
				document.getElementById('success_msg').innerHTML = '<b>Success:</b> Uspešno ste dodali <b>' + product_name + ' </b> v nakupovalni voziček';
				document.getElementById('success_msg').style.display = 'block';
			}
			else
			{
				createCookie(product_name,product_id,1);
				createCookie(no_product,quantity,1);
				document.getElementById('success_msg').innerHTML = '<b>Success:</b> Uspešno ste dodali <b>' + product_name + ' </b> v nakupovalni voziček';
				document.getElementById('success_msg').style.display = 'block';
			}
		}
		else
		{
			createCookie('cart_is_selected','yes',7);
			createCookie(product_name,product_id,1);
			createCookie(no_product,quantity,1);
			document.getElementById('success_msg').innerHTML = '<b>Success:</b> Uspešno ste dodali <b>' + product_name + ' </b> v nakupovalni voziček';
			document.getElementById('success_msg').style.display = 'block';
		}
	}
	else
	{
		document.getElementById('warning_msg').innerHTML = '<b>Warning: Lahko izberete enega izdelka več kot '+maxval+' Kosov</b>';
		document.getElementById('warning_msg').style.display = 'block';
        var body = $("body");
        body.animate({scrollTop:170}, '500');
        setInterval('$( "#warning_msg" ).hide()', 5000);

	}
	
}

/*
	method for setting the coupon with quantity to the shopping cart
	Auth: Dipanjan
*/
function setCouponQuantity(C_id,C_name,maxval){
	var quantity = document.getElementById(C_id).value;
	if(quantity <= maxval)
	{
		var cookie_value = "mojolife";
  		var no_coupon = C_id + "-" + guid();
		if(getCookie('cart_is_selected') == 'yes')
		{
			createCookie(C_name,quantity,1);
			var counter = 0;
			var allCookies = document.cookie.split(";");
			var i=0;
			for(i=0; i<allCookies.length; i++)
			{
				var str = allCookies[i];
				var res = str.substring(0,12);
				if(res.trim() == C_id.trim())
				{
					var str_pos = allCookies[i].lastIndexOf("=");
					eraseCookie(allCookies[i].substring(0,str_pos));
				}
			}
			for(counter=0; counter<quantity; counter++)
			{
				var coupon_no = C_id + "-" + guid();
				createCookie(coupon_no,cookie_value,1);
			}
			document.getElementById('success_msg').innerHTML = '<b>Success:</b> Uspešno ste dodali  <b>' + C_name + ' </b> v nakupovalni voziček';
			document.getElementById('success_msg').style.display = 'block';
			
		}
		else
		{
			createCookie('cart_is_selected','yes',7);
			createCookie(C_name,quantity,1);
			createCookie(no_coupon,cookie_value,1);
			document.getElementById('success_msg').innerHTML = '<b>Success:</b> Uspešno ste dodali <b>' + C_name + ' </b>  v nakupovalni voziček';
			document.getElementById('success_msg').style.display = 'block';
		}
	}
	else
	{
		document.getElementById('warning_msg').innerHTML = '<b>Warning: Lahko izberete enega izdelka več kot '+maxval+' Kosov</b>';
		document.getElementById('warning_msg').style.display = 'block';
        var body = $("body");
        body.animate({scrollTop:170}, '500');
        setInterval('$( "#warning_msg" ).hide()', 5000);

	}
	
}

/*
	method for creating a new cookie
	Auth: Dipanjan
*/

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}
/*
	method for getting value of cookie whoose name is given
	Auth: Dipanjan
*/

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}
/*
	method for deleting all cookies set in the browser
	Auth: Dipanjan
*/


function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
    	var cookie = cookies[i];
    	var eqPos = cookie.indexOf("=");
    	var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    	if(name.trim() == 'PHPSESSID'){
    	    continue;
    	}
    	document.cookie = name + "=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

/* method to find all the products in the cart 
   atuthor: Vasu Naman
   */
  
  function checkAllProduct(){
      var cookies = document.cookie.split(";");
      var productName = '';
      for(var i=1; i<cookies.length; i++){
          var cookie = cookies[i];
          var eqPos = cookie.indexOf("=");
          if(cookies[i].substr(eqPos+1).substr(0,2) == 'P_'){
            var productName = productName + cookies[i].substr(eqPos+1)+',';
          }
		  else if(cookies[i].substr(eqPos+1).substr(0,2) == 'M_'){
			 var productName = productName + cookies[i].substr(eqPos+1)+','; 
		  }
		  else if(cookies[i].substr(eqPos+1) == 'mojolife'){
			  var productName = productName + cookies[i].substr(0,12)+',';
		  }
      }
      return productName;
  }
  


/*
	method for deleting a cookie whoose name is given
	Auth: Dipanjan
*/

function eraseCookie(name) {
    createCookie(name,"",-1);
}

/*
	method for alert warning message
	Auth: Dipanjan
*/

function alertWarning(msg) {
    document.getElementById('warning_msg').innerHTML = '<b>' +msg+ '</b>';
	document.getElementById('warning_msg').style.display = 'block';
	var body = $("body");
	body.animate({scrollTop:170}, '500');
	setInterval('$( "#warning_msg" ).hide()', 5000);
}


/*function ReadCookie()
{
   var allcookies = document.cookie;
   alert("All Cookies : " + allcookies );

   // Get all the cookies pairs in an array
   cookiearray  = allcookies.split(';');

   // Now take key value pair out of this array
   for(var i=0; i<cookiearray.length; i++){
      name = cookiearray[i].split('=')[0];
      value = cookiearray[i].split('=')[1];
      alert("Key is : " + name + " and Value is : " + value);
   }
}*/

/*
	method for creating unique value
	Auth: Dipanjan
*/

function guid() {
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
         s4() + '-' + s4() + s4() + s4();
}
function s4() {
  return Math.floor((1 + Math.random()) * 0x10000)
             .toString(16)
             .substring(1);
}

/*
	method for checking withdraw amount
	Auth: Dipanjan
*/
function checkingWithdrawAmount(){
	var amount = document.getElementById('withdraw_amount').value;
	if(amount >= 30)
	{
		document.getElementById('withdraw_form').submit();
	}
	else
	{
		alertWarning('Vi življati umakniti Atleast 30 €');
	}
}
