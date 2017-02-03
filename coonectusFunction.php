<?php

  if (isset($_POST['connectUs'])){
    
    $userName = $_POST['name'];
    $titleOFMessage = $_POST['Title'];
    $contents = $_POST['contents'];

    $filename = "documents/connectUs.txt";

    $handle = fopen($filename, "a");
    fwrite($handle, ' name: ' );
    fwrite($handle, $userName );
    fwrite($handle, ' title: ' );
    fwrite($handle,  $titleOFMessage);
    fwrite($handle,  ' contents: '  );
    fwrite($handle,  $contents . PHP_EOL);

    fclose($handle);
    echo "<div class='eror'>נשלח בהצלחה</div>";
  }

?>
