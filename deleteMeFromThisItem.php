<?php

  if (isset($_POST['deleteItem'])){

    $storeName = $_POST['storeNameBin'];
    $thisItemNeedDel = $_POST['getItemNameBin'];

    $query= "DELETE FROM store_items WHERE item_name = ? AND store_name = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('ss', $thisItemNeedDel, $storeName);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    // TODO: Check for == 1 instead of > 0 when page names become unique.
    $deletionWasSuccessful = $statement->affected_rows > 0 ? true : false;
    if ($deletionWasSuccessful)
    {
      echo "<div class='eror'>נמחק</div>";
        ?><script>parent.history.back();</script><?
    }
    else
    {
        echo "<div class='eror'>התרחשה שגיאה בדוק את העמוד אותו אתה מנסה למחוק</div>";
    }

  }

?>
