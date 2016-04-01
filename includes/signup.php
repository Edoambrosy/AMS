<?php 

/*
-------------------------------
    SHOW ERRORS ( for development )
-------------------------------
*/

/*error_reporting(E_ALL);
ini_set('display_errors', 'on');*/

#------------------------------




/*
-------------------------------
    LOGIN and SIGN IN CODE
-------------------------------
*/

if(isset($_SESSION['user']))
    header("location: http://localhost/github/AMS/index.php");

if(isset($_POST['submit']))
    $attempt = "signup";
else if(isset($_POST['sign_in']))
    $attempt = "login";
else
    $attempt = "default";

switch ($attempt) {
    case 'signup':
        /*
        ------------------------------------------
            if the sign up form has been submitted
        ------------------------------------------
        */
        //-----------------------------------
            #receive form variables and validate
        //-----------------------------------
        // var_dump($_POST);
        $errors;
        $name = mysql_real_escape_string($_POST["name"]);
        $email = mysql_real_escape_string($_POST["email"]);
        $password = md5(mysql_real_escape_string($_POST["password"]));
        $address = mysql_real_escape_string($_POST["address"]);
        $city = mysql_real_escape_string($_POST["city"]);

        if((empty($name) == true || empty($email) == true || empty(mysql_real_escape_string($_POST["password"])) == true || empty($address)==true || empty($city) == true))
        {
            $errors_signup['all']['message'] = "All The Fields are Required";
            ams_template("header");
            break;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
        {
            $errors_signup['email']['message'] = "invalid email given";
        }

        /*if(ctype_alpha($name) === false)
            die("<p style='color:red'>invalid name given</p>");

        if(ctype_alpha($city) === false)
            die("<p style='color:red'>invalid city given</p>");
            
        if(ctype_alnum($address) === false)
            die("<p style='color:red'>invalid address given</p>");
    */

        if(strlen(mysql_real_escape_string($_POST["password"])) < 6)
        {
            $errors_signup['password']['message'] = "password must be six(6) characters or more";
        }
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
                {
                    $errors_signup['email']['message'] = "The email already exists!";
                    // die("<p style='color:red'>The email already exists!</p>");
                }
            }
        }

        if(empty($errors_signup))
        {
            $query = "insert into customer (name ,email, password, address, city) values('".$name."', '".$email."', '".$password."', '".$address."', '".$city."')";
            $result = mysql_query($query);

            if($result == false)
                echo "<center><p style='color:red'>Something went wrong, You are not signed up!</p></center>";
            else
            {
                ams_template("header");
                echo "<center><h3 style='color:darkgreen'>You have been signed up for Allegro Music Store.</h3><p><a href='http://localhost/github/AMS/index.php?p=signup_signin' style=''>Sign In</a> to get started right away!</p><p><a href='/github/AMS/' style='color:brown'>Go Back To Home Page</a> &nbsp; <a href='http://localhost/github/AMS/index.php?p=signup_signin' style='color:darkgreen;'>Sign In</a></p><br /><p><small>Welcome To Allegro Music Store <span style='text-transform:capitalize;font-weight:bold'>$name</span>.&nbsp; &copy;copyrights 2015</small></p></center>";
                $no_signup = true;
            }
        }
        else
            ams_template("header");
        break;
    
    case 'login':
        /*
        -----------------------------------------------
            receive credentials and validate
        -----------------------------------------------
        */
        $email = mysql_real_escape_string($_POST["email"]);
        // $email = $_POST["email"];
        $password = md5(mysql_real_escape_string($_POST["password"]));
        // $password = $_POST["password"];
        /*
        ------------------------------------------------
            check if user email and password exist
        ------------------------------------------------
        */

        
        if(empty($email) == true || empty(mysql_real_escape_string($_POST["password"])) == true)
        {
            $errors_login['both'] = array("message" => "Both Fields are Required");
            ams_template("header");
            break;
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
            // session_start();
            $_SESSION['user']['id'] = $user[0]['customerid'];
            $_SESSION['user']['name'] = $user[0]['name'];
            $_SESSION['user']['email'] = $user[0]['email'];
            $_SESSION['user']['address'] = $user[0]['address'];
            $_SESSION['user']['city'] = $user[0]['city'];
            if(isset($_SESSION['page']['intended']))
            {
                $location = $_SESSION['page']['intended'];
                header("location: ".$_SESSION['page']['intended']);
            }
            else
            {
                header("location: ".$_SERVER["PHP_SELF"]);
            }
        }
        else
        {
            $errors_login['email'] = array("message" => "Email - Password combination not correct");
            ams_template("header");
            break;
        }
        echo "Welcome ".$_SESSION['user']['name']."<br />";

        // die(var_dump($user[0]));

        // die("<p style='color:darkgreen'>query executed :-)</p>");
        ams_template("header");
        break;
    
    default:
        # code...

        ams_template("header");
        break;
}
    if(isset($_SESSION['page']['intended']) && $attempt != "login" && $attempt != "signup")
    {
        $message = array("header" => "You Must <label for='email' class='user-name'>Sign In</label> to Continue.");
    }
