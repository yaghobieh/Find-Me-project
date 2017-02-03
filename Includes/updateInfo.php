<?php

  if (isset($_POST['update'])){

    $titleStore = $_POST['titleStore'];
    $newTitleStore= $_POST['newTitleStore'];
    $subInfo= $_POST['subInfo'];
    $phoneNumber = $_POST['phoneNumber'];
    $logo= $_POST['logo'];
    $adress = $_POST['adress'];
    $webAdress = $_POST['webAdress'];
    $email = $_POST['email'];

    $itemName= $_POST['itemName'];
    $newPrice= $_POST['newPrice'];

    $query = "UPDATE stores SET title = ?, sub_info = ?, logo= ?, phoneNumber= ?, adress = ?, email = ?, webAdress = ? WHERE title= ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ssssssss', $newTitleStore, $subInfo, $logo, $phoneNumber, $adress, $email,  $webAdress, $titleStore);
    $statement->execute();
    $statement->store_result();

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful){
      echo "<div class='eror'>עודכן בהצלחה</div>";
      ?><script>parent.history.back();</script><?
    }

  }




 ?>
