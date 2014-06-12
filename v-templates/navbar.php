<!--- navbar part starts here --->
    <div class="row-fluid">
        <div class="navbar">
            <div class="navbar-inner navbar_inner">
             
             <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
              
               <!-- Everything you want hidden at 940px or less, place within here -->
                <div class="nav-collapse collapse">
                    <ul class="nav">
                    	<li><a href="index.php">Domov</a></li>
						<?php 
							//getting category list
							$category_list = $manageContent->getCategoryList(); 
						?>
                        <li><a href="view_cart.php" onclick="">Moj voziček</a></li>
                        <?php
							//checking the invalid conditions
							$invalid_conditions = $manageContent->getInvalidConditions($_SESSION['memberId']);
							if($invalid_conditions[1] == 0 && isset($_SESSION['memberId']))
							{
								echo '<li><a href="invalidMember.php" style="color:#ff0000;">POSTANI VIP</a></li>';
							}
							if($invalid_conditions[0] == 1 && isset($_SESSION['invalid_member']))
							{
								unset($_SESSION['invalid_member']);
							}
							elseif($invalid_conditions[0] == 0 && isset($_SESSION['memberId']) && !isset($_SESSION['invalid_member']))
							{
								$_SESSION['invalid_member'] = 'Invalid Member';
							}
						?>
                    </ul>
                </div>   
            </div>
            <!-- div for showing success message--->
            <div class="alert alert-success" id="success_msg"></div>
            <!-- div for showing warning message--->
            <div class="alert alert-error" id="warning_msg"></div>
        </div>
    </div>
    <!--- navbar part ends here --->
    
