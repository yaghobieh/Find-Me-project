<?php

  if (isset($_POST['submit'])){

    $confirm = "true";
    $getID = $_POST['idChoosedItem'];

    $query = "UPDATE response SET publicity = ? WHERE response_id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ss', $confirm, $getID);
    $statement->execute();
    $statement->store_result();

  }

?>
