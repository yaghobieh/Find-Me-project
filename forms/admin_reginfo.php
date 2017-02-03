<?php
2
    require('forms/connect.php');
3
    // If the values are posted, insert them into the database.
4
    if (isset($_POST['name']) && isset($_POST['password'])){
5
        $admin_uname = $_POST['name'];
6
7
        $password = $_POST['password'];
8
  
9
        $query = "INSERT INTO `user` (username, password, email) VALUES ('$admin_uname', '$password')";
10
        $result = mysql_query($query);
11
        if($result){
12
            $msg = "User Created Successfully.";
13
        }
14
    }
15
    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
