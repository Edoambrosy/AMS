<?php

	//-----------------------------------
    	#redirect to home if not logged in, but send header if logged in
    //-----------------------------------
	if(!isset($_SESSION['user']))
		header("Location: index.php");

	//-----------------------------------
    	#clear cart  add and remove messages
    //-----------------------------------
	if (isset($_SESSION['cart']['add']))
		unset($_SESSION['cart']['add']);
	if (isset($_SESSION['cart']['remove']))
		unset($_SESSION['cart']['remove']);
	if($_GET['clr'] == 'add')
	{
		if(isset($_SESSION['cart']['add']))
			unset($_SESSION['cart']['add']);
		header("Location: ?p=cart&u=".$_SESSION['item']['upc']);
	}
	else if($_GET['clr'] == 'remove')
	{
		if(isset($_SESSION['cart']['remove']))
			unset($_SESSION['cart']['remove']);
		header("Location: ?p=cart&u=".$_SESSION['item']['upc']);
	}
	else if($_GET['clr'] == 'empty')
	{
		if(isset($_SESSION['cart']['empty']))
			unset($_SESSION['cart']['empty']);
		header("Location: ?p=cart&u=".$_SESSION['item']['upc']);
	}

	//-----------------------------------
    	#connect to database and insert user
    //-----------------------------------
	
	$cxn = @mysql_connect("localhost", "root", "root");
	mysql_select_db("ams");

	if($_GET['ec'] === "1")
	{
		$query = "delete from cart where customerid='".$_SESSION['user']['id']."'";
		$rowsAffected = mysql_query($query);
		if($rowsAffected >= 1)
		{
			$_SESSION['cart']['empty'] = array("success" => "Cart <b style='color:brown !important;'>Emptied</b> Successfully");
		}
		else
			$_SESSION['cart']['empty'] = array("error" => "Cart <b style='color:brown !important;'>Failed to Empty</b>. Please Try Again.");
		header("Location: ?p=cart&u=".$_SESSION['item']['upc']);
	}
	
	$query = "select item.title, item.price, item.quantity as max_quantity, cart.quantity as cart_quantity from item, cart where item.upc=cart.upc and cart.customerid='" . $_SESSION['user']['id'] . "'";
	$result = mysql_query($query);
	while ($result_array[] = mysql_fetch_assoc($result))
		null;
	ams_template("header");
?>
<h3>Cart</h3>
<img src="img/cart.png" alt="">
<?php if (isset($_SESSION['cart']['add']) || isset($_SESSION['cart']['remove']) || isset($_SESSION['cart']['empty'])): ?>
	<table>
		<?php foreach ($_SESSION['cart'] as $key => $error): ?>
			<tr>
				<td>
					<?php foreach ($error as $class => $error_message): ?>
						<center><img src="img/cart_<?php echo $class ?>.png" alt=""></center>
						<p class="<?php echo $class ?>"><?php echo $error_message ?> <a href="?p=cart&u=<?php echo $_SESSION['item']['upc'] ?>&clr=<?php echo $key ?>"><button style="background-color: white; color: green;" onclick = ""><b>√</b> Seen</button></a></p>
					<?php endforeach ?>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php endif ?>
<table class="music-list">
	<?php if ($result_array[0] != false): ?>
		<tr>
			<th>Item Title</th>
			<th>Avalable Copies</th>
			<th>Copies in Cart</th>
			<th>Price per Copy</th>
		</tr>
		<?php foreach ($result_array as $key => $value): ?>
            <?php if ($value != false): ?>
				<tr>
					<td><?php echo $value['title'] ?></td>
					<td><?php echo $value['max_quantity'] ?></td>
					<td><?php echo $value['cart_quantity'] ?></td>
					<td>@<?php echo $value['price'] ?></td>
				</tr>
			<?php endif ?>
		<?php endforeach ?>
			<td colspan="3"><center><a href="?p=cart&ec=1"><button style='color:white;background-color:red'>empty cart</button></a> <a href="?p=buynow"><button style='color:white;background-color:darkgreen'>√ Buy Now</button></a></center></td>
	<?php else: ?>
		<tr>
			<th colspan="3">
				<img src="img/cart_empty.png" alt="">
			</th>
		</tr>
		<tr>
			<td colspan="3">
				Your Cart Is <b class='success'>Empty!</b>
			</td>
		</tr>
	<?php endif ?>
</table><br />