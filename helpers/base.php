<?php
	
	/*
	--------------------------------------------------------------------------
		INCLUDE helpers
	--------------------------------------------------------------------------
	*/

	function ams_include($inc)
	{
		include("includes/" . $inc . ".php");
	}

	function ams_template($tmp)
	{
		include("templates/" . $tmp . ".php");
	}

	function db_ams()
	{
		require_once "db/cxn.php";
	}
	function dd($object)
	{
        die(var_dump($object));
	}

?>