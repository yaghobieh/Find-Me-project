<?php

if (isset($_POST['Edit'])){

  $newTitle= $_POST['newTitle'];
  $newContext = $_POST['newText'];
  $getID = $_POST['idChoose'];

  $query = "UPDATE response_store SET contents = ?, title = ? WHERE id = ?";
  $statement = $databaseConnection->prepare($query);
  $statement->bind_param('sss', $newContext, $newTitle, $getID);
  $statement->execute();
  $statement->store_result();

}


?>
