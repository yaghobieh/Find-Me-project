<?php

if (isset($_POST['editProfileValues'])){

    $id = $_POST['id'];
    $email = $_POST['newEmail'];
    $sex = $_POST['sex'];
    $location = $_POST['city'];

    $query = "UPDATE users SET email = ?, sex = ? , city = ? WHERE id= ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ssss', $email, $sex, $location, $id);
    $statement->execute();
    $statement->store_result();

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful){
      echo "<div class='eror'>עודכן בהצלחה</div>";
      echo "<meta http-equiv='refresh' content='0'>";
    }
}

?>
