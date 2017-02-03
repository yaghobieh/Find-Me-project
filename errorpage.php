<?php
        require_once ("Includes/simplecms-config.php"); 
        require_once  ("Includes/connectDB.php");
        include("Includes/header.php");
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found"); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <div align="center" id="error">
		<h3>PAGE NOT EXIST--Try again</h3>
		</div>
    </body>
</html>
<?php 
    include ("Includes/footer.php");
 ?>