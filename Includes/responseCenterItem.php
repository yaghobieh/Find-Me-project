<?php
  $g = ($_GET['itemid']);
  if ($g == NULL)
  {
        echo "<div class='eror'>עמוד זה אינו קיים</div>";
        die();
  }
  if (isset($_POST['submit'])){
      $autoFalse = "false";
      $title = $_POST['title'];
      $subtitle = $_POST['subtitle'];
      $contents = $_POST['contents'];
      $userWrite= $_SESSION['username'];
      $gID = $g ;
      $query2 = "INSERT INTO response (title, subtitle, contents, itemID, userWrite, publicity) VALUES (?, ?, ?, ?, ?, ?)";
      $statement = $databaseConnection->prepare($query2);
      $statement->bind_param('ssssss', $title, $subtitle, $contents, $gID, $userWrite, $autoFalse);
      $statement->execute();
      $statement->store_result();
  }
  if ($statement->error)
  {
      die('Database query failed: ' . $statement->error);
  }
  $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
  if ($creationWasSuccessful)
  {
      echo "<div class='eror'>תודה על פרסום המודעה/ התגובה דעתכם חשובה לנו<br>בהתאם לתקנון המערכת, הפוסט יעלה בעוד 48 שעות</div>";
      myRefresh ("item.php?itemid=$g");
  }


 ?>