?>
    <?php if($message['header']): ?>
        <center><font size =5><p class="user-name" style="color:cornflowerblue;"><?php echo $message['header'] ?></p></font></center>
    <?php endif ?>
<?php if(!(@$no_login === true)): ?>
<font size = 3 color = "brown">  If you already registered <label for='email' class="user-name">Sign In Below</label></font>
<?php
    if(isset($errors_login))
    {
        echo "<table>";
            foreach ($errors_login as $key => $error) {
                echo("<tr><td class='error'>( $key )</td><td class='error-message'>".$error['message']."</td></tr>");
            }
        echo "</table>";
    }
?>
<form name="form1" method="post" action="#">

    <table>
        
           <tr>
            <td><label for="email" />Email:</td>
            <td><input type="email" name="email" id="email" value="<?php echo isset($_POST['sign_in']) ?  htmlentities($_POST['email']):''; ?>"></td>
        </tr>
      
        <tr>
            <td><label for="password" />Password:</td>
            <td><input type="password" name="password" id="password"></td>
         </tr>
         <tr>
            <td></td>
            <td><input type="submit" name="sign_in" id="sign_in" value="Sign in"></td>
        </tr>
    </table>
</form>
<br />
<?php endif ?>
<?php if(!(@$no_signup === true)): ?>
<font size = 3 color = "brown" > If you don't have an account, <label for='name' class="user-name" id='register_here'>Register here</label> . It's Free </font>
<?php
    if(isset($errors_signup))
    {
        echo "<table>";
            foreach ($errors_signup as $key => $error) {
                echo("<tr><td class='error'>( $key )</td><td class='error-message'>".$error['message']."</td></tr>");
            }
        echo "</table>";
    }
?>
<form name="form2" method="post" action="#" class="display-none" id='form2'>
 <table>
     <tr>
         <td><label for="name" />Name:</td>
         <td><input type="text" name="name" id="name" value="<?php echo htmlentities(@$_POST['name']) ?>"></td>
     </tr>
     <tr>
         <td><label for="email_register" />Email:</td>
         <td><input type="text" name="email" id="email_register" value="<?php echo isset($_POST['submit']) ? htmlentities(@$_POST['email']): '' ?>"></td>
     </tr>
     <tr>
         <td><label for="address" />Address:</td>
         <td><input type="text" name="address" id="address" value="<?php echo htmlentities(@$_POST['address']) ?>"></td>
     </tr>
     <tr>
         <td><label for="city" />City:</td>
         <td><input type="text" name="city" id="city" value="<?php echo htmlentities(@$_POST['city']) ?>"></td>
     </tr>
     <tr>
         <td><label for="password_register" />Password</td>
         <td><input type="password" name="password" id="password_register"></td>
     </tr>
     <tr>
         <td></td>
         <td><input type="submit" name="submit" id="submit" value="Submit"></td>
     </tr>
 </table>
  
</form>
<?php endif ?>
