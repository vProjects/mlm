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
                    	<li><a href="index.php">Home</a></li>
						<?php 
							//getting category list
							$category_list = $manageContent->getCategoryList(); 
						?>
                        <li><a href="view_cart.php" onclick="">Moj voziček</a></li>
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
    
