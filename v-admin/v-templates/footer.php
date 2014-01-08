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
</script>

<!-- script added to load the file browser automatically for ckeditor -->
<script>
CKEDITOR.replace('editor1', { filebrowserBrowseUrl: 'ss/index.html'});
</script>
</body>
</html>