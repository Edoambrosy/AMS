<?php


/*
-------------------------------
    SHOW ERRORS ( for development )
-------------------------------
*/

/*error_reporting(E_ALL);
ini_set('display_errors', 'on');*/

#------------------------------



// starting session
    session_start();

/*
-----------------------------------------------------
    function and classes includes ( helpers )
-----------------------------------------------------
*/
    require("helpers/base.php");



/*
-----------------------------------------------------
    specific includes for every page case
-----------------------------------------------------
*/
    $page = @$_GET["p"];

    switch($page)
    {
        case "signup_signin":
            ams_include("signup");
            break;
        case "logout":
            ams_include("logout");
            session_start();
            // $_SESSION['header'] = array("user-name" => "<center>Successfully Logged Out<br /><p>Feel free to <a href='?p=signup_signin'>Sign In any time</a></p></center>");
            // session_unset('header');
            session_destroy();
            ams_template("header");
            break;
        case "about":
            ams_template("header");
            ams_include("about_us");
            break;
        case "contacts":
            ams_template("header");
            ams_include("contacts");
            break;
        case "single_music":
            // ams_template("header");
            ams_include("single_music");
            break;
        case "single_book":
            ams_template("header");
            ams_include("single_book");
            break;
        case "home":
            ams_template("header");
            ams_include("default");
            break;
        case "buynow":
            ams_template("header");
            ams_include("buynow");
            break;
        case "cart":
            ams_include("cart");
            break;
        case "trial":
            ams_template("header");
            ams_include("try");
            break;
        case "ac":
            ams_template("header");
            ams_include("add_to_cart");
            break;
        default:
            ams_template("header");
            ams_include("default");
            break ;
    }


/*
-----------------------------------------------------
    footer template of every page
-----------------------------------------------------
*/
    ams_template("footer");

error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>