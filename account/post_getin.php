<?php 
if(isset($_POST['sign_in']))
{
	/*
	-----------------------------------------------
		receive credentials and validate
	-----------------------------------------------
	*/
    $email = mysql_real_escape_string($_POST["email"]);
    $password = md5(mysql_real_escape_string($_POST["password"]));
	/*
	------------------------------------------------
		check if user email and password exist
	------------------------------------------------
	*/

	
    if(empty($email) == true || empty(mysql_real_escape_string($_POST["password"])) == true)
    {
    	$error_login['all'] = ("message" => "All The Fields are Required");
    }
    // else
    	// die( "<p style='color:darkgreen'>All Fields have been Filled</p>" );

    //-----------------------------------
    	#connect to database and check for such user
    //-----------------------------------
	
	$cxn = mysql_connect("localhost", "root", "root") or die("could not connect with DATABASE");
	mysql_select_db("ams");

	$query ="select * from customer where email = '".$email."' and password = '".$password."'";
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) == 1)
	{
		while ($user[] = mysql_fetch_assoc($result)) {
			null;
		}
		session_start();
		$_SESSION['user']['id'] = $user[0]['customerid'];
		$_SESSION['user']['name'] = $user[0]['name'];
		$_SESSION['user']['email'] = $user[0]['email'];
		$_SESSION['user']['address'] = $user[0]['address'];
		$_SESSION['user']['city'] = $user[0]['city'];
	}
	else
		die("Email - Password combination not valid");
	echo "Welcome ".$_SESSION['user']['name']."<br />";

	die(var_dump($user[0]));

	// die("<p style='color:darkgreen'>query executed :-)</p>");

}
/*else
	echo("you did NOT sign in");*/

$errors = array("email error", 'password error');



 ?>