<?php

$admin_uname=$_POST['name'];
$admin_pass=$_POST['password'];

mysql_connect("$server","$admin_uname","$admin_pass");

mysql_select_db("$database");


$order = "INSERT INTO Trial

        (name, address)

        VALUES

        ('$admin_uname',

        '$admin_pass')";


$result = mysql_query($order);

if($result){

    echo("<br>Input data is succeed");

} else{

    echo("<br>Input data is fail");

}
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
