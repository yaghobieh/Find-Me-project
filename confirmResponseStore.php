<?php

  if (isset($_POST['submit'])){

    $confirm = "true";
    $getID = $_POST['idChoose'];

    $query = "UPDATE response_store SET publicity = ? WHERE id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ss', $confirm, $getID);
    $statement->execute();
    $statement->store_result();
  }

?>
