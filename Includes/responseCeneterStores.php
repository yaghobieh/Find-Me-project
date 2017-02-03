<?php

  $userName = $_SESSION['username'];
  $storeName = $_POST['nameOfStore'];
  $gos = $_POST['chooseGos'];
  $goo = $_POST['chooseGoo'];
  $titleOfResponse = $_POST['title'];
  $contents = $_POST['contents'];
  $noPublicityYet = "false";
  $date = $_POST['dateOfPublicity'];

  if (isset($_POST['submit'])){
    $query = "INSERT INTO response_store (storename, username, title, publicity, gradeOfServise, gradeOfEasyOrder, contents, dateOfPublicity)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ssssssss', $storeName, $userName, $titleOfResponse, $noPublicityYet, $gos, $goo, $contents, $date);
    $statement->execute();
    $statement->store_result();

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful)
    {
        include("Includes\addToResponseCount.php");
        echo "<div class='eror'>תודה על פרסום המודעה/ התגובה דעתכם חשובה לנו<br>בהתאם לתקנון המערכת, הפוסט יעלה בעוד 48 שעות</div>";
        ?><script>parent.history.back();</script><?
    }
  }
 ?>
