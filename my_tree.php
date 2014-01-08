<?php
	session_start();
	$page_title = 'MY TREE';
	if(!isset($_SESSION['memberId'])){
        header("Location: sign_up.php?error=987654");
    }
	//include header section
	include 'v-templates/header.php';
	$membership_id = $_SESSION['memberId'];
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
        <!--- rightcontainer starts here --->
        <div class="span9">
            <h4 class="left_container_heading"><span class="heading_text">Tree Structure</span></h4>
            <div class="row-fluid">
              <!-- left column starts here --->
              
              <div class="span4">
                  <img class="img-polaroid" src="http://placehold.it/100X100&text=user%20icon">
                   <img class="img-polaroid img-mlm" src="img/p-c_connector.gif">
                   <p><span class="product_name">Your Membership Id:</span> <?php echo $membership_id; ?></p>
               </div>
               <!-- left column ends here --->
               <!-- middle column starts here --->
              <div class="span8">
                <?php $manageContent->getChildElements($membership_id); ?>
              </div>
              <!-- middle column ends here --->
            </div>
        </div>
        <!--- rightcontainer ends here --->
    </div>
    <!--- body ends here --->


<?php
	//include footer
	include ('v-templates/footer.php');
?>