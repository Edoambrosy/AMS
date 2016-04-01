<?php 

/*
-------------------------------
    SHOW ERRORS ( for development )
-------------------------------
*/

error_reporting(E_ALL);
ini_set('display_errors', 'on');

#------------------------------


 ?>
<?php
	if(!(isset($_SESSION['user'])))
	{
		// die("session is set");
		@session_start();
		// dd($_SESSION);
		$_SESSION['page']['intended'] = $_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"];
		$_SESSION['page']['intended'] = $_SERVER['PHP_SELF']."?".$_SERVER["QUERY_STRING"];
		header("Location: ?p=signup_signin");
		echo "redirected";
	}
	else
	{
		/*
		--------------------------------------------------------------------------------
			database connection
		--------------------------------------------------------------------------------
		*/
		db_ams();

		/*
		--------------------------------------------------------------------------------
			total quantity of item ( in warehouse )
		--------------------------------------------------------------------------------
		*/
		$query = "select max(upc) as item_max from item";
		$result = mysql_query($query);
		while($item_max[] = mysql_fetch_assoc($result))
			null;
		$_SESSION['item']['max'] = $item_max[0]['item_max'];

		$_SESSION['item']['upc'] = isset($_GET['u']) && @$_GET['u']>0 && @$_GET['u'] < $item_max[0]['item_max'] ? (int)(mysql_real_escape_string($_GET['u'])) : 1 ;

		/*
		--------------------------------------------------------------------------------
			quantity of item in users cart
		--------------------------------------------------------------------------------
		*/
		$query = "select quantity from cart where upc = '". $_SESSION['item']['upc']."' and customerid = '".$_SESSION['user']['id']."'";
		$result = mysql_query($query);
		if(mysql_num_rows($result) >= 1)
		{
			while($cart_item[] = mysql_fetch_assoc($result))
				null;
		}
		else
		{
			$item_never_add = true;
			$cart_item[0]['quantity'] = 0;
		}

		/*
		--------------------------------------------------------------------------------
			item specifics
		--------------------------------------------------------------------------------
		*/
		$query = "select item.price, item.taxable, item.store_name, item.supplier_name, item.type, item.quantity from item where upc = '". $_SESSION['item']['upc']."'";
		$result = mysql_query($query);
		while($item[] = mysql_fetch_assoc($result))
			null;

		/*
		--------------------------------------------------------------------------------
			validate and add item to cart
		--------------------------------------------------------------------------------
		*/
		if(isset($_GET['ac']))
			$cart_attempt = "ac";
		else if(isset($_GET['rc']))
			$cart_attempt = "rc";
		else if(isset($_GET['clr']))
			$cart_attempt = "clr";
		else
			$cart_attempt = "";
		//clear emptying message
		if (isset($_SESSION['cart']['empty']))
			unset($_SESSION['cart']['empty']);

		switch ($cart_attempt) {
			case 'ac':

				if (isset($_SESSION['cart']['remove']))
					unset($_SESSION['cart']['remove']);
				if($item[0]['quantity'] <= $cart_item[0]['quantity'])
				{
					$_SESSION['cart']['add'] = array("error" => "Sorry, There is No Copy of The Item To Add To your Cart!");
					header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
					break;
				}
				$item_quantity_original = $item_quantity_requested = (int)(mysql_real_escape_string($_GET['ac'])) > 0 ? (int)(mysql_real_escape_string($_GET['ac'])) : 1;
				if($item_quantity_requested > ($item[0]['quantity']-$cart_item[0]['quantity']))
				{
					$item_quantity_requested = $item[0]['quantity']-$cart_item[0]['quantity'];
					$_SESSION['cart']['add'] = array("error" => "Sorry! We Could not add all $item_quantity_original, <b class='success'>Only $item_quantity_requested</b> have been <b style='color:darkgreen !important;'>added</b> to your Cart!");
					// header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
					// break;
				}
				if(@$item_never_add == true)
					$query = "insert into cart (upc , customerid, quantity) values('".$_SESSION['item']['upc']."', '".$_SESSION['user']['id']."', '".$item_quantity_requested."')";
				else
					$query = "update cart set quantity = quantity + '".$item_quantity_requested."' where upc = '". $_SESSION['item']['upc']."' and customerid = '".$_SESSION['user']['id']."'";
				$rowsAffected = mysql_query($query);
				if(!$rowsAffected == 1)
				{
					$_SESSION['cart']['add'] = array("error" => "Something went wrong! Please try adding again the Item to cart");
					header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
					break;
				}
				else
					$_SESSION['cart']['add'] = array("success" => $item_quantity_requested." item(s) <b style='color:darkgreen !important;'>Added</b> To Cart");
				header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
				break;
			
			case 'rc':
				

				if (isset($_SESSION['cart']['add']))
					unset($_SESSION['cart']['add']);
				if($cart_item[0]['quantity'] <= 0 || @$item_never_add === true)
				{
					$_SESSION['cart']['remove'] = array("empty" => "Sorry, There is No Copy of The Item To Remove From your Cart!");
					header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
					break;
				}
				$item_quantity_original = $item_quantity_requested = (int)(mysql_real_escape_string($_GET['rc'])) > 0 ? (int)(mysql_real_escape_string($_GET['rc'])) : 1;
				if($item_quantity_requested > ($cart_item[0]['quantity']))
				{
					$item_quantity_requested = $item[0]['quantity']-$cart_item[0]['quantity'];
					$_SESSION['cart']['remove'] = array("error" => "Sorry! We Could not remove all $item_quantity_original, <b class='success'>Only $item_quantity_requested</b> have been <b style='color:brown !important;'>Removed</b> from your Cart!");
					// header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
					// break;
				}

				$query = "update cart set quantity = quantity - '".$item_quantity_requested."' where upc = '". $_SESSION['item']['upc']."' and customerid = '".$_SESSION['user']['id']."'";
				$rowsAffected = mysql_query($query);
				if(!$rowsAffected == 1)
				{
					$_SESSION['cart']['remove'] = array("error" => "Something went wrong! Please try removing again the Item from cart");
					header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
					break;
				}
				else
				{
					$_SESSION['cart']['remove'] = array("success" => $item_quantity_requested." item(s) <b style='color:brown !important;'>Removed</b> From Cart");
					header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
				}
				break;
			
			case 'clr':
				if($_GET['clr'] == 'add')
				{
					if(isset($_SESSION['cart']['add']))
						unset($_SESSION['cart']['add']);
				}
				else if($_GET['clr'] == 'remove')
				{
					if(isset($_SESSION['cart']['remove']))
						unset($_SESSION['cart']['remove']);
				}
				else if($_GET['clr'] == 'empty')
				{
					if(isset($_SESSION['cart']['empty']))
						unset($_SESSION['cart']['empty']);
				}
				header("Location: ?p=single_music&u=".$_SESSION['item']['upc']);
				break;
			default:
				# code...
				break;
		}

		switch ($item[0]['type']) {
			case 'music':
				
				/*
				--------------------------------------------------------------------------------
					music specifics
				--------------------------------------------------------------------------------
				*/
				$query = "select music.title_song, music.leading_singer, music.year, music.p_company, music.category, music.type from music where upc = '". $_SESSION['item']['upc']."'";
				$result = mysql_query($query);
				while($item_specifics[] = mysql_fetch_assoc($result))
					null;

				$item = array_merge($item, $item_specifics);
	        
	            $query = "select supplier.sname from item, supplier where supplier.sname=item.supplier_name and item.upc='". $_SESSION['item']['upc']."'";
	            $result = mysql_query($query);
				while($supplier[] = mysql_fetch_assoc($result))
					null;

				ams_template("header");
				?>
	            
				<center><h2 style="text-transform:capitalize;"><img src="img/music.png" alt="music file" style="vertical-align:middle;" height="70px" width="70px" /><br /><?php echo $item[2]['title_song']." - ".$item[2]['leading_singer']; ?></h2></center>
				<table>
					<tr>
						<td>Music: </td><td><b><?php echo $item[2]['title_song']; ?></b></td>
					</tr><tr>
						<td>Artist: </td><td><b><?php echo $item[2]['leading_singer']; ?></b></td>
					</tr><tr>
						<td>Price: </td><td><b><?php echo $item[0]['price']; echo $item[0]['taxable'] == 1 ?  "(taxed)" : ""; ?></b><small>(Tsh.)</small></td>
					</tr><tr>
						<td>Company: </td><td><b><?php echo $item[2]['p_company']; ?></b></td>
					</tr><tr>
						<td>Year: </td><td><b><?php echo $item[2]['year']; ?></b></td>
					</tr><tr>
						<td>Type: </td><td><b><?php echo $item[2]['type']; ?></b></td>
					</tr><tr>
						<td>Category: </td><td><b><?php echo $item[2]['category']; ?></b></td>
					</tr><tr>
						<td>Quantity: </td><td><b><?php echo $item[0]['quantity']; ?></b> Copies</td>
					</tr><tr>
						<td>supplier: </td><td><b><?php echo $supplier[0]['sname']; ?></b></td>
					</tr>
				</table>
				<p><?php  ?></p>
				<p><?php echo $item[0]['price']." <small>Tshs</small>" ?> <a href="?p=buynow"><button style="background-color: white; color: brown;" onclick = ""><b>√</b> Buy Now</button></a></p>
				<?php if (isset($_SESSION['cart']['add']) || isset($_SESSION['cart']['remove'])): ?>
					<table>
						<?php foreach ($_SESSION['cart'] as $key => $error): ?>
							<tr>
								<td>
									<?php foreach ($error as $class => $error_message): ?>
										<center><img src="img/cart_<?php echo $class ?>.png" alt=""></center>
										<p class="<?php echo $class ?>"><?php echo $error_message ?> <a href="?p=single_music&u=<?php echo $_SESSION['item']['upc'] ?>&clr=<?php echo $key ?>"><button style="background-color: white; color: green;" onclick = ""><b>√</b> Seen</button></a></p>
									<?php endforeach ?>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
				<?php endif ?>
	            <table>
					<tr>
			            <td><a href="?p=single_music&u=<?php echo $_SESSION['item']['upc'] ?>&rc=1"><button style="background-color: brown; color: white;float:right;"> <b>-</b> Remove From Cart</button></a></td>
			            <td><a href="?p=single_music&u=<?php echo $_SESSION['item']['upc'] ?>&ac=1"><button style="background-color: darkgreen; color: white;float:left;"> <b>+</b> Add To Cart</button></a></td>
	            	</tr>
	            	<tr>
			            <td><form action="?p=single_music&u=<?php echo $_SESSION['item']['upc'] ?>" method='GET'>Remove Multiple<input type="hidden" name='p' value='single_music'><input type="hidden" name='u' value='<?php echo $_SESSION['item']['upc'] ?>'><input style='color:brown;float:right;' type="number" min='0' max="<?php echo $cart_item[0]['quantity'] ?>" placeholder="0" name='rc'></form></td>
			            <td><form action="?p=single_music&u=<?php echo $_SESSION['item']['upc'] ?>" method='GET'>Add Multiple<input type="hidden" name='p' value='single_music'><input type="hidden" name='u' value='<?php echo $_SESSION['item']['upc'] ?>'><input style='color:darkgreen;float:left;' type="number" min="0" max="<?php echo ($item[0]['quantity']-$cart_item[0]['quantity'])>0 ? ($item[0]['quantity']-$cart_item[0]['quantity']) : '0' ; ?>" placeholder="0" name='ac'></form></td>
	            	</tr>
	            </table>
				<br />
				<?php

				break;

			case 'music_book':
				
				$query = "select music_book.author, music_book.year, music_book.publisher from music_book";
				combineDetails();
				ams_template("header");
				ams_include("music_book");
				break;

			case 'music_sheet':
				
				$query = "select music_sheet music_sheet.p_company, music_sheet.composer from music_sheet";
				combineDetails();
				ams_template("header");
				ams_include("music_sheet");
				break;

			default:
				
				// die("music not found! <a href='index.php'>Go To The Home Page</a>");
				break;
		}

		echo("<p><a href='index.php' style='color:red;'>Close</a> &nbsp; <a href='index.php' style='color:darkgreen';>Go Back To Home Page</a></p>");



		function combineDetails()
		{
			while($item_specifics[] = mysql_fetch_assoc($result))
				null;
			$item = array_merge($item, $item_specifics);
		}
	    
	    function buynow (){
	        $transact = "buynow" ;
	        include("buynow") ;
	    }

	}
?>