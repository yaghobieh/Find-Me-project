<?php

require_once ("Includes/simplecms-config.php");
require_once  ("Includes/connectDB.php");
/************************************/

if (isset($_POST['searchVal'])){
  $getStringName = $_POST['searchVal'];
  echo $getStringName;
  $array = array();
  ?>  <div class="searchFoundContainer"> <?
  $sql = "SELECT * FROM items WHERE name LIKE '%$getStringName%' OR price LIKE '%$getStringName%' OR commonKeys LIKE '%$getStringName%' LIMIT 6";
  $result = $databaseConnection->query($sql);
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $nameOfItem = $row['name'];
            $description = substr( $row['Linfo'], 0, 110);
            ?>
              <div class="line-search">
                <div class="image-side"><a href="item.php?itemid=<?php echo $row['itemid']; ?>"><?php echo   $nameOfItem; ?></a></div>
                <div class="info-in"><?php echo strip_tags($description); ?> || <?php echo $row['price']; ?>
              </div>
            </div>
            <?
          }
      }
      else{
        echo "<div class='eror'>תוצאות החיפוש אינן מצאו דבר<br>נסה שוב מילה אחרת</div><br>";
      }
    } else{
      echo "<div class='eror'>לא נשלח פרמטר לחיפוש</div><br>";
      ?><script>parent.history.back();</script><?
    }

?>
