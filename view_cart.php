<?php
	session_start();
	$page_title = 'VIEW CARTS';
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

<!-- body starts here -->
    <div class="row-fluid">
    	<?php
			//include navbar section
			include 'v-templates/left_sidebar.php';
		?>
        <!--- rightcontainer starts here --->
        <div class="span9">
        	<div class="row-fluid">
        		<h2 class="page_heading">KOŠARICA</h2>
            </div>
            <div class="row-fluid">
            	<table class="table table-hover cart_table">
                      <thead>
                        <tr>
                          <th>Slika</th>
                          <th>Ime izdelka</th>
                          <th>Količina</th>
                          <th>Cena na enoto</th>
                          <th>Skupna cena</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
							if(!isset($_SESSION['memberId']))
							{
								$member = 'guest';
							}
							else
							{
								$member = $_SESSION['memberId'];
							}
							$getProductAmount = $manageContent->getSelectedProducts($member); 
						?>
                      </tbody>
                </table>
            </div>
                <?php $getVoucherSection = $manageContent->getAmount($getProductAmount); ?>
            </div>
            <img src="img/paypal.png" alt="paypal Verified">
            <img src="img/horizontal_solution_PP.gif" alt="paypal Solution">
        </div>
        <!--- rightcontainer ends here --->
    </div>
    <!--- body ends here --->

<?php
	//include footer
	include ('v-templates/footer.php');
?>