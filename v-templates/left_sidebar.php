<!-- leftcontainer starts here -->
    	<div class="span3 left_container">
        	<?php
				//checking for guest or member
				if(isset($_SESSION['memberId']))
				{
				    
					echo '<h4 class="left_container_heading"><span class="heading_text">MojLife</span></h4>
						 <div class="row-fluid">
							<ul class="left_container_categories">
								<li><a href="ewallet.php">Ewallet</a></li>
								<li><a href="my_tree.php">My Tree</a></li>
								<li><a href="editProfile.php">Edit Account Details</a></li>
								<li><a href="changePassword.php">Change Password</a></li>
								<li><a href="orderHistory.php">Order History</a></li>
								<li><a href="withdrawHistory.php">Withdraw History</a></li>
							</ul>
						</div>';
				}
				else 
				{ echo '';}
				
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
            
            <?php 
				//getting latest product list
				$latest_product = $manageContent->getLatestProducts(); 
			?>
        </div>
        <!-- leftcontainer ends here -->