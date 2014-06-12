<?php
	session_start();
	$page_title = 'Custom Page';
	//include header section
	if(!isset($_SESSION['memberId'])){
        $_SESSION['guestId'] = 'guest';
    }
	//include header section
	include 'v-templates/header.php';
?>

<?php
	//include navbar section
	include 'v-templates/navbar.php';
?>
<?php
	if(isset($GLOBALS['_GET']['id']))
	{
		$page_id = $GLOBALS['_GET']['id'];
	}
?>

<!-- body starts here -->
    <div class="row-fluid">
    	<?php
			//include left sidebar section
			include 'v-templates/left_sidebar.php';
		?>
        <!--- rightcontainer starts here --->
        <div class="span9">
            <?php
				//if id selected
				if(isset($page_id))
				{
					$content = $manageContent->getPageElement($page_id);
				}
				 
			?>
			
        </div>
        <!--- rightcontainer ends here --->
    </div>
    <!--- body ends here --->

<?php
	//include footer
	include ('v-templates/footer.php');
?>