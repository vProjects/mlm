 <!--footer starts here-->
    <div ><div id="footer" class="span12">
    	<div class="container">
        	<p class="credit">Powered by: Vyrazu Labs</p>
        </div>
    </div><!--footer ends here-->

<!--Import the bootstrap JS-->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<!--- cdn for calendar view date -->
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
	$(function() {
	  $( "#calender_date" ).datepicker();
	  $( "#calender_date" ).datepicker("option", "dateFormat","yy-mm-dd");
	 });
	 
	 $(function() {
	  $( "#calender_date2" ).datepicker();
	  $( "#calender_date2" ).datepicker("option", "dateFormat","yy-mm-dd");
	 });
</script>

<!-- script added to load the file browser automatically for ckeditor -->
<script>
CKEDITOR.replace('editor1', { filebrowserBrowseUrl: 'ss/index.html'});
CKEDITOR.replace('editor2', { filebrowserBrowseUrl: 'ss/index.html'});
</script>

<script>
	
	//to select the country and state dropdown list
	$('#addMember_country').change(function() {
		var country_name = $(this).val();
		
		data = 'country='+country_name+'&refData=country&u=unk';
		
		$.ajax({
            type: "POST",
            url:"v-includes/functions/function.asyncData.php",
            data: data,
            beforeSend:function(){
                // this is where we append a loading image
                $('').html('');
              },
            success:function(result){
                $('#addMember_state').html(result);
                return false;
        }});
		
    });
</script>

</body>
</html>