<?php

session_start();

if (isset($_POST['regForUpdate'])){

  $userName = $_POST['userName'];
  $titleOFPage = $_POST['pageName'];
  $date = $_POST['date'];

  if (!isset($_SESSION[$titleOFPage])){
    $_SESSION[$titleOFPage] = $titleOFPage;
    $query = "INSERT INTO update_reg_users (username, name_item, time_register) VALUES (?, ?, ?)";

    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('sss', $userName, $titleOFPage, $date);
    $statement->execute();
    $statement->store_result();

    $filename = "documents/regUpdateContain.txt";

    $handle = fopen($filename, "a");
    fwrite($handle, ' name: ' );
    fwrite($handle, $userName );
    fwrite($handle, ' title: ' );
    fwrite($handle,  $titleOFPage);
    fwrite($handle,  ' date: '  );
    fwrite($handle,  $date . PHP_EOL);

    fclose($handle);
    ?><script>alert('נרשמת בהצלחה!!');</script><?
  }else{
    ?><script>alert('מצטערים, הינך רשום לעמוד זה כמנוי');</script><?
  }
}

?>
