
   <!--<h2>&nbsp;</h2>
   
	   <h3>Footer</h3>
    <p>Adding a footer following the columns, yet still inside the .container, will cause this overflow:hidden clearing method to fail. You can place a .footer into a second .container outside the first one with no detrimental effects. The simplest choice may be to start with a layout containing headers and footers and remove the header to utilize the clearing methods in that layout type.</p>-->
    <!-- end .content -->
    <?php if(isset($_SESSION['user'])): ?>
      <p>
        <a href="?p=logout" style="color:red">Log Out</a>
        <?php if($_GET['p'] != 'cart'): ?>
          &nbsp;&nbsp;<a href="?p=cart" style="color:green">My Cart</a>
        <?php endif ?>
      </p>
    <?php endif ?>
  </div>
 
  <div class="sidebar2">
    <h4>Order now and Buy</h4>
      <center><a href="?p=cart" style="color:green"><img src="img/shop_online.png" alt="Shop Online"></a></center>
    <p>In order to be able to get any item today you shoud have first the <em>AMS</em> account where we can be able to trace your location easily plus you contacts and send you the items that you want wherever you are.</p>
    <br />
      <h4>Quality Music!</h4>
      <p><center><img src="img/speaker.png" alt="Quality Music"></center></p>
    <p>If you dont have an <i>AMS </i>account, Register now its free.</p>
    <br />
      <h4>Go Wild!</h4>
      <p><center><img src="img/music_wild.jpeg" alt="Quality Music"></center></p>
      <p>Ma! Look Music is licensed and shipped over, just in a click...! Ha !</p>
</body>
<script src="js/lib/jquery-2.1.3.min.js"></script>
<script src="js/js.js"></script>
</html>