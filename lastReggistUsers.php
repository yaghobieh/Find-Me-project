<?php

  if (is_admin()){
    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 0, 5";
    $result = $databaseConnection->query($sql);
      if ($result->num_rows > 0) {

          // output data of each row
          while($row = $result->fetch_assoc()) {
             ?>
             <li><u>שם מלא:</u> <?php echo $row['username']; ?>, <u>פרטים:</u> <?php echo $row['fname'] ." " . $row['lname']; ?></li>
             <?}
           }
       }

?>
