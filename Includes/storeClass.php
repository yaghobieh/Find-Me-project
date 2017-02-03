<?php

function getStoreName($getIdSession)
{
    global $databaseConnection;
    $query = "SELECT title FROM stores WHERE manager = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $getIdSession);
    $statement->execute();
    $statement->store_result();
    $statement->bind_result($storeName);
    while ($statement->fetch()) {
            return $storeName;
    }
}

function getStoreID($getIdSession)
{
    global $databaseConnection;
    $query = "SELECT id FROM stores WHERE manager = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $getIdSession);
    $statement->execute();
    $statement->store_result();
    $statement->bind_result($storeID);
    while ($statement->fetch()) {
            return $storeID;
    }
}

?>
