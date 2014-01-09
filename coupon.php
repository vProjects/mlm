<?php
	session_start();
	$page_title = 'COUPON';
	//include header section
	if(!isset($_SESSION['memberId'])){
        $_SESSION['guestId'] = 'guest';
    }
	if(isset($_SESSION['invalid_member'])){
        header("Location: invalidMember.php");
    }
	//include header section
	include 'v-templates/header.php';
?>

<?php
	//include navbar section
	include 'v-templates/navbar.php';
?>
<?php
	if(isset($GLOBALS['_GET']['coupon']))
	{
		$coupon_id = $GLOBALS['_GET']['coupon'];
	}
	else if(isset($GLOBALS['_GET']['category']))
	{
		$category = $GLOBALS['_GET']['category'];
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
        <div class="addthis_share_button">    
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
            <a class="addthis_button_facebook"></a>
            <a class="addthis_button_twitter"></a>
            <a class="addthis_button_pinterest_share"></a>
            <a class="addthis_button_google_plusone_share"></a>
            <a class="addthis_button_linkedin"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52a388fc47345ce3"></script>
           
            <!-- AddThis Button END -->
        </div>
            <?php
				//if product id selected
				if(isset($coupon_id))
				{
					$getCouponDetails = $manageContent->getCouponDetails($coupon_id);
				}
				//if category is selected
				else if(isset($category))
				{
					echo '<h4 class="left_container_heading"><span class="heading_text">'.$category.'</span></h4>';
					$getCoupons = $manageContent->getCoupons($category);
                    
					//echo '</div>';
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