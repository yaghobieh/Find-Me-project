<?php
session_start();
if (isset($_POST['submit'])){


    $titleStore = $_POST['titleStoreL'];
    $itemName= $_POST['getItemName'];
    $newPrice= $_POST['newPrice'];
    $itemID = $_POST['getItemID'];

    if (!isset($_SESSION[$itemName])){
      $_SESSION[$itemName] = $itemName;
      $query = "INSERT INTO store_items (store_name, item_name, item_id, price)
                  VALUES (?, ?, ?, ?)";

      $statement = $databaseConnection->prepare($query);
      $statement->bind_param('ssss', $titleStore, $itemName, $itemID, $newPrice);
      $statement->execute();
      $statement->store_result();

      $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
      if ($creationWasSuccessful){
        echo "<div class='eror'>בוצע בהצלחה</div>";
        ?><script>parent.history.back();</script><?
      }else{
        echo "<div class='eror'>בדוק שוב את הנתונים</div>";
      }
    }else{
      echo "<div class='eror'>כבר התווספת למוצר זה בעבר</div>";
    }
  }

?>
