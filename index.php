<?php
	session_start();
	$page_title = 'HOME';
    if(!isset($_SESSION['memberId'])){
        $_SESSION['guestId'] = 'guest';
    }
	// include header section
	include 'v-templates/header.php';
	$category = "Posebna ponudba";
?>

<?php
	//include navbar section
	include 'v-templates/navbar.php';
?>

   <!-- body starts here -->
    <div class="row-fluid">
    	<?php
			//include left sidebar section
			include 'v-templates/left_sidebar.php';
		?>
        <!-- rightcontainer starts here -->
        <div class="span9">
        	<?php include 'v-templates/slider.php'; ?>
            <h4 class="left_container_heading"><span class="heading_text">Kupon</span></h4>
            
            <?php $getCoupons = $manageContent->getCoupons("Latest"); ?>
            
            
            <h4 class="left_container_heading"><span class="heading_text">Posebna ponudba</span></h4>
            
            <?php $getProducts = $manageContent->getProducts($category); ?>
        </div>
        <!-- rightcontainer ends here -->
    </div>
    <!-- body ends here -->
    
<?php
	//include footer section
	include 'v-templates/footer.php';
?>  