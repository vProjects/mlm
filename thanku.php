<?php
    session_start();
    $page_title = 'THANK YOU';
    if(!isset($_SESSION['memberId'])){
        $_SESSION['guestId'] = 'guest';
    }
    // include header section
    include 'v-templates/header.php';
	unset($_SESSION['uniqueid']);
?>
<?php
    //include navbar section
    include 'v-templates/navbar.php';
?>
<!-- deleting cookies -->
<script type="text/javascript">
	deleteAllCookies();
</script>
<!-- body starts here -->
    <div class="row-fluid">
    	<?php
			//include navbar section
			include 'v-templates/left_sidebar.php';
		?>
        <!--- rightcontainer starts here --->
        <div class="span9">
        	<div class="row-fluid">
        		<h2 class="page_heading">Your Order Has Been Processed!</h2>
            </div>
            <div class="row-fluid">
            	<p>Your order has been successfully processed!</p>
                <p>You can view your order on mail or view history by going to the my account page and by clicking on history.</p>
                <p>If your purchase has an associated download, you can go to the account downloads page to view them.</p>
                <p>Please direct any questions you have to the store owner.</p>
                <p>Thanks for shopping with MOJLIFE!</p>
            </div>
        </div>
	</div>
<!--- body ends here --->



<?php
    //include footer section
    include 'v-templates/footer.php';
?> 