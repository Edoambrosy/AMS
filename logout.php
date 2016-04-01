<?php
	/*
	--------------------------------------------------
		debugging message
	--------------------------------------------------
	*/
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	if(isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(), '', time()-4200, '/');
		// redirect_to("index.php");
	}

	if(isset($_SESSION))
	{
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		session_destroy();
	}

	header("location :http://localhost/github/AMS/index.php?p=logout");

	$failed = '<h1>Redirecting . . . </h1><p>If redirection takes too long you may click this <a href="index.php?p=logout">link</a></p>';

	echo $failed;
?>