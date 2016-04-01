<?php 

/*
-------------------------------
    SHOW ERRORS ( for development )
-------------------------------
*/

/*error_reporting(E_ALL);
ini_set('display_errors', 'on');*/

#------------------------------



 ?>
    <form action="" method="get">
        <input type="search" name="q" placeholder="Search for music" id="search_music" autofocus />
    </form>
  <?php
    
//    include("db/cxn.php");
    db_ams();
        if(isset($_GET['q']))
        {
            echo "<br />Search Results for: \"<b>".htmlentities($_GET['q'])."</b>\"<br />";
            $search_q = mysql_real_escape_string($_GET['q']);
            $query = "select * from item where title like '%".$search_q."%' or supplier_name like '%".$search_q."%' or store_name like '%".$search_q."%' or type like '%".$search_q."%' or price like '%".$search_q."%'";
            $result = mysql_query($query);
            
            if($result)
            {
                while($search[] = mysql_fetch_assoc($result))
                    null;
                 ?>
                    <table>
                <?php
                $search = array_slice($search, 0, 1);
                foreach($search as $search_item)
                {
                    ?>
                        
                        <tr>
                            <td>Title</td>
                            <td><b><?php echo $search_item['title']?></b></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><b><?php echo $search_item['price']?></b></td>
                        </tr>
                        <tr>
                            <td>Supplier Name</td>
                            <td><b><?php echo $search_item['supplier_name']; echo  $search_item['supplier_name'] == 1 ?  "(taxed)" : ""; ?></b></td>
                        </tr>
                        <hr />
                    <?php
                }
                ?>

                    </table>
                <?php
                echo "<hr />";
            }

            else
                echo "<p><b>No results</b> for your search</p>";
        }


        
        /*
        --------------------------------------------------------------------------------------------
          GET VARIABLES SETTINGS
        --------------------------------------------------------------------------------------------
        */
        // $type = isset($_GET['t']) ? $_GET['t'] ? "music" ;
        $page_num = @$_GET['pn'] > 0 ? $_GET['pn'] : 1;
        $item_type = @$_GET['t'] ? $_GET['t'] : "audio_video" ;


        /*
        --------------------------------------------------------------------------------------------
          ITEM FILTER
        --------------------------------------------------------------------------------------------
        */ 
        ?>
        <b>Filter By: </b>
        <?php if($item_type == "audio_video"):  ?>
        <b><i><a href="?pn=1&t=audio_video">Video/Audio</a></i></b> &nbsp; | &nbsp;
        <?php else: ?>
        <a href="?pn=1&t=audio_video">Video/Audio</a> &nbsp; | &nbsp;
        <?php endif ?>

        <?php if($item_type == "sheet"):  ?>
        <b><i><a href="?pn=1&t=sheet">Sheet</a></i></b> &nbsp; | &nbsp;
        <?php else: ?>
        <a href="?pn=1&t=sheet">Sheet</a> &nbsp; | &nbsp;
        <?php endif ?>

        <?php if($item_type == "book"):  ?>
        <b><i><a href="?pn=1&t=book">Book</a></i></b>
        <?php else: ?>
        <a href="?pn=1&t=book">Book</a>
        <?php endif ?>
        <br />
        <br />
        <?php


        /*
        --------------------------------------------------------------------------------------------
          PAGINATION SETTINGS
        --------------------------------------------------------------------------------------------
        */
        switch ($item_type) {
          case 'audio_video':
            $query = "select count(upc) as total from music"; // ------ FOR MUSIC FILTER ONLY ------
            break;
          
          case 'book':
            $query = "select count(upc) as total from music_book"; // ------ FOR MUSIC FILTER ONLY ------
            break;
          
          case 'sheet':
            $query = "select count(upc) as total from music_sheet"; // ------ FOR MUSIC FILTER ONLY ------
            break;
          
          default:
            # code...
            break;
        }

        $count = mysql_query($query);

        while($total[] = mysql_fetch_assoc($count))
          null;

        $count = $total[0]['total']; 
        $per_page = 9; //    |<**************** CONTROLS THE NUMBER OF RESULTS IN A PAGE. ****************>|    \\

        $page_max = ceil($count/$per_page);
        $offset = ($page_num*$per_page)-$per_page;
        $offset = $count> $offset? $offset : 0 ;


        switch ($item_type) {
          case 'audio_video':
             /*
            --------------------------------------------------------------------------------------------
              MUSIC SPECIFIC QUERY AND TABLE
            --------------------------------------------------------------------------------------------
            */
            $query = "select music.upc, music.title_song, music.leading_singer, item.price, item.taxable, music.type from music, item where music.upc = item.upc limit ".$per_page." offset ". $offset;
            $music = mysql_query($query);

            while($songs[] = mysql_fetch_assoc($music))
              null;

            echo "<table class='music-list'><tr><th>Music Name</th><th>Price<small>(Tshs.)</small></th></th></tr>";
            // dd($songs);
            // dd();
            // dd($songs);
            foreach ($songs as $key => $song)
                if($song != false)
                    echo "<tr><td><a href='?p=single_music&u=".$song['upc']."'><span>". $song['title_song'] . "</span> - <span>" . $song['leading_singer'] . "</span></a></td><td><a href='?p=single_music&u=".$song['upc']."'>" . $song['price'] . "</a></td></tr>";
            echo "</tr></table>";
            break;

          case 'book':
            /*
            --------------------------------------------------------------------------------------------
              BOOK SPECIFIC QUERY AND TABLE
            --------------------------------------------------------------------------------------------
            */
            
            $query = "select music_book.upc, music_book.author, music_book.year, music_book.publisher, item.price from music_book, item where music_book.upc=item.upc limit ".$per_page." offset ". $offset;
            $book_collection = mysql_query($query);

            while($books[] = mysql_fetch_assoc($book_collection))
              null;
            
            echo "\n<br />";

            echo "<table class='music-list'><tr><th>Music Book</th><th>Price(Tshs.)</th></th></tr>";
            foreach($books as $book)
              echo "<tr><td><a href='?p=single_book&u=".$book['upc']."'><span>". $book['author'] . "</span> - <span>" . $book['year'] . "</span></a></td><td><a href='?p=single_book&u=".$book['upc']."'>" . $book['price'] . "</a></td></tr>";
            echo "</tr></table>";
            break;
          
          default:
            # code...
            break;
        }

           
        /*
          ----------------------------------------------------
            PAGINATION LINKS
          ----------------------------------------------------
        */
          echo "<br />&nbsp;";
         for ($i=1; $i <= $page_max; $i++) {
          if ($i == $page_num)
            echo " <a class='page-link-active' href='?t=".$item_type."&pn=".$i."' ><b>$i</b></a> ";
          else
            echo " <a class='page-link' href='?t=".$item_type."&pn=".$i."' >$i</a> ";
        }

      ?>