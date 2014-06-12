<?php
    session_start();
	$page_title = 'INVALID MEMBER';
    if(!isset($_SESSION['memberId'])){
        header("Location: sign_up.php");
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
        <?php
			if($invalid_conditions[0] == 1)
			{
				//include left sidebar section
				include 'v-templates/left_sidebar.php';
				$right_con = 'span8';
			}
			else
			{
				$right_con = 'span8 offset2';
			}
		?>
        <!-- rightcontainer starts here -->
        <div class="<?php echo $right_con; ?>">
        	<div class="row-fluid">
        		<!--<h2 class="page_heading">Invalid Member</h2>-->
            </div>
            <div class="row-fluid">
            	<div class="span12">
                	<?php
						if($invalid_conditions[0] == 0 && $invalid_conditions[1] == 0)
						{
							$getInvalidText1 = $manageContent->getInvalidMemberContent(1);
							$getInvalidText2 = $manageContent->getInvalidMemberContent(2);
							$getMemberProduct = $manageContent->getMembershipProduct(); 
                            echo '</div>';
									
						}
						else if($invalid_conditions[0] == 0)
						{
							$getInvalidText1 = $manageContent->getInvalidMemberContent(1);
						}
						else if($invalid_conditions[1] == 0)
						{
							$getInvalidText2 = $manageContent->getInvalidMemberContent(2);
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