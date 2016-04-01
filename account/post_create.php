<?php
if(isset($_POST['submit']))
{
	/*
	------------------------------------------
		if the sign up form has been submitted
	------------------------------------------
	*/
    //-----------------------------------
    	#receive form variables and validate
    //-----------------------------------
    // var_dump($_POST);
    $name = mysql_real_escape_string($_POST["name"]);
    $email = mysql_real_escape_string($_POST["email"]);
    $password = md5(mysql_real_escape_string($_POST["password"]));
    $address = mysql_real_escape_string($_POST["address"]);
    $city = mysql_real_escape_string($_POST["city"]);

    if((empty($name) == true || empty($email) == true || empty(mysql_real_escape_string($_POST["password"])) == true || empty($address)==true || empty($city) == true))
    	die( "<p style='color:red'>All The Fields are Required</p>" );

    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
    	die("<p style='color:red'>invalid email given</p>");

    /*if(ctype_alpha($name) === false)
    	die("<p style='color:red'>invalid name given</p>");

    if(ctype_alpha($city) === false)
    	die("<p style='color:red'>invalid city given</p>");
    	
    if(ctype_alnum($address) === false)
    	die("<p style='color:red'>invalid address given</p>");
*/

    if(strlen(mysql_real_escape_string($_POST["password"])) < 6)
    	die("<p style='color:red'>password must be six(6) characters or more</p>");
    //-----------------------------------
    	#connect to database and insert user
    //-----------------------------------
	// require_once("db/cxn.php") or die("not connected to database");

	$cxn = mysql_connect("localhost", "root", "root") or die("<p style='color:red'>DATABASE CONNECTION FAILED TO ESTABLISH</p>");
	mysql_select_db("ams");


	$query = "select customerid from customer where email = '".$email."'";

    $result = mysql_query($query);

    while ($result_array[] = mysql_fetch_assoc($result)) {
    	null;
    }
    if($result_array)
    {
    	foreach ($result_array as $email_id) {
    		if(!empty($email_id['customerid']))
    			die("<p style='color:red'>The email already exists!</p>");
    	}
    }

	
	
    $query = "insert into customer (name ,email, password, address, city) values('".$name."', '".$email."', '".$password."', '".$address."', '".$city."')";
    $result = mysql_query($query);

    if($result != false)
    	echo "<center><h3 style='color:darkgreen'>You have been signed up for Allegro Music Store.</h3><p><a href='http://localhost/github/AMS/index.php?p=signup_signin' style=''>Sign In</a> to get started right away!</p><p><a href='/github/AMS/' style='color:brown'>Go Back To Home Page</a> &nbsp; <a href='http://localhost/github/AMS/index.php?p=signup_signin' style='color:darkgreen;'>Sign In</a></p><br /><p><small>Welcome To Allegro Music Store <span style='text-transform:capitalize;font-weight:bold'>$name</span>.&nbsp; &copy;copyrights 2015</small></p></center>";
    else
    	echo "<center><p style='color:red'>Something went wrong, You are not signed up!</p></center>";
}
/*else
{

	
	#------------------------------------------
		#if the sign up form has NOT been submitted
	#------------------------------------------
	

	//redirect the user to the sign up page.
	header("location: http://127.0.0.1/github/AMS/index.php?p=signup_signin");
	echo ("<center><h1>Redirecting . . .</h1></center>");
	echo ("<a href='/github/AMS/index.php?p=signup_signin'>click here if redirection takes too long</a>");
}*/

?>