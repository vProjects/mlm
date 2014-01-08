// JavaScript Document

/*
	method for selecting form of checkout page.
	Auth: Dipanjan
*/

function selectedForm(displaying_form,omitting_form){
	document.getElementById(displaying_form).style.display = 'block';
	document.getElementById(omitting_form).style.display = 'none';
}




function sendform(){
    $.ajax({
    type: "POST",
    url: "function.page2.php",
    data: jQuery("#billing_details").serialize(),
    cache: false,
    success:  function(data){
       alert(data); 
    }
  });

}




function sendForm(){
var form = new FormData($('#billing_details')[0]);
form.append('view_type','addtemplate');
$.ajax({
    type: "POST",
    url: "v-includes/functions/function.page2.php",
    data: form,
    cache: false,
    contentType: false,
    processData: false,
    success:  function(data){
        //alert("---"+data);
        alert("Settings has been updated successfully.");
    }
});
}