<?php

  $storeName = $_POST['storeNameBin'];
  $thisItemNeedChangeProce = $_POST['getItemNameBin'];
  $checkIfAvailable = $_POST['haveOrNo'];
  $getNewPrice = $_POST['changePrice'];
  $deliveryDays = $_POST['chnageDeliverDay'];
  $deliveryPrice = $_POST['changePriceDelvier'];

  if (isset($_POST['changeAspect'])){
    $query= "UPDATE store_items SET price= ?, available = ?, deliveryDays = ?, deliveryPrice = ? WHERE item_name = ? AND store_name = ?";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ssssss', $getNewPrice, $checkIfAvailable, $deliveryDays, $deliveryPrice, $thisItemNeedChangeProce, $storeName);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful)
    {
        echo "<div class='eror'>מוצר זה נערך כראוי</div>";
        ?><script>parent.history.back();</script><?
    }
    else
    {
        echo "<div class='eror'>שגיאה בעדכון מוצר זה<br>אנא בדוק את הסיעיפים ומלא כראוי</div>";
    }
  }
?>
