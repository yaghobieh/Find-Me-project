<?php
     session_start();

     $server = 'localhost';
     $db_username = 'root';
     $db_password = ' ';
     $database = 'forumtutorial';

      if (!mysql_connect($server, $db_username, $db_password)){
          die ('Could not connect to the mySQL database');
      }
      if (mysql_select_db($database)){
          die('could not connect to database');
      }
?>

