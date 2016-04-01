<?php
	/*
	--------------------------------------------------
		debugging message
	--------------------------------------------------
	*/
/*	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
*/

	if(isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(), '', time()-4200, '/');
	}
	if(isset($_SESSION))
	{
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		session_destroy();
	}
	header("Location: ?p=signup_signin");



?>