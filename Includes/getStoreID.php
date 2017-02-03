<?php
 function getStoreID($checkThisName)
 {

     $query = "SELECT id FROM stores WHERE title = $checkThisName ";
     $statement = $databaseConnection->prepare($query);
     $statement->bind_param('d', $getIdSession);
     $statement->execute();
     $statement->store_result();
     $statement->bind_result($storeid);
     while ($statement->fetch()) {
             return $storeid;
           }
 }

 ?>
