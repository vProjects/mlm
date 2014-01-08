// JavaScript Document
//for form validation author ANAND
//function for form validations
function validateRequiredField(id_name,err_id)
{
	var x = document.getElementById(id_name).value;
	if(x == "")
	{
		//make the background color red
		document.getElementById(id_name).style.backgroundColor = '#F6D3D3';
		//showing the msg
		document.getElementById(err_id).innerHTML = '**Prosim izpolnite polje';
		document.getElementById(err_id).style.color = 'red';
		result = 0;
		//document.getElementById('btn_submit').disabled = 'true';
		exit();
	}
	else
	{
		//make the background color normal if valid
		document.getElementById(id_name).style.backgroundColor = '#ffffff';
		result = 1;
	}
}
//function for checking valid email
function validateEmail(id_name)
{
	var textbx = document.getElementById(id_name);
	var input_value = document.getElementById(id_name).value;
	//check the field is empty
	if(input_value == "")
	{
		textbx.style.backgroundColor = '#F6D3D3';
		result = 0;
	}
	//If not empty then check for email validation
	else
	{
		var x=input_value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			alert("Invalid Email");
			textbx.style.backgroundColor = '#F6D3D3';
			result = 0;
  		}
		else
		{
			textbx.style.backgroundColor = '#ffffff';
			result = 1;
		}
	}
}

//function for checkbox validiation
function validiateRadio(id_name,err_id){
	var check = document.getElementById(id_name).checked;
	
	if(check == false)
	{
		document.getElementById(err_id).innerHTML = '**Prosim se dogovorijo za pogoje in stanje';
		document.getElementById(err_id).style.color = 'red';
		exit();
	}
}

function checkResult(err_id)
{
	if(result == 0)
	{
		//alert('Please check '+alert_value);
		document.getElementById(err_id).innerHTML = '**Prosimo izpolnite polja pravilno';
		document.getElementById(err_id).style.color = 'red';
		//document.getElementById('btn_submit').disabled = 'true';
		exit();
	}
}
function checkResultEmail(err_id)
{
	if(result == 0)
	{
		//alert('Please check '+alert_value);
		document.getElementById(err_id).innerHTML = '**Prosimo izpolnite polja pravilno';
		document.getElementById(err_id).style.color = 'red';
		//document.getElementById('btn_submit').disabled = 'true';
		return 0;
	}
	else
	{
		return 1;
	}
}
function checkEmptyField(id_name_1)
{
	var y = document.getElementById(id_name_1).value;
	if(y == null || y == "")
	{
		document.getElementById(id_name_1).style.backgroundColor = "#000";
		document.getElementById('btn_submit').disabled = 'true';
		exit(); 
	}
}
function validateForm(form_name)
{
	validateRequiredField('v_f_name','err_f_name');
	validateEmail('v_email');
	checkResult('err_email');
	validateRequiredField('v_contact_no','err_cntct');
	validateRequiredField('v_senior_id','err_senior_id');
	validateRequiredField('v_address','err_address');
	validateRequiredField('v_password','err_pass');
	validateRequiredField('v_con_password','err_con_pass');
	validiateRadio('v_term','err_term');
	//submit the contact form
	document.getElementById(form_name).submit();
}
// validiation of checkout form
function validiateCheckoutForm()
{
	validateEmail('checkoutEmail');
	var return_value = checkResultEmail('v-checkoutEmail');
	return return_value;
}