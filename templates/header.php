<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Allegro Music Store - AMS</title>
<link href="css/thrColFix.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="favicon.ico">
<link rel="shortcut icon" href="favicon.ico">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/thrColFix.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="?p=about">About Us</a></li>
      <li><a href="?p=contacts">Contact</a></li>
      <li><a href="?p=help">Help</a></li>
      <?php if (isset($_SESSION['user'])): ?>
        <li><a href="?p=cart">My Cart</a></li>
        <li><a href="?p=logout" style="color:brown">Log Out</a></li>
      <?php else: ?>
        <li><a href="?p=logout" style="color:darkgreen">Sign-Up | Sign-In</a></li>
      <?php endif ?>
    </ul>
    <?php if (isset($_SESSION['user'])): ?>
      <ul style="width:180px;overflow:hidden;color:brown;text-transform:capitalize">
        <li><p><?php echo $_SESSION['user']['name'] ?></p></li>
        <li><p><?php echo $_SESSION['user']['email'] ?></p></li>
        <li><p>@<?php echo $_SESSION['user']['address'] ?></p></li>
        <li><p><?php echo $_SESSION['user']['city'] ?></p></li>
      </ul>
    <?php else: ?>
      <p> Welcome to the <em> <b>Allegro music store </b>
       </em> <b> <font size = 4 >( AMS )</font></b> the store which enables you to shop online and ships items that you desire to you exact location anywhere in the world.<br/>
       <p> We sell music products quite often and our best selling products are music, music books, music sheets.</p>
     </p>
    <?php endif ?>
            <h4>Get What You want!</h4>
            <center><img src="img/music_love.jpeg" style="width:180px" alt=""></center>
    <p>If you would like to view any of the product , cheking prices and buy any of the items we are selling just click on the one of the links above and check what is in our warehouses and buy as many item as you want</p>
    <br />
      <h4>Music is not silent!</h4>
      <p><center><img src="img/music_wild.jpeg" alt="Quality Music"style="width:180px"></center></p>
      <p>It's just not.</p>
    <!-- end .sidebar1 --></div>
  <div class="content" align="center">
    <h1 align="center">Allegro Music Store</h1>
      <a href="index.php"><img src="img/ams.png" alt=""></a>
    <p align="center">Shop music online.</p>
    <p align="center">Audio CD, Video DVD's, Music Books, Music Sheets and more.</p>
    <?php if(isset($_SESSION['header'])): ?>
      <table>
        <?php foreach ($_SESSION['header'] as $key => $value) {
          echo "<tr>";
            echo "<td class='".$key."'>$value</td>";
          echo "</tr>";
        } ?>
      </table>
    <?php endif ?>
    <?php  if(!isset($_SESSION['user']['name'])) : ?>
      <?php if ($_GET['p'] !== "signup_signin"): ?>
        <a href="index.php?p=signup_signin"><font size = 2 color = "brown" >Sign In | Sign Up</font></a>
      <?php endif ?>
    <?php else: ?>
      <font size =5>Logged In: <span id="user-name"><?php echo $_SESSION['user']['name'] ?><span></font>
    <?php endif ?>
    <br />
      <br/>