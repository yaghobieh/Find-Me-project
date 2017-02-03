<?php
if (isset($_POST['like'])){

    $id= $_POST['id'];

    $queryUpdateToLike = "UPDATE response_store SET likeCounter = likeCounter + 1   WHERE id = ?";
    $statement = $databaseConnection->prepare($queryUpdateToLike);
    $statement->bind_param('s', $id);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }

    $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
    if ($creationWasSuccessful)
    {
        ?><meta http-equiv="refresh" content="0"><?
    }
}

if (isset($_POST['unlike'])){

    $queryUpdateToLike = "UPDATE response_store SET unlikeCounter = unlikeCounter + 1   WHERE id = ?";
    $statement = $databaseConnection->prepare($queryUpdateToLike);
    $statement->bind_param('i', $row['id']);
    $statement->execute();
    $statement->store_result();
    ?><meta http-equiv="refresh" content="0"><?

}

?>
