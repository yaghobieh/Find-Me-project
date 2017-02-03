<?php

function getItemName($itemID){

  global $databaseConnection;
  $query = "SELECT name FROM items WHERE itemid = ?";
  $statement = $databaseConnection->prepare($query);
  $statement->bind_param('d', $itemID);
  $statement->execute();
  $statement->store_result();
  $statement->bind_result($itemName);
  while ($statement->fetch()) {
     return $itemName;
  }
}

function makeSelectionPlatform(){
  global $databaseConnection;
  ?>
  <select id="itemId" name="itemId" class="itemId">
      <option value="0">--select item--</option>
      <?php
      $statement = $databaseConnection->prepare("SELECT itemid, name FROM items");
      $statement->execute();

      if($statement->error)
      {
          die("Database query failed: " . $statement->error);
      }

      $statement->bind_result($id, $name);
      while($statement->fetch())
      {
          echo "<option value=\"$id\">$name</option>\n";
      }
      ?>
  </select>
  <?
}
