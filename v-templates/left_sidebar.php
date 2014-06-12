<!-- leftcontainer starts here -->
    	<div class="span3 left_container">
        	<?php
				//checking for guest or member
				if(isset($_SESSION['memberId']))
				{
					//checking the invalid conditions
					$invalid_conditions = $manageContent->getInvalidConditions($_SESSION['memberId']);
				    
					echo '<h4 class="left_container_heading"><span class="heading_text">MojLife</span></h4>
						 <div class="row-fluid">
							<ul class="left_container_categories">';
							if($invalid_conditions[1] == 0)
							{
								echo '<li><a href="my_wallet.php">ML Wallet</a></li>';
							}
							else
							{
								echo '<li><a href="ewallet.php">ML Wallet</a></li>';
							}
					echo '<li><a href="add_money.php">Add Money To ML Wallet</a></li>
							<li><a href="my_tree.php">My Tree</a></li>
							<li><a href="editProfile.php">Edit Account Details</a></li>
							<li><a href="editPersonalDetails.php">Edit Personal Details</a></li>
							<li><a href="changePassword.php">Change Password</a></li>
							<li><a href="orderHistory.php">Order History</a></li>
							<li><a href="withdrawHistory.php">Withdraw History</a></li>
							</ul>
						</div>';
				}
				
			?>
            <h4 class="left_container_heading"><span class="heading_text">Kategorije</span></h4>
             <div class="row-fluid">
                <ul class="left_container_categories">
                    <?php 
						//getting category list
						$category_list = $manageContent->getCategoryList(); 
					?>
                </ul>
            </div>
            <h4 class="left_container_heading"><span class="heading_text">Kupon Kategorije</span></h4>
             <div class="row-fluid">
                <ul class="left_container_categories">
                    <?php 
						//getting category list
						$category_list = $manageContent->getCouponCategoryList(); 
					?>
                </ul>
            </div>
            
            <div id="latest_products">
            <?php 
				//getting latest product list
				$latest_product = $manageContent->getLatestProducts(); 
			?>
            </div>
        </div>
        <!-- leftcontainer ends here -->