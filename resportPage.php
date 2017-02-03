<?php

session_start();
if (isset($_POST['resport'])){

  $userName = $_POST['userName'];
  $titleOFPage = $_POST['pageName'];
  $contents = $_POST['contents'];

  if (!isset($_SESSION[$titleOFPage . $userName])){
    $_SESSION[$titleOFPage . $userName] = $userName;

    $filename = "documents/reposts.txt";

    $handle = fopen($filename, "a");
    fwrite($handle, ' name: ' );
    fwrite($handle, $userName );
    fwrite($handle, ' title: ' );
    fwrite($handle,  $titleOFPage);
    fwrite($handle,  ' contents: '  );
    fwrite($handle,  $contents . PHP_EOL);

    fclose($handle);
    ?><script>alert('דווח בהצלחה, תודה');</script><?
  }else{
    ?><script>alert('מצטערים, כבר דיווחת על עמוד זה');</script><?
  }
}

?>
