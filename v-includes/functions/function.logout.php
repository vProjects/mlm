<?php
	session_start();
		
	unset($_SESSION['memberId']);
    unset($_SESSION['guestId']);
	session_destroy();
	
	header('Location: ../../');

?>