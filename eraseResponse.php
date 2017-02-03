<?php

if (isset($_POST['submit']))
{
    $idForErase = $_POST['idForErase'];
    $query = "DELETE FROM response_store WHERE id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $idForErase);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }
}
 ?>
