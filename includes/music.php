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
	$query = "select music.title_song, music.leading_singer, music.year, music.p_company, music.category, music.type from music";
 ?>

<h1><?php var_dump($item); echo $item[0]['title_song']?></h1>
<table>
	<tr>
		<td></td>
	</tr>
</table>