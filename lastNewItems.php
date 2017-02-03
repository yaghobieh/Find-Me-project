<?php

  if (is_admin()){
    $sql = "SELECT * FROM items ORDER BY itemid DESC LIMIT 0, 5";
    $result = $databaseConnection->query($sql);
      if ($result->num_rows > 0) {

          // output data of each row
          while($row = $result->fetch_assoc()) {
             ?>
             <li><u>שם מוצר: </u> <?php echo $row['name']; ?>, <u>מחיר:</u> <?php echo $row['price']; ?></li>
             <?}
           }
       }

?>
