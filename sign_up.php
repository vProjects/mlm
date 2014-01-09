<?php
    session_start();
	$page_title = 'SIGN UP';
    if(!isset($_SESSION['memberId'])){
        $_SESSION['guestId'] = 'guest';
    }
    else {
        header('Location: ewallet.php');
    }
	//include header section
	include 'v-templates/header.php';
	
?>

<?php
	//include navbar section
	include 'v-templates/navbar.php';
	//checking for get value
	if(!empty($GLOBALS['_GET']))
	{
		if(isset($GLOBALS['_GET']['msg']))
		{
			echo '<script> alertWarning("'.$GLOBALS['_GET']['msg'].'"); </script>';
		}
		else
		{
			echo "";
		}
	}
	else
	{
		echo "";
	}
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
        		<h2 class="page_heading">Registracija računa</h2>
                <p>Če že imate račun pri nas se prosimo prijavite na strani za prijavo.</p>
            </div>
            <div class="row-fluid">
            	<form action="v-includes/functions/function.signup.php" id="signup_form" 
                class="form-horizontal" method="post">
                	<h4 class="form_caption">Osebni podatki</h4>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Ime:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="f_name" id="v_f_name">
                            <div id="err_f_name"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Priimek:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="l_name">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">E-pošta:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="email_id" id="v_email">
                            <div id="err_email"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Kontaktna št:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="contact_no" id="v_contact_no">
                            <div id="err_cntct"></div>
                        </div>
                    </div>
                     <div class="control-group">
                        <label class="control-label" id="form_label">ID številka priporočitelja:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="Senior_id" id="v_senior_id">
                            <div id="err_senior_id"></div>
                        </div>
                    </div>
                    
                    <h4 class="form_caption">Vaš naslov</h4>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Naslov 1:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="address1" id="v_address">
                            <div id="err_address"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Naslov 2:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="address2">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Mesto:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="city">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Poštna številka:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="postal_code">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Regija/država:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="state">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Država:</label>
                        <div class="controls">
                        	<input type="text" placeholder="" name="country">
                        </div>
                    </div>
                    
                    <h4 class="form_caption">Članstvo</h4>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Izberite članstvo:</label>
                        <div class="controls">
                        	<?php $getMemberProduct = $manageContent->getMembershipProduct(); ?>
                            </div>
                            </div>
                        </div>

                    <h4 class="form_caption">Geslo</h4>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Geslo:</label>
                        <div class="controls">
                        	<input type="password" placeholder="" name="password" id="v_password">
                            <div id="err_pass"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" id="form_label">Potrditev gesla:</label>
                        <div class="controls">
                        	<input type="password" placeholder="" name="confirm_password" id="v_con_password">
                            <div id="err_con_pass"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                        	<label class="checkbox">
                            	<input type="checkbox" name="terms" id="v_term"> Prebral sem in se strinjam s pogoji poslovanja.
                                <div id="err_term"></div>
                            </label>
                            <input type="button" class="btn btn-inverse btn-large" id="btn_submit" 
                            value="PREDLOŽI" onclick="validateForm('signup_form')">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--- rightcontainer ends here --->
     </div>
    <!--- body ends here --->  

<?php
	//include footer
	include ('v-templates/footer.php');
?>