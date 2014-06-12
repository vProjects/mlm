<?php
	session_start();
	$page_title = 'EDIT PERSONAL DETAILS';
	if(!isset($_SESSION['memberId'])){
        header("Location: sign_up.php");
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
            <div class="row-fluid">
                <h2 class="page_heading">Edit Your Personal Details</h2>
            </div>
            
            <form action="v-includes/functions/function.updatePersonalDetails.php" class="form-horizontal" method="post">
                <h4 class="form_caption">Osebni podatki</h4>
                
    			<?php	$personal_details = $manageContent->updatePersonalDetails($membership_id); ?>
    
            </form>
        </div>
    <!--- rightcontainer ends here --->
	</div>
<!--- body ends here --->

<?php
	//include footer
	include ('v-templates/footer.php');
?>