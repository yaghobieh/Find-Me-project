<?php

  if (is_admin()){
    $sql = "SELECT * FROM stores ORDER BY id DESC LIMIT 0, 5";
    $result = $databaseConnection->query($sql);
      if ($result->num_rows > 0) {

          // output data of each row
          while($row = $result->fetch_assoc()) {
             ?>
             <li><u>שם חנות:</u> <?php echo $row['title']; ?>, <u>מנהל חנות: </u> <?php echo $row['manager']; ?></li>
             <?}
           }
       }

?>
