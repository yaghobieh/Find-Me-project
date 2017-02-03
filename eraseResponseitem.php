<?php

if (isset($_POST['submit']))
{
    $idForErasIeItem = $_POST['idForEraseItem'];
    $query = "DELETE FROM response WHERE response_id = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('s', $idForErasIeItem);
    $statement->execute();
    $statement->store_result();

    if ($statement->error)
    {
        die('Database query failed: ' . $statement->error);
    }
}
 ?>
