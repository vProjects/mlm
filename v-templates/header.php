<?php
	include 'v-includes/BLL.getData.php';
	$manageContent = new BLL_manageData();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel='shortcut icon' href='img/mojlife.ico'/> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css" />


<script src="js/validate_function.js" type="text/javascript"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/add_to_cart.js" type="text/javascript"></script>
<script src="js/v_function.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="js/checkout.js" type="text/javascript"></script>
<script>
    //calls carousel automatically
    $('.carousel').carousel()
</script>

<title><?php echo $page_title; ?></title>
<meta name="google-translate-customization" content="a7a7a56517a26ced-dddd86859be5e0cd-g7094797fa66a94b4-c"></meta>
</head>

<body>
<?php if(isset($_SESSION['memberId'])){ $money_member = $manageContent->getMoneyDetails($_SESSION['memberId']); } ?>
<!-- body container starts here -->
<div class="container body_container">
	<!--- header part starts here --->
	<div class="row-fluid">
    	<div class="span5">
        	<a href="index.php"><img src="img/logo.png" class="logo"/></a>
        </div>
        
        <?php if(isset($_SESSION['memberId'])){ echo '<div class="span7">'; } else { echo '<div class="span5 offset2">'; } ?>
        	<ul class="nav navbar_small pull-right">
            	<?php if(isset($_SESSION['memberId'])){ echo '<li class="dropdown" style="color:#000;margin-left: 0px; font-weight:bold;"> € '.$money_member[0].' / €'.$money_member[1].'</li>'; } else{ echo ''; } ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Moj račun<b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                    	<?php if(isset($_SESSION['memberId'])) { echo '<li><a href="ewallet.php">My Account</a></li>'; } else echo '';?>
                        <li><a href="view_cart.php">Nakupovalni voziček</a></li>
                        <li><a href="check_out.php">Blagajna</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="view_cart.php">Moj voziček</a></li>
                <?php if(isset($_SESSION['memberId'])){ echo '<li class="dropdown" style="color:red;"> Login As '.$manageContent->getMemberName($_SESSION['memberId']).'</li>'; } else{ echo ''; } ?>
                <li class="dropdown"><a href="login.php"><?php if(isset($_SESSION['memberId'])){ echo '<a href="v-includes/functions/function.logout.php">Odjava</a>';} else echo 'Prijava'; ?></a></li>
                <li class="dropdown"><a href="sign_up.php">Registracija</a></li>
            </ul>
            <div class="input-prepend search_box pull-right">
                <div id="google_translate_element" class="pull-left"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'bs,de,el,es,fr,hr,hu,it,mk,pt,ru,sl,sq,sr,tr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
        </div>
    </div>
    <!--- header part ends here --->