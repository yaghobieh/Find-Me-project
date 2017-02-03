<?php
    $checkThisName = $row['store_name'];
    echo $checkThisName;
    $sql = "SELECT * FROM stores WHERE title = $checkThisName ";
    $result = $databaseConnection->query($sql);
    if ($result->num_rows > 0) {

        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo $row['title'];
     }
   }
 ?>
