<?php
    require_once ("Includes/simplecms-config.php");
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php");
?>
<?php
  if (isset($_POST['whatYouSearcing'])){
    $getStringName = $_POST['whatYouSearcing'];

    $array = array();
    ?>  <center><div class="searchFoundContainer"> <?
    $sql = "SELECT * FROM items WHERE name LIKE '%$getStringName%' OR price LIKE '%$getStringName%' OR commonKeys LIKE '%$getStringName%'";
    $result = $databaseConnection->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              ?>
              <div class="searchFound">
                <div class="searchFoundIn">
                  <?php $nameOfItem = $row['name'];
                    $arr[] = array('name' => $nameOfItem);
                    $id = $row['itemid'];
                     echo "<div class='fontTitle'><a href=\"item.php?itemid=$id\">$nameOfItem</a></div>"; ?>
                    <img src='<?php echo $row['imgFront']; ?>'><br><br>
                    <?php echo $row['price']; ?>
                </div>
              </div>
              <?
            }
                    ?></div><?
        }
        else{
          echo "<div class='eror'>תוצאות החיפוש אינן מצאו דבר<br>נסה שוב מילה אחרת</div><br>";
        }
      } else{
        echo "<div class='eror'>לא נשלח פרמטר לחיפוש</div><br>";
        ?><script>parent.history.back();</script><?
      }
      include ("Includes/footer.php");
 ?>
