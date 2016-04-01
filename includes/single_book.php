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
<h1>Single Book Page</h1>


<?php 
	
	db_ams();

	$query = "select item.price, item.taxable, item.store_name, item.supplier_name, item.type from item where upc = '". $_GET['u']."'";
	$result = mysql_query($query);

	while($item[] = mysql_fetch_assoc($result))
		null;

	switch ($item[0]['type']) {
		case 'music':
			
			$query = "select music.title_song, music.leading_singer, music.year, music.p_company, music.category, music.type from music where upc = '". $_GET['u']."'";
			// combineDetails();
			// die($query);


			$result = mysql_query($query);
			while($item_specifics[] = mysql_fetch_assoc($result))
				null;

			// $item = array_merge($item, $item_specifics);

			$item = array_merge($item, $item_specifics);
			// var_dump($item[0][0]. "<hr />" );
			// die(($item[2]['title_song']));

			?>

			<h2><? echo "Music: ".$item[2]['title_song']."<br />Artist: ".$item[2]['leading_singer']; ?></h2>
			<table>
				<tr>
					<td>Music: </td><td>mdogomdogo</td>
				</tr><tr>
					<td>Artist: </td><td>diamond</td>
				</tr><tr>
					<td>Price: </td><td>1000( taxable? )</td>
				</tr><tr>
					<td>Company: </td><td>mj records</td>
				</tr><tr>
					<td>Year: </td><td>2010</td>
				</tr><tr>
					<td>Type: </td><td>audio</td>
				</tr><tr>
					<td>Music: </td><td>Mdodfjdljfkd</td>
				</tr><tr>	
					<td>supplier: </td><td>Mdodfjdljfkd</td>
				</tr>
			</table>
			<p><?php  ?></p>
			<table>
				
			</table>
			<p><?php echo $item[0]['price']." Tshs" ?></p>
			<button style="background-color: darkgreen; color: white; border-style:solid;"><?php echo "Buy Now" ?></button>
			<br />
			<br />
			<?php

			break;

		case 'music_book':
			
			$query = "select music_book.author, music_book.year, music_book.publisher from music_book";
			combineDetails();
			ams_include("music_book");
			break;

		case 'music_sheet':
			
			$query = "select music_sheet music_sheet.p_company, music_sheet.composer from music_sheet";
			combineDetails();
			ams_include("music_sheet");
			break;

		default:
			
			die("music not found! <a href='index.php'>Go To The Home Page</a>");
			break;
	}

	echo("<br /><br /><p><a href='index.php' style='color:red;'>Close</a> &nbsp; <a href='index.php' style='color:darkgreen';>Go To The Home Page</a></p>");

	function combineDetails()
	{
		while($item_specifics[] = mysql_fetch_assoc($result))
			null;
		$item = array_merge($item, $item_specifics);
	}

 ?>