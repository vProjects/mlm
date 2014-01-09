<?php
	session_start();
		
	unset($_SESSION['memberId']);
    unset($_SESSION['guestId']);
	unset($_SESSION['invalid_member']);
	session_destroy();
	
	header('Location: ../../');

?>