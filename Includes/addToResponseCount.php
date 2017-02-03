<?php

  $store_name = $storeName;

  $query = "UPDATE stores SET responsecounter = responsecounter + 1 WHERE title = '$store_name'";
  $statement = $databaseConnection->prepare($query);
  $statement->execute();
  $statement->store_result();


?>
