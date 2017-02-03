<?php

 function getUserPicture($getUserPicture)
 {
     global $databaseConnection;
     $query = "SELECT userPic FROM users WHERE username = ?";
     $statement = $databaseConnection->prepare($query);
     $statement->bind_param('s', $getUserPicture);
     $statement->execute();
     $statement->store_result();
     $statement->bind_result($userPic);
     while ($statement->fetch()) {
             return $userPic;
     }
 }

?>
