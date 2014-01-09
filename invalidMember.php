<?php
    session_start();
	$page_title = 'INVALID MEMBER';
    if(!isset($_SESSION['memberId'])){
        header("Location: sign_up.php");
    }
	if(!isset($_SESSION['invalid_member'])){
        header("Location: index.php");
    }
	// include header section
	include ('v-templates/header.php');
	 
	//checking the invalid conditions
	$invalid_conditions = $manageContent->getInvalidConditions($_SESSION['memberId']);      
?>

<?php
	//include navbar section
	include ('v-templates/navbar.php');
?>

    <!-- body starts here -->
    <div class="row-fluid">
        <!-- rightcontainer starts here -->
        <div class="span8 offset2">
        	<div class="row-fluid">
        		<h2 class="page_heading">Invalid Member</h2>
            </div>
            <div class="row-fluid">
            	<div class="span12">
                	<?php
						if($invalid_conditions[0] == 0 && $invalid_conditions[1] == 0)
						{
							echo '<h3>Niste potrdili svojega e-mail naslova. Prosimo aktivirajte svoj naslov z klikom na povezavo, ki ste jo dobili na vaš e-mail naslov.</h3>
							<h3>Niste zaključili s plačilom članarine. Prosimo kliknite na »Membership« spodaj nato pa pojdite v »moj voziček« in dokončajte nakup in plačilo »Membership« članarine.</h3>';
							$getMemberProduct = $manageContent->getMembershipProduct(); 
                            echo '</div>';
									
						}
						else if($invalid_conditions[0] == 0)
						{
							echo '<h3>Niste potrdili svojega e-mail naslova. Prosimo aktivirajte svoj naslov z klikom na povezavo, ki ste jo dobili na vaš e-mail naslov.</h3>';
						}
						else if($invalid_conditions[1] == 0)
						{
							echo '<h3>Niste zaključili s plačilom članarine. Prosimo kliknite na »Membership« spodaj nato pa pojdite v »moj voziček« in dokončajte nakup in plačilo »Membership« članarine.</h3>';
							$getMemberProduct = $manageContent->getMembershipProduct(); 
                            echo '</div>';
						}
						else
						{
							unset($_SESSION['invalid_member']);
							header("Location: index.php");
						}
						
					?>
                </div>
            </div>
        </div>
        <!-- rightcontainer ends here -->
    </div>
    <!-- body ends here --> 
    
<?php
	//include footer section
    unset($_SESSION['login_error']);
	include ('v-templates/footer.php');
?>  